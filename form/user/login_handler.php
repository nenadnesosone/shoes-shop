<?php

require_once 'data/usersdata.php';

$error_array = array();
if (isset($_POST['login_button'])) {

    $email = filter_var(UsersData::sanit($_POST['log_email'], FILTER_SANITIZE_EMAIL));
    $_SESSION['log_email'] = $email; //cuva u sesiji email

    $pass = md5(UsersData::sanit($_POST['log_password']));  //enkripcija lozinke md5 je prevazidjen u praksi bi se koristio sha256!!!

    //provera da li se uneti podaci slazu sa podacima u bazi
    if (UsersData::CheckUser($email, $pass)) {
            
            $row = UsersData::GetUserRow($email, $pass);
            $_SESSION['type'] = $row['type'];
            $_SESSION['usersid'] = $row['users_id'];
            $_SESSION['fname'] = $row['first_name'];
    
            header("Location: main.php");
            
            $_SESSION['log_email'] = "";
    
            exit();
       
    }else {
        array_push($error_array,"Email or password was incorrect!<br>");

    }
}

?>