<?php

class EnrollmentController {
    
    public function __construct() {
        $this->view = new View();
    }
    
    
    public function insert(){
        require 'model/StudentModel.php';
        $model = new StudentModel();

        $result = $model->selectAllStudent();
        $this->view->show("insertEnrollmentView.php", $result);
    }//insert
    
    public function delete(){
        require 'model/StudentModel.php';
        $model = new StudentModel();

        $result = $model->selectStudentEnrolled();
        $this->view->show("deleteEnrollmentView.php", $result);
    }//insert
    
    public function select(){
        require 'model/StudentModel.php';
        $model = new StudentModel();

        $result = $model->selectStudentEnrolled();
        $this->view->show("selectEnrollmentView.php", $result);
    }//select
    
    public function selectCourses(){
        require 'model/CourseModel.php';
        $model = new CourseModel();

        $result = $model->selectCoursesStudent($_POST["identification"]);
        echo json_encode($result);
    }//select
    
    public function deleteFunction(){
        require 'model/EnrollmentModel.php';
        $model = new EnrollmentModel();
        
        $result = $model->deleteEnrollment($_POST["ID"]);
        echo json_encode($result);
    }//deleteFunction
}//end of class

?>
