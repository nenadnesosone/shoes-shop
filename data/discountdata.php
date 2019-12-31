<?php

// klasa uz ciju pomoc cemo pristupati podacima o popustima
class DiscountData{


    // svojstva objekta
    public $discid;
    public $dname;
    public $sdate;
    public $edate;
    public $shoe1;
    public $shoe2;
    public $price;
    public $cdate;
    public $udate;
    public $ddate;
    public $cid;
    public $uid;
    public $did;
    public $deleted;


    // funkcija konstruktor
    public function __construct($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $price, $cdate,$udate, $ddate, $cid, $uid, $did, $deleted)
    {
        $this->discid = $discid; 
        $this->dname = $dname;
        $this->sdate = $sdate;
        $this->edate = $edate;
        $this->shoe1 = $shoe1;
        $this->shoe2 = $shoe2;
        $this->price = $price;
        $this->cdate = $cdate;
        $this->udate = $udate;
        $this->ddate = $ddate;
        $this->cid = $cid;
        $this->uid = $uid;
        $this->did =$did;
        $this->deleted = $deleted;

    }

   // funcija koja ce prikupljati podatke o svim rasprodajama iz baze
   public static function GetAllDiscount()
   {
       //povezujemo se s bazom
       $db = Database::getInstance()->getConnection();
       ///odaberemo sve koji nisu obrisani, posto se obrisani nece prikazivani na frontendu
       $query = "SELECT * FROM discount WHERE deleted = 0";

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

   // funkcija za ubacivanje korisnika u bazu
   public static function CreateDiscount($dname, $sdate, $edate, $shoe1, $shoe2, $price, $cdate, $cid)
   {
       //povezujemo se s bazom
       $db = Database::getInstance()->getConnection();

       $query = "INSERT INTO discount (`discount_id`,`discount_name`,`start_date`,`end_date`,`shoe_1`,`shoe_2`,`price`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`, `deleted`) 
       VALUES (DEFAULT, '$dname', '$sdate','$edate','$shoe1','$shoe2',`$price`,'$cdate', DEFAULT, DEFAULT, '$cid', DEFAULT, DEFAULT, DEFAULT)";

       $result = mysqli_query($db, $query);
       if ($result) {
           return true;
       } else {
           return false;
       }
   }

    // funkcija za brisanje rasprodaje iz baze "soft delete'
    public static function DeleteOneDiscount($discid, $ddate, $did)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade

        // brisanje rasprodaje iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE discount SET deleted_at = '$ddate', deleted_by = '$did', deleted = 1, WHERE discount_id = '$discid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za update rasprodaje
    public static function UpdateDiscount($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $price, $udate, $uid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade

        //  update rasprodaje u bazi	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE discount SET discount_name = '$dname', start_date = '$sdate', end_date = '$edate', shoe_1 = '$shoe1', shoe_2 = '$shoe2', price = $price, update_at = '$udate', updated_by = '$uid' WHERE discount_id = '$discid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


?>