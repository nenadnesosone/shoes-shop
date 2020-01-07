<?php

    require_once 'data/usersdata.php';

    $error_array = array();
    if (isset($_POST['login_button'])) {

        $email = filter_var(UsersData::sanit($_POST['log_email'], FILTER_SANITIZE_EMAIL));
        $_SESSION['log_email'] = $email; //cuva u sesiji email

        //enkripcija lozinke
        $pass = hash('sha256', UsersData::sanit($_POST['log_password']));
        //provera da li se uneti podaci slazu sa podacima u bazi
        if (UsersData::CheckUser($email, $pass)) {
                
                $row = UsersData::GetUserRow($email, $pass);
                $_SESSION['usersid'] = $row['users_id'];
                $_SESSION['fname'] = $row['first_name'];
                $_SESSION['type'] = $row['type'];

                header("Location: main.php");
                
                //$_SESSION['log_email'] = "";
        
                exit();
        
        }else {
            array_push($error_array,"Email or password was incorrect!");

        }
    }

?>