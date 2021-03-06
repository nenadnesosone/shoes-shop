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
           $data = [];
           while ($row = mysqli_fetch_assoc($result)){

                $row['created_by'] = UsersData::GetOneUser($row['created_by'])['first_name'];
                $row['updated_by'] = UsersData::GetOneUser($row['updated_by'])['first_name'];
                $row['deleted_by'] = UsersData::GetOneUser($row['deleted_by'])['first_name'];

                $row['created_at'] = date("d/m/Y", strtotime($row['created_at']));
                if ($row['updated_at'] !== NULL) {
                    $row['updated_at'] = date("d/m/Y", strtotime($row['updated_at']));
                }
                if ($row['deleted_at'] !== NULL) {
                    $row['deleted_at'] = date("d/m/Y", strtotime($row['deleted_at']));
                }

               $data[] = $row; 
           }
           return $data;
       } else {
           return [];
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