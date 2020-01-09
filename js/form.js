$(document).ready(function() {
    //
    let errorMessage = document.querySelector('#errorMessage');
    let email;
    let pass;
    let name;
    let nameTrim;
    let nameText;
    let fnameText = "Your first name must be between 2 and 25 characters!";
    let lnameText = "Your last name must be between 2 and 25 characters!";
    let code;
    let codeTrim;
    let codeText = "Code must have 10 characters";
    let sname;
    let snameTrim;
    let snameText = "Your shoe name must be between 2 and 50 characters!";
    let desc;
    let descTrim;
    let descText = "Your shoe description must be between 2 and 200 characters!";
    let cat;
    let catTrim;
    let catText = "Your category name must be between 2 and 50 characters!";
    let discText = "Discount name must be between 2 and 50 characters";
    let numberRegex = /^[0-9]+$/;
    let priceTrim;
    let priceText = "Price can only contain numbers";
    let sizeText = "Size can only contain numbers";
    let discIdText = "Discount id can only contain numbers";
    let image;
    let ext;
    let imageText = "Extention must be JPEG, PNG or JPG!";
    let dateText = "Invalid date";
    let type;
    let typeText = "Please select Authorization type";

    // slide up and down
    $("#update").click(function() {
        $("#first").slideUp("slow", function() {
            $("#second").slideDown("slow");
        })
    });
    
    $("#add").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        })
    });

    // provera mejla
    $('#log_email').keyup(function() {
        email = $("#log_email").val().trim();
        CheckEmail();
    });

    $('#reg_email').keyup(function() {
        email = $("#reg_email").val().trim();
        CheckEmail();
    });

    $('#reg_email2').keyup(function() {
        email = $("#reg_email2").val().trim();
        CheckEmail();
    });

    // provera duzine sifre
    $('#log_password').keyup(function() {
        pass = $("#log_password").val().trim();
        CheckPass();
    });

    $('#reg_password').keyup(function() {
        pass = $("#reg_password").val().trim();
        CheckPass();
    });

    $('#reg_password2').keyup(function() {
        pass = $("#reg_password2").val().trim();
        CheckPass();
    });

    $('#profile_password').keyup(function() {
        pass = $("#profile_password").val().trim();
        CheckPass();
    });

    $('#new_password').keyup(function() {
        pass = $("#new_password").val().trim();
        CheckPass();
    });

    $('#new_password2').keyup(function() {
        pass = $("#new_password2").val().trim();
        CheckPass();
    });

    // provera duzine imena i prezimena
    $('#reg_fname').keyup(function() {
        name = $('#reg_fname');
        nameTrim = $('#reg_fname').val().trim();
        nameText = fnameText;
        CheckName();
    });

    $('#reg_lname').keyup(function() {
        name = $('#reg_lname');
        nameTrim = $('#reg_lname').val().trim();
        nameText = lnameText;
        CheckName();

    });

    $('#update_fname').keyup(function() {
        name = $('#update_fname');
        nameTrim = $('#update_fname').val().trim();
        nameText = fnameText;
        CheckName();
    });

    $('#update_lname').keyup(function() {
        name = $('#update_lname');
        nameTrim = $('#update_lname').val().trim();
        nameText = lnameText;
        CheckName();
    });

    // provera duzine koda
    $('#code_adding').keyup(function() {
        code = $('#code_adding');
        codeTrim = $('#code_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCode();
    });

    $('#code_change').keyup(function() {
        code = $('#code_change');
        codeTrim = $('#code_change').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCode();
    });

    $('#shoe_1_adding').keyup(function() {
        code = $('#shoe_1_adding');
        codeTrim = $('#shoe_1_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCode();
    });

    $('#shoe_2_adding').keyup(function() {
        code = $('#shoe_2_adding');
        codeTrim = $('#shoe_2_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCode();
    });

    $('#shoe_1_new').keyup(function() {
        code = $('#shoe_1_new');
        codeTrim = $('#shoe_1_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCode();
    });

    $('#shoe_2_new').keyup(function() {
        code = $('#shoe_2_new');
        codeTrim = $('#shoe_2_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCode();
    });

    // provera imena cipele
    $('#shoe_adding').keyup(function() {
        sname = $('#shoe_adding');
        snameTrim = $('#shoe_adding').val().trim();
        snameText = snameText;
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckShoeName();
    });

    $('#shoe_new').keyup(function() {
        sname = $('#shoe_new');
        snameTrim = $('#shoe_new').val().trim();
        snameText = snameText;
        errorMessage = document.querySelector('#errorMessage');
        CheckShoeName();
    });

    // provera opisa
    $('#desc_adding').keyup(function() {
        desc = $('#desc_adding');
        descTrim = $('#desc_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckShoeDesc();
    });

    $('#desc_new').keyup(function() {
        desc = $('#desc_new');
        descTrim = $('#desc_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckShoeDesc();
    });

    // provera kategorije
    $('#cat_adding').keyup(function() {
        cat = $('#cat_adding');
        catTrim = $('#cat_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCategory();
    });

    $('#cat_new').keyup(function() {
        cat = $('#cat_new');
        catTrim = $('#cat_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCategory();
    });

    $('#cat_present').keyup(function() {
        cat = $('#cat_present');
        catTrim = $('#cat_present').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCategory();
    });

    // provera imena rasprodaje
    $('#disc_adding').keyup(function() {
        sname = $('#disc_adding');
        snameTrim = $('#disc_adding').val().trim();
        snameText = discText;
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckShoeName();
    });

    $('#disc_new').keyup(function() {
        sname = $('#disc_new');
        snameTrim = $('#disc_new').val().trim();
        snameText = discText;
        errorMessage = document.querySelector('#errorMessage');
        CheckShoeName();
    });

    // provera cene
    $('#price_adding').keyup(function() {
        priceTrim = $('#price_adding').val().trim();
        priceText = priceText;
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckPrice();
    });

    $('#price_new').keyup(function() {
        priceTrim = $('#price_new').val().trim();
        priceText = priceText;
        errorMessage = document.querySelector('#errorMessage');
        CheckPrice();
    });

    $('#disc_price_adding').keyup(function() {
        priceTrim = $('#disc_price_adding').val().trim();
        priceText = priceText;
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckPrice();
    });

    $('#disc_price_new').keyup(function() {
        priceTrim = $('#disc_price_new').val().trim();
        priceText = priceText;
        errorMessage = document.querySelector('#errorMessage');
        CheckPrice();
    });

    // provera velicine cipele
    $('#size_adding').keyup(function() {
        sizeTrim = $('#size_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckSize();
    });

    $('#size_adding').keyup(function() {
        sizeTrim = $('#size_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckSize();
    });

    $('#size_new').keyup(function() {
        sizeTrim = $('#size_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckSize();
    });

    // provera id rasprodaje
    $('#disc_id_new').keyup(function() {
        sizeTrim = $('#disc_id_new').val().trim();
        sizeText = discIdText;
        errorMessage = document.querySelector('#errorMessage');
        CheckSize();
    });

    // provera slike
    $('#shoe_image').change(function() {

        image = $('#shoe_image');
        ext =  image.val().split('.').pop().toLowerCase();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckImage();
    });

    $('#image_new').change(function() {

        image = $('#image_new');
        ext =  image.val().split('.').pop().toLowerCase();
        errorMessage = document.querySelector('#errorMessage');
        CheckImage();
    });

    // provera datuma
    $('#start_adding').change(function() {

        date = $('#start_adding').val();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckDate();
    });

    $('#end_adding').change(function() {

        date = $('#end_adding').val();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckDate();
    });

    $('#start_new').change(function() {

        date = $('#start_new').val();
        errorMessage = document.querySelector('#errorMessage');
        CheckDate();
    });

    $('#end_new').change(function() {

        date = $('#end_new').val();
        errorMessage = document.querySelector('#errorMessage');
        CheckDate();
    });

    // provera tipa
    $('#reg_type').change(function() {

        type = $('#reg_type').val();
        errorMessage = document.querySelector('#errorMessage');
        CheckType();
        
    });

    $('#update_type').change(function() {

        type = $('#update_type').val();
        errorMessage = document.querySelector('#errorMessage');
        CheckType();
        
    });





function CheckEmail(){

    if (email.lastIndexOf(".") < email.indexOf("@") || email.indexOf("@") ===-1 || email.lastIndexOf(".") ===-1 ) {
       errorMessage.textContent = "Invalid email adress!"
       return false; 
    } else {
        errorMessage.textContent = "";
    }
}

function CheckPass(){

    if (pass.length <5 || pass.length >30 ) {
       errorMessage.textContent = "Your password must be between 5 and 30 characters!";
       return false; 
    } else {
        errorMessage.textContent = "";
    }
}

function CheckName(){

    name.val(nameTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
    if (nameTrim.length > 25 || nameTrim.length < 2) {
        errorMessage.textContent = nameText;
        return false;
    } else {
        errorMessage.textContent = "";
    }  
}

function CheckCode(){

    code.val(codeTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
    if (codeTrim.length !== 10) {
        errorMessage.textContent = codeText;
        return false;
    } else {
        errorMessage.textContent = "";
    }   
}

function CheckShoeName(){

    sname.val(snameTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
    if (snameTrim.length > 50 || snameTrim.length < 2) {
        errorMessage.textContent = snameText;
        return false;
    } else {
        errorMessage.textContent = "";
    }
}

function CheckShoeDesc(){

    desc.val(descTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
    if (descTrim.length > 200 || descTrim.length < 2) {
        errorMessage.textContent = descText;
        return false;
    } else {
        errorMessage.textContent = "";
    }     
}

function CheckCategory(){

    cat.val(catTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
    if (catTrim.length > 50 || catTrim.length < 2) {
        errorMessage.textContent = catText;
        return false;
    } else {
        errorMessage.textContent = "";
    }
}

function CheckPrice(){

    if (!priceTrim.match(numberRegex) || !Math.floor(priceTrim) === priceTrim){
        errorMessage.textContent = priceText;
        return false;
    } else {
        errorMessage.textContent = "";
    }
}

function CheckSize(){

    if (!sizeTrim.match(numberRegex) || !Math.floor(sizeTrim) === sizeTrim){
        errorMessage.textContent = sizeText;
        return false;
    } else {

    }
}

function CheckImage() {

    if (image.get(0).files.length !== 0 && (ext !== "png" && ext !== "jpeg" && ext !== "jpg")){
        errorMessage.textContent = imageText;
        return false;
    } else {
        errorMessage.textContent = "";
    }  
}

function CheckDate(){
    let parsedIsoDate = moment(date, ['YYYY-MM-DD'], true).format('YYYY-MM-DD');
    if (parsedIsoDate !== date){
        errorMessage.textContent = dateText;
        return false;
    } else {
        errorMessage.textContent = "";
    }
}

function CheckType(){
    if (type !== "worker" && type !== "admin") {
        errorMessage.textContent = typeText;    
        return false;   
    }
    else {
        errorMessage.textContent = "";
    }
}
});

