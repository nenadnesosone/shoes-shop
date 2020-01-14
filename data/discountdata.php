<?php
  require_once 'data/usersdata.php';
  require_once 'data/shoesdata.php';
// klasa uz ciju pomoc cemo pristupati podacima o popustima
class DiscountData{


    // svojstva objekta
    public $discid;
    public $dname;
    public $sdate;
    public $edate;
    public $shoe1;
    public $shoe2;
    public $dprice;
    public $cdate;
    public $udate;
    public $ddate;
    public $cid;
    public $uid;
    public $did;
    public $deleted;


    // funkcija konstruktor
    public function __construct($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $cdate,$udate, $ddate, $cid, $uid, $did, $deleted)
    {
        $this->discid = $discid; 
        $this->dname = $dname;
        $this->sdate = $sdate;
        $this->edate = $edate;
        $this->shoe1 = $shoe1;
        $this->shoe2 = $shoe2;
        $this->dprice = $dprice;
        $this->cdate = $cdate;
        $this->udate = $udate;
        $this->ddate = $ddate;
        $this->cid = $cid;
        $this->uid = $uid;
        $this->did =$did;
        $this->deleted = $deleted;

    }

   // funcija koja ce prikupljati podatke o svim rasprodajama iz baze
   public static function GetAllDiscounts()
   {
       //povezujemo se s bazom
       $db = Database::getInstance()->getConnection();
       ///odaberemo sve 
       $query = "SELECT * FROM discount";

       $result = mysqli_query($db, $query);
       $num_rows = mysqli_num_rows($result);
       if ($num_rows > 0) {
            
        $data = [];
        while ($row = mysqli_fetch_assoc($result))
        {

            $row['start_date'] = date("d/m/Y", strtotime($row['start_date']));
            $row['end_date'] = date("d/m/Y", strtotime($row['end_date']));
            $row['shoe_1'] = ShoesData::GetShoe($row['shoe_1'])['shoe_name'];
            $row['shoe_2'] = ShoesData::GetShoe($row['shoe_2'])['shoe_name'];
            $cid = $row['created_by'] = UsersData::GetOneUser( $cid = $row['created_by'])['first_name'];
            $uid = $row['updated_by'] = UsersData::GetOneUser($uid = $row['updated_by'])['first_name'];
            $did = $row['deleted_by'] = UsersData::GetOneUser( $did = $row['deleted_by'])['first_name'];

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

   // funcija koja ce prikupljati podatke o svim rasprodajama iz baze
   public static function GetOneDiscount($discid)
   {
       //povezujemo se s bazom
       $db = Database::getInstance()->getConnection();
       ///odaberemo sve koji nisu obrisani, posto se obrisani nece prikazivani na frontendu
       $query = "SELECT * FROM discount WHERE discount_id = '$discid'";
       
       $result = mysqli_query($db, $query);
       if ($result) {
           $row = mysqli_fetch_assoc($result);
           return $row;
       } else {
           return [];
       }
   }

   // funkcija za ubacivanje korisnika u bazu
   public static function CreateDiscount($dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $cdate, $cid)
   {
       //povezujemo se s bazom
       $db = Database::getInstance()->getConnection();

       $query = "INSERT INTO discount (`discount_id`,`discount_name`,`start_date`,`end_date`,`shoe_1`,`shoe_2`,`price`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`, `deleted`) 
       VALUES (DEFAULT, '$dname', '$sdate','$edate','$shoe1','$shoe2','$dprice','$cdate', DEFAULT, DEFAULT, '$cid', DEFAULT, DEFAULT, DEFAULT)";

       $result = mysqli_query($db, $query);
       if ($result) {
           return true;
       } else {
           return false;
       }
   }

    // funkcija za brisanje rasprodaje iz baze "soft delete'
    public static function DeleteDiscount($discid, $ddate, $did)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade

        // brisanje rasprodaje iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE discount SET deleted_at = '$ddate', deleted_by = '$did', deleted = 1 WHERE discount_id = '$discid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za update rasprodaje
    public static function UpdateDiscount($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $udate, $uid)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade

        //  update rasprodaje u bazi	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE discount SET discount_name = '$dname', start_date = '$sdate', end_date = '$edate', shoe_1 = '$shoe1', shoe_2 = '$shoe2', price = $dprice, updated_at = '$udate', updated_by = '$uid' WHERE discount_id = '$discid'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function ValDate($date, $format = 'Y-m-d') 
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    // pretraga naziva rasprodaje
    public static function FindDiscount()
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        if (isset($_POST['submit_search'])) {

            $search = ucfirst(strtolower(UsersData::sanit($_POST['search'])));

            $query = "SELECT * FROM discount WHERE discount_name LIKE '%$search%'";

            $result = mysqli_query($db, $query);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows > 0) {

                updisc();
                echo "Matching Your Search";
                downdisc();
                while ($row = mysqli_fetch_assoc($result)){

                    $discid = $row['discount_id'];
                    $dname = $row['discount_name'];
                    $sdate = $row['start_date'];
                    $edate = $row['end_date'];
                    $shoe1 = $row['shoe_1'];
                    $shoe2 = $row['shoe_2'];
                    $dprice = $row['price'];
                    $cdate = $row['created_at'];
                    $udate = $row['updated_at'];
                    $cid = $row['created_by'];
                    $uid = $row['updated_by'];
                
                    $sdate = date("d/m/Y", strtotime($sdate));
                    $edate = date("d/m/Y", strtotime($edate));
                    $sname1 = ShoesData::GetShoe($shoe1)['shoe_name'];
                    $sname2 = ShoesData::GetShoe($shoe2)['shoe_name'];
                    $simage1 = ShoesData::GetShoe($shoe1)['image'];
                    $simage2 = ShoesData::GetShoe($shoe2)['image'];
                    $cname = UsersData::GetOneUser($cid)['first_name'];
                    $uname = UsersData::GetOneUser($uid)['first_name'];
                    $cdate = date("d/m/Y", strtotime($cdate));
                    if ($udate !== NULL){
                        $udate = date("d/m/Y", strtotime($udate));
                    }
        
                    echo "<tr>
                            <td>$discid</td><td>$dname</td><td>$sdate</td><td>$edate</td>
                            <td>$sname1</td><td><img alt='no_image' src='$simage1' width='100' height='100'/></td>
                            <td>$sname2</td><td><img alt='no_image' src='$simage2' width='100' height='100'/></td>
                            <td>$dprice,00</td><td>$cname</td><td>$cdate</td><td>$uname</td><td>$udate</td>
                        </tr>";
                    
                }
        
                echo "</table>
                </div>";
            } else {
                echo "<p class='lead text-white'>There are no results matching your search!</p>";
            }
        }
    }

}

// za prikazivanje tabele
function updisc()
{
    echo "<div class='table-responsive'>
            <table class='table table-primary table-bordered table-striped table-hover text-center'>
                <caption class='text-center'>All Discounts ";
}
// za prikazivanje tabele
function downdisc()
{
    echo "                          :</caption>
                <tr>
                    <th>Discount Id</th><th>Discount Name</th><th>Start Date Of Discount</th><th>End Date Of Discount</th><th>Discounted Shoe 1</th><th>Discounted Shoe 1 Image</th><th>Discounted Shoe 2</th><th>Discounted Shoe 2 Image</th><th>Price In Dinars</th><th>Created By</th><th>Created At</th><th>Updated By</th><th>Updated At</th>
                </tr>";
}

?>