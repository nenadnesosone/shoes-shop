<?php
require_once 'data/usersdata.php';
require_once 'data/categorydata.php';
//Deklarisanje varijabli

$catname = "";
$newcatname = "";
$cdate = date("Y-m-d");//uzima trenutni datum
$udate = date("Y-m-d");//uzima trenutni datum
$ddate = date("Y-m-d");//uzima trenutni datum
$cid = $_SESSION['usersid'];
$uid = $_SESSION['usersid'];
$did = $_SESSION['usersid'];
$error_array = array();

if (isset($_POST['add_category'])) {

    //naziv kategorije
    $catname = ucfirst(strtolower(UsersData::sanit($_POST['cat_adding'])));// uklanjamo html elemente i razmake, ostavlja samo prvo slovo veliko
    $_SESSION['cat_adding'] = $catname; //cuva se u sesiji ime

        //provera da li vec postoji u bazi i provera duzine naziva
    if (strlen($catname)>50 || strlen($catname)<2) {
        array_push($error_array,  "Category name must be between 2 and 50 characters");
    } else if (CategoryData::CheckCategory($catname)){
        array_push($error_array,  "Category name exist in the database");
    } 
    
    
    if (empty($error_array)) {

        //unos podataka u bazu
        CategoryData::CreateCategory($catname, $cdate, $cid);
    
        //unos podataka u bazu
        array_push($error_array, "You have added new category!");

        //brisanje podataka iz sesije
        unset($_SESSION['cat_adding']);
        
    }
}
    
if ((isset($_POST['update_category'])) or (isset($_POST['delete_category']))) {
    
    $catname = ucfirst(strtolower(UsersData::sanit($_POST['cat_present'])));// uklanjamo html elemente i razmake, ostavlja samo prvo slovo veliko
    $_SESSION['cat_present'] = $catname; //cuva se u sesiji ime
    

    //provera da li je dovoljne duzine i postoji naziv kategorije u bazi
    if (strlen($catname)>50 || strlen($catname)<2) {
        array_push($error_array,  "Category name must be between 2 and 50 characters");
    } else if (!CategoryData::CheckCategory($catname)) {
        array_push($error_array,"Category name doesn't exist in the database");
        
    }else{

       
        if(isset($_POST['delete_category'])){

            //brisemo kategoriju i brisemo podatke iz sesije
            CategoryData::DeleteCategory($catname, $ddate, $did);
            array_push($error_array, "You have deleted category!");
            unset($_SESSION['cat_present']);
        } else {
            if(!empty($_POST['cat_new'])){

                $newcatname = ucfirst(strtolower(UsersData::sanit($_POST['cat_new']))); ///uklanja HTML elemente, razmake i ostavlja samo prvo slovo veliko

                //provera duzine naziva kategorije, da li su nazivi isti i da li postoji u bazi
                if (strlen($newcatname)>50 || strlen($newcatname)<2) {
                    array_push($error_array, "Category name must be between 2 and 50 characters"); 
                }  else if ($catname === $newcatname) {
                    array_push($error_array,"Present and new category name must be different");
                } else if (!CategoryData::CheckCategory($catname)) {
                    array_push($error_array,"Category name doesn't exist in the database");
                    
                } else {
         
                    $catid = CategoryData::GetOneCategory($catname)['category_id'];
                    $catname = $newcatname;
                   
                    // menjamo podatke u bazi i brisemo podatke iz sesije
                    CategoryData::UpdateCategory($catid, $catname, $udate, $uid);
                    array_push($error_array, "You have updated category!");
                    unset($_SESSION['cat_present']);
                }
                
            }
           
        }

    } 
}




?>