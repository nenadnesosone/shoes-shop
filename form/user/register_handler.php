<?php
    require_once 'data/usersdata.php';

    //Deklarisanje varijabli

    $fname = "";
    $lname = "";
    $email = "";
    $email2 = "";
    $pass = "";
    $pass2 = "";
    $type = ""; 
    $cdate = ""; 
    $cid = $_SESSION['usersid'];
    $error_array = array();

    if (isset($_POST['register_button'])) {
        if ($_SESSION['type'] == 'admin') {
                    //Ime
                $fname = ucfirst(strtolower(UsersData::sanit($_POST['reg_fname'])));// uklanjamo html elemente i razmake, ostavlja samo prvo slovo veliko
                $_SESSION['reg_fname'] = $fname; //cuva se u sesiji ime

                //Prezime
                $lname = ucfirst(strtolower(UsersData::sanit($_POST['reg_fname'])));// uklanjamo html elemente i razmake, ostavlja samo prvo slovo veliko
                $_SESSION['reg_lname'] = $lname; //cuva se u sesiji prezime
                
                //Email
                $email = UsersData::sanit($_POST['reg_email']);// uklanjamo html elemente i razmake
                $_SESSION['reg_email'] = $email; //cuva se u sesiji email


                //email 2
                $email2 = UsersData::sanit($_POST['reg_email2']);// uklanjamo html elemente i razmake
                $_SESSION['reg_email2'] = $email2; //cuva se u sesiji email2

                //Lozinka
                $pass = UsersData::sanit($_POST['reg_password']); // uklanjamo html elemente i razmake
                $pass2 = UsersData::sanit($_POST['reg_password2']); // uklanjamo html elemente i razmake

                $type = UsersData::sanit($_POST['reg_type']);; 

                $cdate = date("Y-m-d"); //uzima trenutni datum

                if ($email == $email2) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

                        //provera da li je vec koriscen taj email
                        if (UsersData::CheckEmail($email)) {
                            array_push($error_array, "Email already in use");
                        }

                    }else {
                        array_push($error_array, "Invalid email format"); 
                    }   
                }else{
                    array_push($error_array, "Emails don't match"); 
                }
            
                //provera duzine imena
                if (strlen($fname)>25 || strlen($fname)<2) {
                    array_push($error_array,  "Your first name must be between 2 and 25 characters");
                }
                //provera duzine prezimena
                if (strlen($lname)>25 || strlen($lname)<2) {
                    array_push($error_array, "Your last name must be between 2 and 25 characters"); 
                }

                // da li je admin ili worker
                if ($type !== 'admin' and $type !== 'worker') {
                        array_push($error_array, "Please select Authorization type"); 
                }

                //password i password2 moraju da budu isti
                if ($pass != $pass2) {
                    array_push($error_array, "Your passwords do not match");
                }else {
                    //lozinka moze da sadrzi samo slova i brojeve
                    if (preg_match('/[^A-Za-z0-9]/', $pass)) {
                        array_push($error_array,  "Your password can only contain english characters and numbers");
                    }
                }
                //odgovarajuca duzina lozinke
                if (strlen($pass) >30 || strlen($pass) < 5) {
                    array_push($error_array, "Your password must be between 5 and 30 characters"); 
                }

                if (empty($error_array)) {
                    
                    $pass = hash('sha256', $pass);
                    //unos podataka u bazu
                    UsersData::CreateUser($fname, $lname, $email, $pass, $type, $cdate, $cid);
                
                    //unos podataka u bazu
                    array_push($error_array, "<You're all set! Go ahead and login!");

                    //brisanje podataka iz sesija
                    $_SESSION['reg_fname'] = "";
                    $_SESSION['reg_lname'] = "";
                    $_SESSION['reg_email'] = "";
                    $_SESSION['reg_email2'] = "";
                }
            } else {
                array_push($error_array, "You're not admin! New user not added!");

            }
        }
    

?>