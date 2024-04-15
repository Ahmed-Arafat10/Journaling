<?php

namespace App;

class Authentication
{
    // used to allow access to some pages ONLY when the user is authenticated
    public function auth()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: SignIn.php');
        }
    }

    // return true or false
    public function is_auth()
    {
        return isset($_SESSION['user_id']);
    }

    public function logOut()
    {
        // check if key ?logout= exists in URL
        if (isset($_GET['logout'])) {
            session_unset();
            session_destroy();
            header('Location: SignIn.php');
        }
    }

    // used to prevent access of SignUp.php & SignUp.php pages when user is authenticated
    public function redirectIfAuth()
    {
        if (isset($_SESSION['user_id'])) {
            $_SESSION['alert_already_auth'] = 1;
            header('Location: index.php');
        }
    }

    public function signUp()
    {
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

    public function logIn()
    {
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
                    \App\Alert::PrintMessage("Welcome Back, " . $data['Name'], "Normal");
                    $_SESSION['user_id'] = $data['ID'];
                    $_SESSION['Name'] = $data['Name'];
                    header('Location: index.php');
                } else {
                    \App\Alert::PrintMessage("Password Is Incorrect", "Danger");
                }
            } else {
                \App\Alert::PrintMessage("Email Not Found", "Danger");
            }
        }
    }
}