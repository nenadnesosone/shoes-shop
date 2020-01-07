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
        ///odaberemo sve koji nisu obrisani, posto se obrisani nece prikazivani na frontendu
        $query = "SELECT * FROM shoes WHERE deleted = 0";

        $result = mysqli_query($db, $query);
        
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            
            echo "<div class='table-responsive'>
            <table class='table table-primary table-bordered table-striped table-hover text-center'>
                <caption class='text-center'>All Shoes:</caption>
                <tr>
                    <th>Shoe Id</th><th>Code</th><th>Shoe Name</th><th>Description</th><th>Price in dinars</th><th>Size</th><th>Category</th><th>Image</th><th>Created By</th><th>Created At</th><th>Updated By</th><th>Updated At</th>
                </tr>";

            while ($row = mysqli_fetch_assoc($result)){
                $shoeid = $row['shoe_id'];
                $code = $row['code'];
                $sname = $row['shoe_name'];
                $desc = $row['description'];
                $price = $row['price'];
                $size = $row['size'];
                $image = $row['image'];
                $catid = $row['category_id'];
                $cid = $row['created_by'];
                $cdate = $row['created_at'];
                $uid = $row['updated_by'];
                $udate = $row['updated_at'];

                $catname = CategoryData::GetCategory($catid)['category_name'];
                $cname = UsersData::GetOneUser($cid)['first_name'];
                $uname = UsersData::GetOneUser($uid)['first_name'];
                $cdate = date("d/m/Y", strtotime($cdate));
                if ($udate !== NULL){
                    $udate = date("d/m/Y", strtotime($udate));
                }

                echo "<tr>
                        <td>$shoeid</td><td>$code</td><td>$sname</td><td>$desc</td><td>$price,00</td><td>$size</td><td>$catname</td><td>
                        <img alt='no_image' src='$image' width='100' height='100' />
                        </td><td>$cname</td><td>$cdate</td><td>$uname</td><td>$udate</td>
                    </tr>";
                
            }

            echo "</table>
            </div>";

        } else {
            echo "<p class='lead text-white'>We have sold out all shoes!</p>";
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
}

?>