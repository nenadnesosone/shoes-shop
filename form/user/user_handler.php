<?php

    require_once 'data/usersdata.php';

    $usersid = $_SESSION['usersid'];
    $email = $_SESSION['log_email'];
    $fname = "";
    $newfname = "";
    $lname = "";
    $newlname = "";
    $pass = "";
    $newpass = "";
    $newpass2 = "";
    $type = $_SESSION['type'];
    $udate = "";
    $ddate = "";
    $uid = "";
    $did = "";

    $error_array = array();

    if ((isset($_POST['update_button'])) or (isset($_POST['delete_button']))) {
        

        $pass = md5(UsersData::sanit($_POST['profile_password']));   //uklanja HTML elemente,  razmake  i enkripcija lozinke

        //provera da li postoji korisnik
        if (!UsersData::CheckUser($email, $pass)) {
            array_push($error_array,"Password was incorrect!<br>");
            
        }else{
            // uzimamo podatke iz baze
            $row = UsersData::GetUserRow($email, $pass);
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $pass = $row['password'];

            $udate = date("Y-m-d");
            $uid = $usersid;
            if(isset($_POST['delete_button'])){
                //brisemo korisnika i brisemo podatke iz sesije
                $ddate = date("Y-m-d");
                $did = $usersid;
                UsersData::DeleteUser($usersid, $ddate, $did);
                session_destroy();
                // dodati funkcionalnost da se moze obrisati i menjati neki drugi korisnik, osim ako worker hoce da promeni type
            } else {
                if(!empty($_POST['update_fname'])){

                    $newfname = ucfirst(strtolower(UsersData::sanit($_POST['update_fname']))); //ostavlja samo prvo slovo veliko
                    
                        //provera duzine imena
                    if (strlen($newfname)>25 || strlen($newfname)<2) {
                        array_push($error_array,  "Your first name must be between 2 and 25 characters");
                    } else {

                        $fname = $newfname;
                    
                    // menjamo podatke u bazi
                        UsersData::UpdateUser($usersid, $fname, $lname, $pass, $type, $udate, $uid);
                        array_push($error_array, "You have updated your First Name!");
                    }
                }
                if(!empty($_POST['update_lname'])){

                
                    $newlname = ucfirst(strtolower(UsersData::sanit($_POST['update_lname']))); ///uklanja HTML elemente, razmake i ostavlja samo prvo slovo veliko

                    //provera duzine prezimena
                    if (strlen($newlname)>25 || strlen($newlname)<2) {
                        array_push($error_array, "Your last name must be between 2 and 25 characters"); 
                    } else {

                        $lname = $newlname;
                    
                        // menjamo podatke u bazi
                        UsersData::UpdateUser($usersid, $fname, $lname, $pass, $type, $udate, $uid);
                        array_push($error_array, "You have updated your Last Name!");
                    }
                    
                }
                // ako su ukucane nove sifre
                if((!empty($_POST['new_password'])) and (!empty($_POST['new_password2']))){

                    //Lozinka
                    $newpass = UsersData::sanit($_POST['new_password']); //uklanja HTML elemente
                    $newpass2 = UsersData::sanit($_POST['new_password2']); //uklanja HTML elemente

                    if ($newpass != $newpass2) {
                        array_push($error_array, "Your passwords do not match");
                    }else if (preg_match('/[^A-Za-z0-9]/', $newpass)) {
                        //lozinka moze da sadrzi samo slova i brojeve
                        array_push($error_array,  "Your password can only contain english characters and numbers");
                    }else if(strlen($newpass) >30 || strlen($newpass) < 5) {
                        //neodgovarajuca duzina lozinke
                        array_push($error_array, "Your password must be between 5 and 30 characters"); 
                    } else {
                        $newpass= md5($newpass);    //enkripcija lozinke
                        
                        $pass = $newpass;// tek kad smo sve proverili menjamo lozinku

                        // menjamo podatke u bazi
                        UsersData::UpdateUser($usersid, $fname, $lname, $pass, $type, $udate, $uid);
                        array_push($error_array, "You have updated your Password!");
                    }
                } 
            // dodati funkcionalnost da samo admin moze promeniti type
            }

        } 
    }

?>