<?php

namespace App;

class Task
{
    # CRUD Operations
    public function create()
    {
        if (isset($_POST['addNewTaskBtn'])) {
            $task = $_POST['task_input'];
            $myDb = new DB();
            $myDb->connect();
            $insert = "INSERT INTO `to-do-list` VALUES(NULL,?,?,0,?)";
            $q = $myDb->Con->prepare($insert);
            $q->bind_param('isi', $_SESSION['date_id'], $task, $_SESSION['user_id'],);
            $check = $q->execute();
            if ($check)
                Alert::PrintMessage("Task Is Added", "Normal");
            else
                Alert::PrintMessage("Something Went Wrong", "Danger");
        }

    }

    public function select()
    {
        $myDb = new DB();
        $myDb->connect();
        $select = "SELECT * FROM `to-do-list` WHERE `User_ID` = ? AND `Date_ID` = ? ORDER BY Is_Done";
        $q = $myDb->Con->prepare($select);
        $q->bind_param('ii', $_SESSION['user_id'], $_SESSION['date_id']);
        $q->execute();
        return $q->get_result();
    }

    public function getTaskById()
    {
        if (!isset($_GET['task_id'])) {
            Alert::PrintMessage("Cannot Access This Page", "Danger");
            exit();
        }
        $myDb = new DB();
        $myDb->connect();
        $select = "SELECT * FROM `to-do-list` WHERE `ID`= ?";
        $q = $myDb->Con->prepare($select);
        $q->bind_param('i', $_GET['task_id']);
        $q->execute();
        return $q->get_result()->fetch_assoc();
    }

    public function update()
    {
        if(isset($_POST['updateTaskBtn'])){
            $myDb = new DB();
            $myDb->connect();
            $task = $_POST['task_input'];
            $select = "UPDATE `to-do-list` SET `Task` = ? WHERE `ID`= ?";
            $q = $myDb->Con->prepare($select);
            $q->bind_param('si', $task,$_GET['task_id']);
            $q->execute();
            header('Location: TaskView.php');
        }
    }
}