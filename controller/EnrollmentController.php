<?php

class EnrollmentController {

    public function __construct() {
        $this->view = new View();
    }

    public function select() {
        require 'model/StudentModel.php';
        $model = new StudentModel();

        $result = $model->selectStudentEnrolled();
        $this->view->show("selectEnrollmentView.php", $result);
    }

    public function selectCourses() {
        require 'model/CourseModel.php';
        $model = new CourseModel();

        $result = $model->selectCoursesStudent($_POST["identification"]);
        echo json_encode($result);
    }
    
    public function selectCourseNotStudent() {
        require 'model/EnrollmentModel.php';
        $model = new EnrollmentModel();

        $result = $model->selectCoursesNotStudent($_POST["identification"]);
        echo json_encode($result);
    }

    public function delete() {

        if (isset($_POST["ID"])) {
            require 'model/EnrollmentModel.php';
            $model = new EnrollmentModel();

            $result = $model->deleteEnrollment($_POST["ID"]);
            echo json_encode($result);
        } else {
            require 'model/StudentModel.php';
            $model = new StudentModel();

            $result = $model->selectStudentEnrolled();
            $this->view->show("deleteEnrollmentView.php", $result);
        }
    }

    public function insert() {
        if (isset($_POST['id-courses']) && isset($_POST['id-student'])) {
            require 'model/EnrollmentModel.php';
            $model = new EnrollmentModel();
            $ids = "";
            $num_ids = 0;
            foreach ($_POST['id-courses'] as $valorActual) {
                if ($ids == '') {
                    $ids = $valorActual;
                } else {
                    $ids = $valorActual . "," . $ids;
                }
                $num_ids = $num_ids + 1;
            }//for        
            $result = $model->insertEnrollment($_POST['id-student'], $ids, $num_ids);
            echo json_encode($result);
        } else {
            require 'model/StudentModel.php';
            $model = new StudentModel();

            $result = $model->selectAllStudent();
            $this->view->show("insertEnrollmentView.php", $result);
        }
    }

}

//end of class
?>
