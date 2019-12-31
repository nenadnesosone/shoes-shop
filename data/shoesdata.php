<?php

// klasa uz ciju pomoc cemo pristupati korisnickim podacima
class ShoesData{

    // svojstva objekta
    public $shoeid;
    public $code;
    public $sname;
    public $desc;
    public $price;
    public $size;
    public $image;
    public $catid;
    public $cdate;
    public $udate;
    public $ddate;
    public $cid;
    public $uid;
    public $did;
    public $deleted;

    // funkcija konstruktor
    public function __construct($shoeid, $code, $sname, $desc, $price, $size, $image, $catid, $cdate, $udate, $ddate, $cid, $uid, $did, $deleted)
    {
        $this->shoeid = $shoeid; 
        $this->code = $code;
        $this->sname = $sname;
        $this->desc = $desc;
        $this->price = $price;
        $this->size = $size;
        $this->image = $image;
        $this->catid = $catid;
        $this->cdate = $cdate;
        $this->udate = $udate;
        $this->ddate = $ddate;
        $this->cid = $cid;
        $this->uid = $uid;
        $this->did =$did;
        $this->deleted = $deleted;

    }

    // funcija koja ce prikupljati podatke o svim cipelama iz baze
    public static function GetAllShoes()
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        ///odaberemo sve koji nisu obrisani, posto se obrisani nece prikazivani na frontendu
        $query = "SELECT * FROM shoes WHERE deleted = 0";

        $result = mysqli_query($db, $query);
        if ($result) {
            $userData = [];
            while ($row = mysqli_fetch_assoc($result))
            {
                $userData [] = $row;
            }
            return $userData;
        } else {
            return [];
        }
    }

    // funcija koja ce prikupiti podatke o jednoj cipeli iz baze
    public static function GetOneShoe($sname)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca sname

        // odaberemo konkretnog ime cipele
        $query = "SELECT * FROM shoes WHERE shoe_name = '$sname'";

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    // funkcija za ubacivanje cipela u bazu
    public static function CreateShoe($code, $sname, $desc, $price, $size, $image, $catid, $cdate, $cid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        $query = "INSERT INTO shoes (`shoe_id`,`code`,`shoe_name`,`description`,`price`,`size`,`image`,`category_id`, `created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`, `deleted`) 
        VALUES (DEFAULT,`$code`, '$sname', '$desc','$price','$size','$image',`$catid`,'$cdate', DEFAULT, DEFAULT, '$cid', DEFAULT, DEFAULT, DEFAULT)";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje cipele iz baze "soft delete'
    public static function DeleteShoe($shoeid, $ddate, $did)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca usersid

        // brisanje korisnika iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE shoes SET deleted_at = '$ddate', deleted_by = '$did', deleted = 1, WHERE shoe_id='$shoeid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za update cipele
    public static function UpdateShoe($shoeid, $code, $sname, $desc, $price, $size, $image, $catid, $udate, $uid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca shoeid

        //  update korisnika u bazi	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE shoes SET code = '$code', shoe_name = '$sname', description = '$desc', price = '$price', size = '$size', image = '$image', category = '$catid', update_at = '$udate', updated_by = '$uid' WHERE shoe_id = '$shoeid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //provera da li code vec postoji u bazi
    public static function CheckCode($code)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda je osetljiv na SQL Injection napade posto korisnik moze da ukuca code, ali smo ga prethodno ocistili

        // odaberemo konkretan email
        $query = "SELECT code FROM shoes WHERE code = '$code'";

        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result);
        //ako ima vise redova od 0 postoji u bazi
        if ($num_rows > 0) {
            return true;
        } else{
            return false;
        }
    }

    //provera da li je soft-deleted 
    public static function CheckDeleted($code)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda je osetljiv na SQL Injection napade posto korisnik moze da ukuca code, ali smo ga prethodno ocistili

        // odaberemo konkretan usersid
        $query = "SELECT * FROM shoes WHERE code = '$code' AND deleted = 0";

        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result);
        //ako ima vise redova od 0 postoji u bazi
        if ($num_rows > 0) {
            return true;
        } else{
            return false;
        }

    }


?>