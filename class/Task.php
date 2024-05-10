<?php

namespace App;

class Task
{
    # CRUD Operations
    public function create()
    {
        $validation = [];
        if (isset($_POST['addNewTaskBtn'])) {
            $task = $_POST['task_input'];
            if (empty($task)) {
                # $validation[] = "Task Is Empty";
                array_push($validation, "Task Is Empty");
            }
            if (count($validation) != 0) {
                foreach ($validation as $item) {
                    Alert::PrintMessage($item, "Danger");
                }
                return;
            }
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
        if (isset($_POST['updateTaskBtn'])) {
            $myDb = new DB();
            $myDb->connect();
            $task = $_POST['task_input'];
            $select = "UPDATE `to-do-list` SET `Task` = ? WHERE `ID`= ?";
            $q = $myDb->Con->prepare($select);
            $q->bind_param('si', $task, $_GET['task_id']);
            $q->execute();
            header('Location: TaskView.php');
        }
    }

    public function delete()
    {
        if (isset($_GET['task_delete'])) {
            $task_id = $_GET['task_delete'];
            $myDb = new DB();
            $myDb->connect();
            $delete = "DELETE FROM `to-do-list` WHERE `ID` = ?";
            $stmt = $myDb->Con->prepare($delete);
            $stmt->bind_param('i', $task_id);
            if ($stmt->execute())
                header('Location: TaskView.php');
            else
                Alert::PrintMessage("Failed To Delete The Task", "Danger");
        }
    }

    public function updateTaskStatus()
    {
        if (isset($_GET['task_status'])) {
            $myDb = new DB();
            $myDb->connect();
            $delete = "UPDATE `to-do-list` SET `IS_DONE` = ? WHERE `ID` = ?";
            $stmt = $myDb->Con->prepare($delete);
            $stmt->bind_param('ii', $_GET['status'], $_GET['task_status']);
            if ($stmt->execute())
                header('Location: TaskView.php');
            else
                Alert::PrintMessage("Failed To Update Task Status", "Danger");
        }
    }
}