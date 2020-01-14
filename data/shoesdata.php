<?php
  require_once 'data/categorydata.php';
  require_once 'data/usersdata.php';
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
        ///odaberemo sve
        $query = "SELECT * FROM shoes";

        $result = mysqli_query($db, $query);
        
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            
            $data = [];
            while ($row = mysqli_fetch_assoc($result)){
                
                $row['category_id'] = CategoryData::GetCategory($row['category_id'])['category_name'];
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

    // funcija koja ce prikupiti podatke o jednoj cipeli iz baze
    public static function GetOneShoe($code)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca code

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM shoes WHERE code = '$code'";

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    // funcija koja ce prikupiti podatke o jednoj cipeli iz baze
    public static function GetShoe($shoeid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca code

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM shoes WHERE shoe_id = '$shoeid'";

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
        VALUES (DEFAULT,'$code', '$sname', '$desc','$price','$size','$image','$catid','$cdate', DEFAULT, DEFAULT, '$cid', DEFAULT, DEFAULT, DEFAULT)";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje cipele iz baze "soft delete'
    public static function DeleteShoe($code, $ddate, $did)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca usersid

        // brisanje korisnika iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE shoes SET deleted_at = '$ddate', deleted_by = '$did', deleted = 1 WHERE code = '$code'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za update cipele
    public static function UpdateShoe($shoeid, $sname, $desc, $price, $size, $image, $catid, $udate, $uid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca shoeid

        //  update korisnika u bazi	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE shoes SET shoe_name = '$sname', description = '$desc', price = '$price', size = '$size', image = '$image', category_id = '$catid', updated_at = '$udate', updated_by = '$uid' WHERE shoe_id = '$shoeid'";

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
}


?>