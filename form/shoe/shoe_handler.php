<?php
    require_once 'data/usersdata.php';
    require_once 'data/shoesdata.php';
    require_once 'data/categorydata.php';

    //Deklarisanje varijabli
    $code = "";
    $sname = "";
    $newsname = "";
    $desc = "";
    $newdesc = "";
    $price = "";
    $newprice = "";
    $size = "";
    $newsize = "";
    $image = "";
    $catid = "";
    $catname = "";
    $newimage = "";
    $uploadOK = 0;
    $cdate = date("Y-m-d");//uzima trenutni datum
    $udate = date("Y-m-d");//uzima trenutni datum
    $ddate = date("Y-m-d");//uzima trenutni datum
    $cid = $_SESSION['usersid'];
    $uid = $_SESSION['usersid'];
    $did = $_SESSION['usersid'];
    $error_array = array();

    if (isset($_POST['add_shoe'])) {


            // code
            $code = UsersData::sanit($_POST['code_adding']);// uklanjamo html elemente i razmake
            $_SESSION['code_adding'] = $code;

            //naziv cipele
            $sname = ucfirst(strtolower(UsersData::sanit($_POST['shoe_adding'])));// uklanjamo html elemente i razmake, ostavlja samo prvo slovo veliko
            $_SESSION['shoe_adding'] = $sname; //cuva se u sesiji ime

            // opis
            $desc = UsersData::sanittrim($_POST['desc_adding']);// uklanjamo html elemente i razmake
            $_SESSION['desc_adding'] = $desc;

            // cena
            $price = number_format(UsersData::sanit($_POST['price_adding']), 2);// uklanjamo html elemente i razmake, pretvara u number format
            $_SESSION['price_adding'] = $price;
        
            // velicina cipela
            $size = number_format(UsersData::sanit($_POST['size_adding']), 2);// uklanjamo html elemente i razmake, pretvara u number format
            $_SESSION['size_adding'] = $size;

            $catname = ucfirst(strtolower(UsersData::sanit($_POST['cat_shoe_adding'])));// uklanjamo html elemente i razmake, ostavlja samo prvo slovo veliko
            $_SESSION['cat_shoe_adding'] = $catname;


            //code moze da sadrzi samo slova i brojeve i mora da ima tacno 10 karaktera
            if (strlen($code) !== 10) {
                array_push($error_array, "Code must have 10 characters"); 
                }else if (preg_match('/[^A-Za-z0-9]/', $code)) {
                    array_push($error_array,  "Code can only contain english characters and numbers");
                } else if (ShoesData::CheckCode($code)){
                    array_push($error_array,  "Code exists in the database");
                }
            
            // provera duzine naziva
            else if (strlen($sname)>50 || strlen($sname)<2) {
                array_push($error_array,  "Shoe name must be between 2 and 50 characters");
            }

            // provera duzine opisa
            else if (strlen($desc)>200 || strlen($desc)<2) {
                array_push($error_array,  "Shoe description must be between 2 and 200 characters");
            }

            //price moze da sadrzi samo brojeve i mora da bude u odgovarajucem rasponu
            else if (preg_match('/^[0-9]+$/', $price)) {
                array_push($error_array,  "Price can only contain numbers");
            } else if (!in_array($price, range(1,100000))){
                array_push($error_array,  "Price must be between 1 and 100000");
            } 
            
        
            //size moze da sadrzi samo brojeve i mora da bude u odgovarajucem rasponu
            else if (preg_match('/^[0-9]+$/', $size)) {
                array_push($error_array,  "Size can only contain numbers");
            } else if (!in_array($size, range(1,99))){
                array_push($error_array,  "Size must be between 1 and 99");
            }
            

            // kategorija mora da ima odgovarajucu duzinu i da postoji u bazi
            else if (strlen($catname)>50 || strlen($catname)<2) {
                array_push($error_array,  "Category name must be between 2 and 50 characters");
            } else if (!CategoryData::CheckCategory($catname)) {
                array_push($error_array,"Category name doesn't exist in the database");
            }
            

            // ako postoji fajl
            else if (isset($_FILES['shoe_image'])){

                $file_name = $_FILES['shoe_image']['name'];
                $file_size = $_FILES['shoe_image']['size'];
                $file_tmp = $_FILES['shoe_image']['tmp_name'];
                $file_type =  $_FILES['shoe_image']['type'];
                $splitParts = explode('.',  $_FILES['shoe_image']['name']);
                $file_ext = strtolower(end($splitParts));
                $exts = array("jpg", "jpeg", "png");
                $imagename = $code. '.'.$file_ext;
                $image_location = "images/shoes/" .$imagename; // gde cemo staviti sliku kad je ucitamo
                
                //proveravamo da li je fajl prazan
                if($file_size == 0) {
                    $uploadOK = 0;
                // proveravamo da li je extenzija dobra
                }else if(in_array($file_ext, $exts) === false){
                    array_push($error_array,"Extention must be JPEG, PNG or JPG!");
                    $uploadOK = 0;
                } else {
                    $uploadOK = 1;
                }
                if($uploadOK !== 0){
                    if(file_exists($image_location)){ 
                        // brisemo predhodnu sliku ako je bilo takve slike s istim codom (ne bi trebalo posto smo prethodno proverili da li kod postoji u bazi)
                        unlink($image_location);
                    }
                    // vrsi se upload u odredjeni folder
                    move_uploaded_file($file_tmp, $image_location);
                    $image = $image_location;
                    $_SESSION['image_adding'] = $image;
                    $catid = CategoryData::GetOneCategory($catname)['category_id'];
                    $price = intval ($price);
                    $size = intval ($size);
                    
                }

            }
            
            if (empty($error_array)) {

                //unos podataka u bazu
                ShoesData::CreateShoe($code, $sname, $desc, $price, $size, $image, $catid, $cdate, $cid);
            
                //unos podataka u bazu
                array_push($error_array, "You have added new shoe!");

                //brisanje podataka iz sesije
                unset($_SESSION['code_adding']);
                unset($_SESSION['shoe_adding']);
                unset($_SESSION['desc_adding']);
                unset($_SESSION['price_adding']);
                unset($_SESSION['size_adding']);
                unset($_SESSION['image_adding']);
                unset($_SESSION['cat_shoe_adding']);
            }
        
    }
        
    if ((isset($_POST['update_shoe'])) or (isset($_POST['delete_shoe']))) {
        
            $code = UsersData::sanit($_POST['code_change']);
        
            //code moze da sadrzi samo slova i brojeve i mora da ima tacno 10 karaktera
            if (strlen($code) !== 10) {
            array_push($error_array, "Code must have 10 characters"); 
            }else if (preg_match('/[^A-Za-z0-9]/', $code)) {
                array_push($error_array,  "Code can only contain english characters and numbers");
            } else if (!ShoesData::CheckCode($code)){
                array_push($error_array,  "Code doesn't exists in the database");
            }else{

        
            if(isset($_POST['delete_shoe'])){

                //brisemo cipelu i brisemo podatke iz sesije

                ShoesData::DeleteShoe($code, $ddate, $did);
                array_push($error_array, "You have deleted shoe!");

            } else {

                $row = ShoesData::GetOneShoe($code);
                $shoeid = $row['shoe_id'];
                $sname = $row['shoe_name'];
                $desc = $row['description'];
                $price = $row['price'];
                $size = $row['size'];
                $image = $row['image'];
                $catid = $row['category_id'];

                if(!empty($_POST['shoe_new'])){

                    // naziv cipele
                    $newsname = ucfirst(strtolower(UsersData::sanit($_POST['shoe_new']))); ///uklanja HTML elemente, razmake i ostavlja samo prvo slovo veliko
                    $_SESSION['shoe_new'] = $newsname;

                    // provera duzine naziva
                    if (strlen($newsname)>50 || strlen($newsname)<2) {
                        array_push($error_array,  "Shoe name must be between 2 and 50 characters");
                    } else {
            
                        $sname = $newsname;
                    
                        // menjamo podatke u bazi i brisemo podatke iz sesije
                        ShoesData::UpdateShoe($shoeid, $sname, $desc, $price, $size, $image, $catid, $udate, $uid);
                        array_push($error_array, "You have updated shoe name!");
                        unset($_SESSION['shoe_new']);
                    }
                    
                }

                if(!empty($_POST['desc_new'])){

                    // opis
                    $newdesc = UsersData::sanittrim($_POST['desc_new']); ///uklanja HTML elemente, razmake
                    $_SESSION['desc_new'] = $newdesc;

                    // provera duzine opisa
                    if (strlen($newdesc)>200 || strlen($newdesc)<2) {
                        array_push($error_array,  "Shoe description must be between 2 and 200 characters");
                    }
            
                        $desc = $newdesc;
                    
                        // menjamo podatke u bazi i brisemo podatke iz sesije
                        ShoesData::UpdateShoe($shoeid, $sname, $desc, $price, $size, $image, $catid, $udate, $uid);
                        array_push($error_array, "You have updated shoe description!");
                        unset($_SESSION['desc_new']);
                }

                if(!empty($_POST['price_new'])){

                    // cena
                    $newprice = number_format(UsersData::sanit($_POST['price_new']), 2); ///uklanja HTML elemente, razmake
                    $_SESSION['price_new'] = $newprice;

                    //price moze da sadrzi samo brojeve i mora da bude u odgovarajucem rasponu
                    if (preg_match('/^[0-9]+$/', $newprice)) {
                        array_push($error_array,  "Price can only contain numbers");
                    } else if (!in_array($newprice, range(1,100000))){
                        array_push($error_array,  "Price must be between 1 and 100000");
                    } 
            
                        $price = intval ($newprice);

                        // menjamo podatke u bazi i brisemo podatke iz sesije
                        ShoesData::UpdateShoe($shoeid, $sname, $desc, $price, $size, $image, $catid, $udate, $uid);
                        array_push($error_array, "You have updated shoe price!");
                        unset($_SESSION['price_new']);
                }
                if(!empty($_POST['size_new'])){

                    // velicina
                    $newsize = number_format(UsersData::sanit($_POST['size_new']), 2); ///uklanja HTML elemente, razmake
                    $_SESSION['size_new'] = $newprice;

                    //size moze da sadrzi samo brojeve i mora da bude u odgovarajucem rasponu
                    if (preg_match('/^[0-9]+$/', $newsize)) {
                        array_push($error_array,  "Size can only contain numbers");
                    } else if (!in_array($newsize, range(1,99))){
                        array_push($error_array,  "Size must be between 1 and 99");
                    }
            
            
                        $size = intval ($newsize);

                        // menjamo podatke u bazi i brisemo podatke iz sesije
                        ShoesData::UpdateShoe($shoeid, $sname, $desc, $price, $size, $image, $catid, $udate, $uid);
                        array_push($error_array, "You have updated shoe size!");
                        unset($_SESSION['size_new']);
                }

                if(!empty($_POST['cat_shoe_new'])){

                    // kategorija
                    $catname = ucfirst(strtolower(UsersData::sanit($_POST['cat_shoe_new'])));
                    $_SESSION['cat_shoe_new'] = $catname;

                    // kategorija mora da ima odgovarajucu duzinu i da postoji u bazi
                    if (strlen($catname)>50 || strlen($catname)<2) {
                        array_push($error_array,  "Category name must be between 2 and 50 characters");
                    } else if (!CategoryData::CheckCategory($catname)) {
                        array_push($error_array,"Category name doesn't exist in the database");
                    }
            
                    $catid = CategoryData::GetOneCategory($catname)['category_id'];
                        
                    // menjamo podatke u bazi i brisemo podatke iz sesije
                    ShoesData::UpdateShoe($shoeid, $sname, $desc, $price, $size, $image, $catid, $udate, $uid);
                    array_push($error_array, "You have updated shoe category!");
                    unset($_SESSION['cat_shoe_new']);
                }

                if (isset($_FILES['image_new'])){

                    $file_name = $_FILES['image_new']['name'];
                    $file_size = $_FILES['image_new']['size'];
                    $file_tmp = $_FILES['image_new']['tmp_name'];
                    $file_type =  $_FILES['image_new']['type'];
                    $splitParts = explode('.',  $_FILES['image_new']['name']);
                    $file_ext = strtolower(end($splitParts));
                    $exts = array("jpg", "jpeg", "png");
                    $imagename = $code. '.'.$file_ext;
                    $image_location = "images/shoes/" .$imagename; // gde cemo staviti sliku kad je ucitamo
                    
                    //proveravamo da li je fajl prazan
                    if($file_size == 0) {
                        $uploadOK = 0;
                    // proveravamo da li je extenzija dobra
                    }else if(in_array($file_ext, $exts) === false){
                        array_push($error_array,"Extention must be JPEG, PNG or JPG!");
                        $uploadOK = 0;
                    } else {
                        $uploadOK = 1;
                    }
                    if($uploadOK !== 0){
                        if(file_exists($image_location)){ 
                            // brisemo predhodnu sliku
                            unlink($image_location);
                        }
                        // vrsi se upload u odredjeni folder
                        move_uploaded_file($file_tmp, $image_location);
                        $image = $image_location;
                    
                    // menjamo podatke u bazi i brisemo podatke iz sesije
                    ShoesData::UpdateShoe($shoeid, $sname, $desc, $price, $size, $image, $catid, $udate, $uid);
                    array_push($error_array, "You have updated shoe image!");
                        
                    }
        
                }


                    
            }
        }
    } 




?>