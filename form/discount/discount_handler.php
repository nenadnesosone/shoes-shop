<?php
    require_once 'data/usersdata.php';
    require_once 'data/shoesdata.php';
    require_once 'data/discountdata.php';

    //Deklarisanje varijabli
    $discid = "";
    $dname = "";
    $sdate = "";
    $edate = "";
    $shoe1 = "";
    $shoe2 = "";
    $dprice = "";
    $cdate = date("Y-m-d");//uzima trenutni datum
    $udate = date("Y-m-d");//uzima trenutni datum
    $ddate = date("Y-m-d");//uzima trenutni datum
    $cid = $_SESSION['usersid'];
    $uid = $_SESSION['usersid'];
    $did = $_SESSION['usersid'];
    $error_array = array();

    if (isset($_POST['add_disc'])) {


            //naziv rasprodaje
            $dname = ucfirst(strtolower(UsersData::sanit($_POST['disc_adding'])));// uklanjamo html elemente i razmake, ostavlja samo prvo slovo veliko
            $_SESSION['disc_adding'] = $dname; //cuva se u sesiji ime

            // start datum
            $sdate = $_POST['start_adding'];
            $_SESSION['start_adding'] = $sdate; 

            // end datum
            $edate = $_POST['end_adding'];
            $_SESSION['end_adding'] = $edate; 

            // cipela 1
            $shoe1 = UsersData::sanit($_POST['shoe_1_adding']);// uklanjamo html elemente i razmake
            $_SESSION['shoe_1_adding'] = $shoe1;

            // cipela 2
            $shoe2 = UsersData::sanit($_POST['shoe_2_adding']);// uklanjamo html elemente i razmake
            $_SESSION['shoe_2_adding'] = $shoe2;

            // cena
            $dprice = number_format(UsersData::sanit($_POST['disc_price_adding']), 2);// uklanjamo html elemente i razmake, pretvara u number format
            $_SESSION['disc_price_adding'] = $dprice;
               
            // provera duzine naziva
            if (strlen($dname)>50 || strlen($dname)<2) {
                array_push($error_array,  "Discount name must be between 2 and 50 characters");
            } 

            // start datum
            else if (!DiscountData::ValDate($sdate, $format = 'Y-m-d') > 0) {
                array_push($error_array, "Invalid date");
            } else if ($cdate > $sdate){
                array_push($error_array, "Start discount date can't start before today");
            }

            //end datum
            else if (!DiscountData::ValDate($edate, $format = 'Y-m-d') > 0) {
                array_push($error_array, "Invalid date");
            }else if ($sdate > $edate){
                array_push($error_array, "End discount date can't be before start discount date");
            }

            //code moze da sadrzi samo slova i brojeve i mora da ima tacno 10 karaktera i da postoji u bazi
            else if (strlen($shoe1) !== 10) {
                array_push($error_array, "Code must have 10 characters"); 
            }else if (preg_match('/[^A-Za-z0-9]/', $shoe1)) {
                array_push($error_array,  "Code can only contain english characters and numbers");
            } else if (!ShoesData::CheckCode($shoe1)){
                array_push($error_array,  "Code doesn't exists in the database");
            }

            //code moze da sadrzi samo slova i brojeve i mora da ima tacno 10 karaktera i da postoji u bazi
            else if (strlen($shoe2) !== 10) {
            array_push($error_array, "Code must have 10 characters"); 
            }else if (preg_match('/[^A-Za-z0-9]/', $shoe2)) {
                array_push($error_array,  "Code can only contain english characters and numbers");
            } else if (!ShoesData::CheckCode($shoe2)){
                array_push($error_array,  "Code doesn't exists in the database");
            } 
            // moraju biti razlicite cipele
            else if ($shoe1 === $shoe2){
                array_push($error_array,  "Code of Shoe 1 and Shoe 2 must be different");
            }

            //price moze da sadrzi samo brojeve i mora da bude u odgovarajucem rasponu
            else if (preg_match('/^[0-9]+$/', $dprice)) {
                array_push($error_array,  "Price can only contain numbers");
            } else if (!in_array($dprice, range(1,100000))){
                array_push($error_array,  "Price must be between 1 and 100000");
            } 
            
            else if (empty($error_array)) {

                // uzimamo id od cipela
                $shoe1 = ShoesData::GetOneShoe($shoe1)['shoe_id'];
                $shoe2 = ShoesData::GetOneShoe($shoe2)['shoe_id'];
                $dprice = intval($dprice);
                //unos podataka u bazu
                DiscountData::CreateDiscount($dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $cdate, $cid);
        
                array_push($error_array, "You have added new discount!");
                
                //brisanje podataka iz sesije
                unset($_SESSION['disc_adding']);
                unset($_SESSION['start_adding']);
                unset($_SESSION['end_adding']);
                unset($_SESSION['shoe_1_adding']);
                unset($_SESSION['shoe_2_adding']);
                unset($_SESSION['disc_price_adding']);
  
            }
        
    }
        
    if ((isset($_POST['update_disc'])) or (isset($_POST['delete_disc']))) {
        
            $discid = number_format(UsersData::sanit($_POST['disc_id_new']), 2);// uklanjamo html elemente i razmake, pretvara u number format
            $_SESSION['disc_id_new'] = $discid;

            //id moze da sadrzi samo brojeve
            if (preg_match('/^[0-9]+$/', $discid)) {
                array_push($error_array,  "Discount id can only contain numbers");
            }

            $discid = intval($discid);
        
            if(isset($_POST['delete_disc'])){

            //brisemo rasprodaju i brisemo podatke iz sesije

            DiscountData::DeleteDiscount($discid, $ddate, $did);
            array_push($error_array, "You have deleted discount!");
            unset($_SESSION['disc_id_new']);

            } else {

                $row = DiscountData::GetOneDiscount($discid);
                $dname = $row['discount_name'];
                $sdate = $row['start_date'];
                $edate = $row['end_date'];
                $shoe1 = $row['shoe_1'];
                $shoe2 = $row['shoe_2'];
                $dprice = $row['price'];

                if(!empty($_POST['disc_new'])){

                    //naziv rasprodaje
                    $newdname = ucfirst(strtolower(UsersData::sanit($_POST['disc_new'])));// uklanjamo html elemente i razmake, ostavlja samo prvo slovo veliko
                    $_SESSION['disc_new'] = $newdname; //cuva se u sesiji naziv

                    // provera duzine naziva
                    if (strlen($newdname)>50 || strlen($newdname)<2) {
                        array_push($error_array,  "Discount name must be between 2 and 50 characters");
                    } else {
            
                    $dname = $newdname;
                
                    // menjamo podatke u bazi i brisemo podatke iz sesije
                    DiscountData::UpdateDiscount($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $udate, $uid);
                    array_push($error_array, "You have updated discount name!");
                    unset($_SESSION['disc_new']);

                    }
                    
                }

                if(!empty($_POST['start_new'])){

                    // start datum
                    $newsdate = $_POST['start_new'];
                    $_SESSION['start_new'] = $newsdate; 

                    // start datum
                    if (!DiscountData::ValDate($newsdate, $format = 'Y-m-d') > 0) {
                        array_push($error_array, "Invalid date");
                    } else if ($cdate > $newsdate){
                        array_push($error_array, "Start discount date can't start before today");
                    } else {
            
                    $sdate = $newsdate;
                
                    // menjamo podatke u bazi i brisemo podatke iz sesije
                    DiscountData::UpdateDiscount($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $udate, $uid);
                    array_push($error_array, "You have updated discount start date!");
                    unset($_SESSION['start_new']);

                    }
                    
                }

                if(!empty($_POST['end_new'])){

                    // start datum
                    $newedate = $_POST['end_new'];
                    $_SESSION['end_new'] = $newedate; 

                    // start datum
                    if (!DiscountData::ValDate($newedate, $format = 'Y-m-d') > 0) {
                        array_push($error_array, "Invalid date");
                    } else if ($sdate > $newedate){
                        array_push($error_array, "End discount date can't be before start date");
                    } else {
        
                    $edate = $newedate;
                
                    // menjamo podatke u bazi i brisemo podatke iz sesije
                    DiscountData::UpdateDiscount($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $udate, $uid);
                    array_push($error_array, "You have updated discount end date!");
                    unset($_SESSION['end_new']);

                    }
                    
                }

                if(!empty($_POST['shoe_1_new'])){

                    // cipela 1
                    $newshoe1 = UsersData::sanit($_POST['shoe_1_new']);// uklanjamo html elemente i razmake
                    $_SESSION['shoe_1_new'] = $newshoe1;

                    //code moze da sadrzi samo slova i brojeve i mora da ima tacno 10 karaktera i da postoji u bazi
                    if (strlen($newshoe1) !== 10) {
                        array_push($error_array, "Code must have 10 characters"); 
                    }else if (preg_match('/[^A-Za-z0-9]/', $newshoe1)) {
                        array_push($error_array,  "Code can only contain english characters and numbers");
                    } else if (!ShoesData::CheckCode($newshoe1)){
                        array_push($error_array,  "Code doesn't exists in the database");
                    }
                    // moraju biti razlicite cipele
                    else if (ShoesData::GetOneShoe($newshoe1)['shoe_id'] === $shoe2){
                        array_push($error_array,  "Code of Shoe 1 and Shoe 2 must be different");
                    } else {
            
                    $shoe1 = ShoesData::GetOneShoe($newshoe1)['shoe_id'];
                
                    // menjamo podatke u bazi i brisemo podatke iz sesije
                    DiscountData::UpdateDiscount($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $udate, $uid);
                    array_push($error_array, "You have updated discount shoe 1!");
                    unset($_SESSION['shoe_1_new']);

                    }
                }

                if(!empty($_POST['shoe_2_new'])){

                    // cipela 2
                    $newshoe2 = UsersData::sanit($_POST['shoe_2_new']);// uklanjamo html elemente i razmake
                    $_SESSION['shoe_2_new'] = $newshoe2;

                    //code moze da sadrzi samo slova i brojeve i mora da ima tacno 10 karaktera i da postoji u bazi
                    if (strlen($newshoe2) !== 10) {
                        array_push($error_array, "Code must have 10 characters"); 
                    }else if (preg_match('/[^A-Za-z0-9]/', $newshoe2)) {
                        array_push($error_array,  "Code can only contain english characters and numbers");
                    } else if (!ShoesData::CheckCode($newshoe2)){
                        array_push($error_array,  "Code doesn't exists in the database");
                    } else {
            
                    $shoe2 = ShoesData::GetOneShoe($newshoe2)['shoe_id'];
                
                    // menjamo podatke u bazi i brisemo podatke iz sesije
                    DiscountData::UpdateDiscount($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $udate, $uid);
                    array_push($error_array, "You have updated discount shoe 2!");
                    unset($_SESSION['shoe_2_new']);

                    }
                }

                if(!empty($_POST['disc_price_new'])){

                    // cena
                    $newdprice = number_format(UsersData::sanit($_POST['disc_price_new']), 2);// uklanjamo html elemente i razmake, pretvara u number format
                    $_SESSION['disc_price_new'] = $newdprice;

                    //price moze da sadrzi samo brojeve i mora da bude u odgovarajucem rasponu
                    if (preg_match('/^[0-9]+$/', $newdprice)) {
                        array_push($error_array,  "Price can only contain numbers");
                    } else if (!in_array($newdprice, range(1,100000))){
                        array_push($error_array,  "Price must be between 1 and 100000");
                    } else {
            
                        $dprice = intval ($newdprice);

                        // menjamo podatke u bazi i brisemo podatke iz sesije
                        DiscountData::UpdateDiscount($discid, $dname, $sdate, $edate, $shoe1, $shoe2, $dprice, $udate, $uid);
                        array_push($error_array, "You have updated discount price!");
                        unset($_SESSION['disc_price_new']);
                    }

                    
                }
            }
    } 




?>