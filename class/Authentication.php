<?php

namespace App;

class Authentication
{
    public function signUp(){
        $myDB = new \App\DB();
        $myDB->connect();
        if (isset($_POST['signUpBtn'])) {
            #var_dump($_POST);
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password != $confirm_password) {
                \App\Alert::PrintMessage("Password Not Matched", "Danger");
            } else {
                $insert = "INSERT INTO `user` VALUES(NULL,?,?,?)";
                $Query = $myDB->Con->prepare($insert); // SQL Injection
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $Query->bind_param('sss', $username, $hashedPassword, $email);
                $check = $Query->execute();
                if ($check)
                    header('Location: LogIn.php?doneSignUp=1');
                else
                    \App\Alert::PrintMessage("Failed", "Danger");
            }
        }
    }

    public function logIn(){
        if (isset($_POST['logInBtn'])) {
            $myDb = new \App\DB();
            $myDb->connect();

            $email = $_POST['email'];
            $password = $_POST['password'];

            $selectStmt = "SELECT * FROM `user` WHERE `Email` = ?";
            $Query = $myDb->Con->prepare($selectStmt);
            $Query->bind_param('s', $email);
            $Query->execute();
            $result = $Query->get_result();
            if ($result->num_rows == 1) {
                $data = $result->fetch_assoc();
                if (password_verify($password, $data['Password'])) {
                    \App\Alert::PrintMessage("Welcome Back, " . $data['Name'], "Danger");
                } else {
                    \App\Alert::PrintMessage("Password Is Incorrect", "Danger");
                }
            } else {
                \App\Alert::PrintMessage("Email Not Found", "Danger");
            }
        }
    }
}