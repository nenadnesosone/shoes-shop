<?php
require_once 'data/usersdata.php';
// klasa uz ciju pomoc cemo pristupati podacima kategorijama
class CategoryData{

    // svojstva objekta
    public $catid;
    public $catname;
    public $cdate;
    public $udate;
    public $ddate;
    public $cid;
    public $uid;
    public $did;
    public $deleted;


    // funkcija konstruktor
    public function __construct($catid, $catname, $cdate, $udate, $ddate, $cid, $uid, $did, $deleted)
    {
        $this->catid = $catid; 
        $this->catname = $catname;
        $this->cdate = $cdate;
        $this->udate = $udate;
        $this->ddate = $ddate;
        $this->cid = $cid;
        $this->uid = $uid;
        $this->did = $did;
        $this->deleted = $deleted;

    }

    // funcija koja ce prikupljati podatke o svim kategorijama iz baze
    public static function GetAllCategorys()
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        ///odaberemo sve 
        $query = "SELECT * FROM category";

        $result = mysqli_query($db, $query);
        if ($result) {
     
            $data = [];
            while ($row = mysqli_fetch_assoc($result))
            {
                    $row['created_by'] = UsersData::GetOneUser($row['created_by'])['first_name'];
                    $row['updated_by'] = UsersData::GetOneUser($row['updated_by'])['first_name'];
                    $row['deleted_by'] = UsersData::GetOneUser($row['deleted_by'])['first_name'];

                    $row['created_at'] = date("d/m/Y", strtotime($row['created_at']));
                    if ($row['updated_at'] !== NULL){
                        $row['updated_at'] = date("d/m/Y", strtotime($row['updated_at']));
                    }
                    if ($row['deleted_at'] !== NULL){
                        $row['deleted_at'] = date("d/m/Y", strtotime($row['deleted_at']));
                    }
        
                    $data[] = $row;
            } 
            return $data;
        
        } else {
            return [];
        }
    }

    // funcija koja ce prikupljati podatke o jednoj kategoriji iz baze
    public static function GetOneCategory($catname)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca catname

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM category WHERE category_name = '$catname'";

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    // funcija koja ce prikupljati podatke o jednoj kategoriji iz baze
    public static function GetCategory($catid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca catname

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM category WHERE category_id = '$catid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    // funkcija za ubacivanje kategorije u bazu
    public static function CreateCategory($catname, $cdate, $cid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        $query = "INSERT INTO category (`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`, `deleted`) 
        VALUES (DEFAULT, '$catname','$cdate', DEFAULT, DEFAULT, '$cid', DEFAULT, DEFAULT, DEFAULT)";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje kategorije iz baze "soft delete'
    public static function DeleteCategory($catname, $ddate, $did)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca catid

        // brisanje kategorije iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE category SET deleted_at = '$ddate', deleted_by = '$did', deleted = 1 WHERE category_name='$catname'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za update kategorije
    public static function UpdateCategory($catid, $catname, $udate, $uid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca catid

        //  update kategorije 	 	 	 	 	 	 	 	
        $query = "UPDATE category SET category_name = '$catname', updated_at = '$udate', updated_by = '$uid' WHERE category_id = '$catid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //provera da li kategorija vec postoji u bazi
    public static function CheckCategory($catname)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda je osetljiv na SQL Injection napade posto korisnik moze da ukuca catname, ali smo ga prethodno ocistili

        // odaberemo konkretnu kategoriju
        $query = "SELECT category_name FROM category WHERE category_name = '$catname'";

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
    public static function CheckDeleted($catname)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda je osetljiv na SQL Injection napade posto korisnik moze da ukuca catname, ali smo ga prethodno ocistili

        // odaberemo konkretan catname
        $query = "SELECT * FROM category WHERE category_name = '$catname' AND deleted = 0";

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