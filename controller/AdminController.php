<?php

class AdminController {

    function __construct() {
        $this->view = new View();
        require 'model/AdminModel.php';
    }

    function insert() {
        if (isset($_POST["id"]) && isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["firstLastName"]) && isset($_POST["secondLastName"])) {
            $model = new AdminModel();
            $result = $model->insert($_POST["id"], $_POST["email"], $_POST["name"], $_POST["firstLastName"], $_POST["secondLastName"]);
            echo json_encode($result);
        } else {
            $this->view->show("insertAdminView.php");
        }
    }

    function delete() {
        $model = new AdminModel();
        if (isset($_POST["id"])) {
            $result = $model->delete($_POST["id"]);
            echo json_encode($result);
        } else {
            $result = $model->selectAll();
            $this->view->show("deleteAdminView.php", $result);
        }
    }

    function select() {
        $model = new AdminModel();
        if (isset($_POST["id"])) {
            $result = $model->select($_POST["id"]);
            echo json_encode($result);
        } else {
            $result = $model->selectAll();
            $this->view->show("selectAdminView.php", $result);
        }
    }

}
