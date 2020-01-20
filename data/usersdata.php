<?php

// klasa uz ciju pomoc cemo pristupati korisnickim podacima
class UsersData{


    // svojstva objekta
    public $usersid;
    public $fname;
    public $lname;
    public $email;
    public $pass;
    public $type;
    public $cdate;
    public $udate;
    public $ddate;
    public $cid;
    public $uid;
    public $did;
    public $deleted;


    // funkcija konstruktor
    public function __construct($usersid, $fname, $lname, $email, $pass, $type, $cdate,$udate, $ddate, $cid, $uid, $did, $deleted)
    {
        $this->usersid = $usersid; 
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->pass = $pass;
        $this->type = $type;
        $this->cdate = $cdate;
        $this->udate = $udate;
        $this->ddate = $ddate;
        $this->cid = $cid;
        $this->uid = $uid;
        $this->did =$did;
        $this->deleted = $deleted;


    }

    // funcija koja ce prikupljati podatke o svim korisnicima iz baze
    public static function GetAllUsers()
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        ///odaberemo sve
        $query = "SELECT * FROM users";

        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            
            echo "<div class='table-responsive'>
            <table class='table table-primary table-bordered table-striped table-hover text-center'>
                <caption class='text-center'>All Users:</caption>
                <tr>
                    <th>User Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Password Hash</th><th>Type</th><th>Created By</th><th>Created At</th><th>Updated By</th><th>Updated At</th><th>Deleted By</th><th>Deleted At</th>
                </tr>";

            while ($row = mysqli_fetch_assoc($result)){

                $usersid = $row['users_id'];
                $fname = $row['first_name'];
                $lname = $row['last_name'];
                $email = $row['email'];
                $pass = $row['password'];
                $type = $row['type'];
                $cdate = $row['created_at'];
                $udate = $row['updated_at'];
                $ddate = $row['deleted_at'];
                $cid = $row['created_by'];
                $uid = $row['updated_by'];
                $did = $row['deleted_by'];

                $cid = UsersData::GetOneUser($cid)['first_name'];
                $uid = UsersData::GetOneUser($uid)['first_name'];
                $did = UsersData::GetOneUser($did)['first_name'];

                // formatiranje datuma
                $cdate = date("d/m/Y", strtotime($cdate));
                if ($udate !== NULL){
                    $udate = date("d/m/Y", strtotime($udate));
                }
                if ($ddate !== NULL){
                    $ddate = date("d/m/Y", strtotime($ddate));
                }

                echo "<tr>
                        <td>$usersid</td><td>$fname</td><td>$lname</td><td>$email</td><td>$pass</td><td>$type</td><td>$cid</td>
                        <td>$cdate</td><td>$uid</td><td>$udate</td><td>$did</td><td>$ddate</td>
                    </tr>";
                
            }

            echo "</table>
            </div>";

        } else {
            echo "<p class='lead text-white'>There Are No Users!</p>";
        }
    }

    // funcija koja ce prikupljati podatke o jednom korisniku iz baze
    public static function GetOneUser($usersid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca usersid

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users WHERE users_id = '$usersid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    // funkcija za ubacivanje korisnika u bazu
    public static function CreateUser($fname, $lname, $email, $pass, $type, $cdate, $cid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        $query = "INSERT INTO users (`users_id`,`first_name`,`last_name`,`email`,`password`,`type`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`, `deleted`) 
        VALUES (DEFAULT, '$fname', '$lname','$email','$pass','$type','$cdate', DEFAULT, DEFAULT, '$cid', DEFAULT, DEFAULT, DEFAULT)";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje korisnika iz baze "soft delete'
    public static function DeleteUser($usersid, $ddate, $did)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca usersid

        // brisanje korisnika iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE users SET deleted_at = '$ddate', deleted_by = '$did', deleted = 1 WHERE users_id = '$usersid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za update korisnika
    public static function UpdateUser($usersid, $fname, $lname, $pass, $type, $udate, $uid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca usersid

        //  update korisnika u bazi	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE users SET first_name = '$fname', last_name = '$lname', password = '$pass', type = '$type', updated_at = '$udate', updated_by = '$uid' WHERE users_id = '$usersid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

     //provera da li email vec postoji u bazi
     public static function CheckEmail($email)
     {
         //povezujemo se s bazom
         $db = Database::getInstance()->getConnection();
 
         // ovaj deo koda je osetljiv na SQL Injection napade posto korisnik moze da ukuca email, ali smo ga prethodno ocistili
 
         // odaberemo konkretan email
         $query = "SELECT email FROM users WHERE email = '$email'";
 
         $result = mysqli_query($db, $query);
         $num_rows = mysqli_num_rows($result);
         //ako ima vise redova od 0 postoji u bazi
         if ($num_rows > 0) {
             return true;
         } else{
             return false;
         }
     
     }

    // proverava da li postoji korisnik u bazi
    public static function CheckUser($email, $pass)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca $email, $pass

        // odaberemo konkretan email
        $query = "SELECT email FROM users WHERE email = '$email' AND Password = '$pass' AND deleted = 0";

        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result);
        //ako ima vise redova od 0 postoji u bazi
        if ($num_rows > 0) {
            return true;
        } else{
            return false;
        }

    }

    // funcija koja ce prikupljati podatke o korisnicima iz baze koje cemo koristiti
    public static function GetUserRow($email, $pass)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca $email, $pass

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users WHERE email = '$email' AND Password = '$pass'";

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    // funkcija za sanitizaciju
    public static function sanit($x){

        $y = htmlspecialchars(strip_tags($x)); //uklanja HTML elemente
        $y = str_replace(' ', '', $y); //uklanja razmake
        return $y;

    }

     // funkcija za sanitizaciju html elementata
     public static function sanittrim($x){

        $y = htmlspecialchars(strip_tags($x)); //uklanja HTML elemente
        $y = trim($y); //uklanja razmake
        return $y;

    }
}


?>