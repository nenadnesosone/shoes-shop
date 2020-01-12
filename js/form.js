$(document).ready(function() {
    //
    let errorMessage = document.querySelector('#errorMessage');
    let [email, pass, pass1, pass2, name, nameTrim, code, codeTrim, sname, snameTrim, desc, cat, catTrim, priceTrim, type, ext, image, start, newStart, newEnd, disc] = [undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined];
    let fnameText = "Your first name must be between 2 and 25 characters!";
    let lnameText = "Your last name must be between 2 and 25 characters!";
    let snameText = "Your shoe name must be between 2 and 50 characters!";
    let discText = "Discount name must be between 2 and 50 characters";
    let startText = "Start discount date can't start before today date";
    let endText = "End discount date can't be before start discount date";
    let numberRegex = /^[0-9]+$/;
    let sizeText = "Size can only contain numbers";
    let today = new Date().toJSON().split('T')[0];
    let [OkLogEmail, OkLogPass] = [false, false];
    let [OkRegFname, OkRegLname, OkRegEmail, OkRegEmail2, OkRegType, OkRegPass, OkRegPass2] = [false, false, false, false, false, false, false];
    let [OkUpdatePass, OkNewFname, OkNewLname, OkNewType, OkNewPass, OkNewPass2] = [false, false, false, true, false, false];
    let [NewFnameEmpty, NewLnameEmpty, NewPassEmpty, NewPassEmpty2] = [true, true, true, true];
    let [OkAddCat, OkPresentCat, OkUpdateCat] = [false, false, false];
    let [OkShoeAdd, OkShoeName, OkShoeDesc, OkShoePrice, OkShoeSize, OkShoeCat, OkShoeImage] = [false, false, false, false, false, false, ];
    let [OkUpdateShoeCode, OkUpdateShoeName, OkUpdateShoeDesc, OkUpdateShoePrice, OkUpdateShoeSize, OkUpdateShoeCat, OkUpdateShoeImage] = [false, false, false, false, false, false, false];
    let [NewSnameEmpty, NewDescEmpty, NewPriceEmpty, NewSizeEmpty, NewCatEmpty, NewImageEmpty] = [true, true, true, true, true, true];
    let [OkDiscAdd, OkStartDate, OkEndDate, OkShoeCode1, OkShoeCode2, OkDiscPrice] = [false, false, false, false, false, false];
    let [OkUpdateDiscId, OkUpdateDName, OkStartDateUpdate, OkEndDateUpdate, OkUpdateShoe1, OkUpdateShoe2, OkUpdateDiscPrice] = [false, false, false, false, false, false, false];
    let [NewDnameEmpty, NewStartDateEmpty, NewEndDateEmpty, NewShoe1Empty, NewShoe2Empty, NewDiscPriceEmpty] = [true, true, true, true, true, true];

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

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValLog() {
        if (OkLogEmail && OkLogPass) {
            $("#login_button").prop("disabled", false);
        } else {
            $("#login_button").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValReg() {
        if (OkRegFname && OkRegLname && OkRegEmail && OkRegEmail2 && OkRegType && OkRegPass && OkRegPass2) {
            $("#register_button").prop("disabled", false);
        } else {
            $("#register_button").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValUpdate() {
        if (OkUpdatePass && (OkNewFname || NewFnameEmpty) && OkNewType && (OkNewLname || NewLnameEmpty) && ((OkNewPass || NewPassEmpty) && (OkNewPass2 || NewPassEmpty2)) ) {
            $("#update_button").prop("disabled", false);
        } else {
            $("#update_button").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValDelete() {
        if (OkUpdatePass) {
            $("#delete_button").prop("disabled", false);  
        } else {
            $("#delete_button").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValAddCat() {
        if (OkAddCat) {
            $("#add_category").prop("disabled", false);
        } else {
            $("#add_category").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValUpdateCat() {
        if (OkPresentCat && OkUpdateCat) {
            $("#update_category").prop("disabled", false);
        } else {
            $("#update_category").prop("disabled", true);
        }
    }

    function ValDeleteCat() {
        if (OkPresentCat) {
            $("#delete_category").prop("disabled", false);
        } else {
            $("#delete_category").prop("disabled", true);
        }
    }

     // funkcija za validaciju da li da se blokira ili odlblokira dugme
     function ValShoeAdd() {
        if (OkShoeAdd && OkShoeName && OkShoeDesc && OkShoePrice && OkShoeSize && OkShoeCat && OkShoeImage) {
            $("#add_shoe").prop("disabled", false);
        } else {
            $("#add_shoe").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValUpdateShoe() {
        if (OkUpdateShoeCode && (OkUpdateShoeName || NewSnameEmpty) && (OkUpdateShoeDesc || NewDescEmpty) && (OkUpdateShoePrice || NewPriceEmpty) && (OkUpdateShoeSize || NewSizeEmpty) && (OkUpdateShoeCat || NewCatEmpty) && (OkUpdateShoeImage || NewImageEmpty)) {
            $("#update_shoe").prop("disabled", false);
        } else {
            $("#update_shoe").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValDeleteShoe() {
        if (OkUpdateShoeCode) {
            $("#delete_shoe").prop("disabled", false);
        } else {
            $("#delete_shoe").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValDiscAdd() {
        if (OkDiscAdd && OkStartDate && OkEndDate && OkShoeCode1 && OkShoeCode2 && OkDiscPrice) {
            $("#add_disc").prop("disabled", false);
        } else {
            $("#add_disc").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValDiscUpdate() {
        if (OkUpdateDiscId && (OkUpdateDName || NewDnameEmpty) && (OkStartDateUpdate || NewStartDateEmpty) && (OkEndDateUpdate || NewEndDateEmpty) && (OkUpdateShoe1 || NewShoe1Empty) && (OkUpdateShoe2 || NewShoe2Empty) && (OkUpdateDiscPrice || NewDiscPriceEmpty)) {
            $("#update_disc").prop("disabled", false);
        } else {
            $("#update_disc").prop("disabled", true);
        }
    }

    // funkcija za validaciju da li da se blokira ili odlblokira dugme
    function ValDiscDelete() {
        if (OkUpdateDiscId) {
            $("#delete_disc").prop("disabled", false);
        } else {
            $("#delete_disc").prop("disabled", true);
        }
    }


    //provera mejla
    $('#log_email').keyup(function() {
        email = $("#log_email").val().trim();
        CheckEmail();
        if (CheckEmail()) {
            OkLogEmail = true;
        } else {
            OkLogEmail = false;
        }
        ValLog();
    });

    $('#reg_email').keyup(function() {
        email = $("#reg_email").val().trim();
        CheckEmail();
        if (CheckEmail()) {
            OkRegEmail = true;
            email1 = email;
        } else {
            OkRegEmail = false;
        }
        ValReg();
    });

    $('#reg_email2').keyup(function() {
        email = $("#reg_email2").val().trim();
        CheckEmail();
        if (CheckEmail()) {
            email2 = email;
            if (email1 === email2){
                OkRegEmail2 = true;
            } else {
                errorMessage.textContent = "Emails don't match";
                OkRegEmail2 = false;
            }
            

        } else {
            OkRegEmail2 = false;
        }
        ValReg();
    });

    // provera duzine sifre
    $('#log_password').keyup(function() {
        $('#log_password').val( $('#log_password').val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        pass = $("#log_password").val().trim();
        CheckPass();
        if (CheckPass()) {
            OkLogPass = true;
        } else {
            OkLogPass = false;
        }
        ValLog();
    });

    $('#reg_password').keyup(function() {
        $('#reg_password').val( $('#reg_password').val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        pass = $("#reg_password").val().trim();
        CheckPass();
        if (CheckPass()) {
            pass1 = pass;
            OkRegPass = true;
        } else {
            OkRegPass = false;
        }
        ValReg();
    });

    $('#reg_password2').keyup(function() {
        $('#reg_password2').val( $('#reg_password2').val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        pass = $("#reg_password2").val().trim();
        CheckPass();
        if (CheckPass()) {
            pass2 = pass;
            if (pass1 === pass2) {
                OkRegPass2 = true;
            } else {
                errorMessage.textContent = "Passwords don't match";
                OkRegPass2 = false;
            }
           
        } else {
            OkRegPass2 = false;
        }
        ValReg();
    });

    $('#profile_password').keyup(function() {
        $('#profile_password').val( $('#profile_password').val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        pass = $("#profile_password").val().trim();
        CheckPass();
        if(CheckPass()){
       
            OkUpdatePass = true;
        } else {
            OkUpdatePass = false;
        }
        ValUpdate();
        ValDelete();
    });

    $('#new_password').keyup(function() {
        $('#new_password').val( $('#new_password').val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        pass = $("#new_password").val().trim();
        CheckPass();
        if(CheckPass()) {
            OkNewPass = true;
            pass1 = pass;
            if (OkNewPass2 == false){
                NewPassEmpty == false;
                NewPassEmpty2 = false;
            }
        } else {
                if (pass.length == 0){
                    NewPassEmpty = true;
                } else {
                    NewPassEmpty = false;
                }
            OkNewPass = false;
        }
        ValUpdate();
    });

    $('#new_password2').keyup(function() {
        $('#new_password2').val( $('#new_password2').val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        pass = $("#new_password2").val().trim();
        CheckPass();
        if(CheckPass()) {
            pass2 = pass;
            if (pass1 === pass2) {
                OkNewPass2 = true;
            } else {
                errorMessage.textContent = "Passwords don't match";
                OkNewPass2 = false;
            }
        } else {
                if (pass.length == 0){
                    NewPassEmpty2 = true;
                } else {
                    NewPassEmpty2 = false;
                }
            OkNewPass2 = false;
        }
        ValUpdate();
    });

    // provera duzine imena i prezimena
    $('#reg_fname').keyup(function() {
        name = $('#reg_fname');
        nameTrim = $('#reg_fname').val().trim();
        nameText = fnameText;
        CheckName();
        if (CheckName()) {
            OkRegFname = true;
        } else {
            OkRegFname = false;
        }
        ValReg();
    });
    $('#reg_lname').keyup(function() {
        name = $('#reg_lname');
        nameTrim = $('#reg_lname').val().trim();
        nameText = lnameText;
        CheckName();
        if (CheckName()) {
            OkRegLname = true;
        } else {
            OkRegLname = false;
        }
        ValReg();
    });

    $('#update_fname').keyup(function() {
        name = $('#update_fname');
        nameTrim = $('#update_fname').val().trim();
        nameText = fnameText;
        CheckName();
        if(CheckName()) {
            OkNewFname = true;
        } else {
                if (nameTrim.length == 0){
                    NewFnameEmpty = true;
                } else {
                    NewFnameEmpty = false;
                }
            OkNewFname = false;
        }
        ValUpdate();  
    });

    $('#update_lname').keyup(function() {
        name = $('#update_lname');
        nameTrim = $('#update_lname').val().trim();
        nameText = lnameText;
        CheckName();
        if(CheckName()) {
            OkNewLname = true;
        } else {
                if (nameTrim.length == 0){
                    NewLnameEmpty = true;
                } else {
                    NewLnameEmpty = false;
                }
            OkNewLname = false;
        }
        ValUpdate();
    });

    // provera duzine koda
    $('#code_adding').keyup(function() {
        code = $('#code_adding');
        code.val(code.val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        codeTrim = $('#code_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCode();
        if (CheckCode()) {
            OkShoeAdd = true;
        } else {
            OkShoeAdd = false;
        }
        ValShoeAdd();
    });

    $('#code_change').keyup(function() {
        code = $('#code_change');
        code.val(code.val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        codeTrim = $('#code_change').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCode();
        if(CheckCode()){
            OkUpdateShoeCode = true;
        } else {
            OkUpdateShoeCode = false;
        }
        ValUpdateShoe();
        ValDeleteShoe();
    });

    $('#shoe_1_adding').keyup(function() {
        code = $('#shoe_1_adding');
        code.val(code.val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        codeTrim = $('#shoe_1_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCode();
        if (CheckCode()) {
            OkShoeCode1 = true;
        } else {
            OkShoeCode1 = false;
        }
        ValDiscAdd();
    });

    $('#shoe_2_adding').keyup(function() {
        code = $('#shoe_2_adding');
        code.val(code.val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        codeTrim = $('#shoe_2_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCode();
        if (CheckCode()) {
            OkShoeCode2 = true;
        } else {
            OkShoeCode2 = false;
        }
        ValDiscAdd();
    });

    $('#shoe_1_new').keyup(function() {
        code = $('#shoe_1_new');
        code.val(code.val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        codeTrim = $('#shoe_1_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCode();
        if (CheckCode()) {
            OkUpdateShoe1 = true;
        } else {
        codeTrim = $('#shoe_1_new').val().trim();
            if (codeTrim.length == 0){
                NewShoe1Empty = true;
            } else {
                NewShoe1Empty = false;
            }
            OkUpdateShoe1 = false;
        }
        ValDiscUpdate();
    });

    $('#shoe_2_new').keyup(function() {
        code = $('#shoe_2_new');
        code.val(code.val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        codeTrim = $('#shoe_2_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCode();
        if (CheckCode()) {
            OkUpdateShoe2 = true;
        } else {
        codeTrim = $('#shoe_1_new').val().trim();
            if (codeTrim.length == 0){
                NewShoe2Empty = true;
            } else {
                NewShoe2Empty = false;
            }
            OkUpdateShoe2 = false;
        }
        ValDiscUpdate();
    });

    // provera imena cipele
    $('#shoe_adding').keyup(function() {
        sname = $('#shoe_adding');
        snameTrim = $('#shoe_adding').val().trim();
        snameText = snameText;
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckShoeName();
        if (CheckShoeName()) {
            OkShoeName = true;
        } else {
            OkShoeName = false;
        }
        ValShoeAdd();

    });

    $('#shoe_new').keyup(function() {
        sname = $('#shoe_new');
        snameTrim = $('#shoe_new').val().trim();
        snameText = snameText;
        errorMessage = document.querySelector('#errorMessage');
        CheckShoeName();
        if(CheckShoeName()) {
            OkUpdateShoeName = true;
        } else {
                if (snameTrim.length == 0){
                    NewSnameEmpty = true;
                } else {
                    NewSnameEmpty = false;
                }
                OkUpdateShoeName = false;
        }
        ValUpdateShoe();
    });

    // provera opisa
    $('#desc_adding').keyup(function() {
        desc = $('#desc_adding');
        descTrim = $('#desc_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckShoeDesc();
        if (CheckShoeDesc()) {
            OkShoeDesc = true;
        } else {
            OkShoeDesc = false;
        }
        ValShoeAdd();
    });

    $('#desc_new').keyup(function() {
        desc = $('#desc_new');
        descTrim = $('#desc_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckShoeDesc();
        if(CheckShoeDesc()) {
            OkUpdateShoeDesc = true;
        } else {
                if (descTrim.length == 0){
                    NewDescEmpty = true;
                } else {
                    NewDescEmpty = false;
                }
                OkUpdateShoeDesc = false;
        }
        ValUpdateShoe();
    });

    // provera kategorije
    $('#cat_adding').keyup(function() {
        cat = $('#cat_adding');
        catTrim = $('#cat_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCategory();
        if (CheckCategory()) {
            OkAddCat = true;
        } else {
            OkAddCat = false;
        }
        ValAddCat();
    });

    $('#cat_present').keyup(function() {
        cat = $('#cat_present');
        catTrim = $('#cat_present').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCategory();
        if (CheckCategory()) {
            OkPresentCat = true;
        } else {
            OkPresentCat = false;
        }
        ValUpdateCat();
        ValDeleteCat();
    });

    $('#cat_new').keyup(function() {
        cat = $('#cat_new');
        catTrim = $('#cat_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCategory();
        if (CheckCategory()) {
            OkUpdateCat = true;
        } else {
            OkUpdateCat = false;
        }
        ValUpdateCat();
    });

    $('#cat_shoe_adding').keyup(function() {
        cat = $('#cat_shoe_adding');
        catTrim = $('#cat_shoe_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckCategory();
        if (CheckCategory()) {
            OkShoeCat = true;
        } else {
            OkShoeCat = false;
        }
        ValShoeAdd();
    });

    $('#cat_shoe_new').keyup(function() {
        cat = $('#cat_shoe_new');
        catTrim = $('#cat_shoe_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckCategory();
        if(CheckCategory()) {
            OkUpdateShoeCat = true;
        } else {
                if (catTrim.length == 0){
                    NewCatEmpty = true;
                } else {
                    NewCatEmpty = false;
                }
            OkUpdateShoeCat = false;
        }
        ValUpdateShoe();
    });

    // provera imena rasprodaje
    $('#disc_adding').keyup(function() {
        sname = $('#disc_adding');
        snameTrim = $('#disc_adding').val().trim();
        snameText = discText;
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckShoeName();
        if (CheckShoeName()) {
            OkDiscAdd = true;
        } else {
            OkDiscAdd = false;
        }
        ValDiscAdd();
    });

    $('#disc_new').keyup(function() {
        sname = $('#disc_new');
        snameTrim = $('#disc_new').val().trim();
        snameText = discText;
        errorMessage = document.querySelector('#errorMessage');
        CheckShoeName();
        if (CheckShoeName()) {
            OkUpdateDName = true;
        } else {
            if (snameTrim.length == 0){
                NewDnameEmpty = true;
            } else {
                NewDnameEmpty = false;
            }
            OkUpdateDName = false;
        }
        ValDiscUpdate();
    });

    // provera cene
    $('#price_adding').keyup(function() {
        priceTrim = $('#price_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckPrice();
        if (CheckPrice()) {
            OkShoePrice = true;
        } else {
            OkShoePrice = false;
        }
        ValShoeAdd();
    });

    $('#price_new').keyup(function() {
        priceTrim = $('#price_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckPrice();
        if (priceTrim.length !== 0){
            NewPriceEmpty = true;
            if(CheckPrice()) {
                OkUpdateShoePrice = true;
            } else {
                OkUpdateShoePrice = false;
            }
        } else {
            NewPriceEmpty = false;
        }
        ValUpdateShoe();
    });

    $('#disc_price_adding').keyup(function() {
        priceTrim = $('#disc_price_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckPrice();
        if (CheckPrice()) {
            OkDiscPrice = true;
        } else {
            OkDiscPrice = false;
        }
        ValDiscAdd();
    });

    $('#disc_price_new').keyup(function() {
        priceTrim = $('#disc_price_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckPrice();
        if (priceTrim.length !== 0){
            NewDiscPriceEmpty = true;
            if(CheckPrice()) {
                OkUpdateDiscPrice = true;
            } else {
                OkUpdateDiscPrice = false;
            }
        } else {
            NewDiscPriceEmpty = false;
        }
        ValDiscUpdate();
    });

    // provera velicine cipele
    $('#size_adding').keyup(function() {
        sizeTrim = $('#size_adding').val().trim();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckSize();
        if (CheckSize()) {
            OkShoeSize = true;
        } else {
            OkShoeSize = false;
        }
        ValShoeAdd();
    });

    $('#size_new').keyup(function() {
        sizeTrim = $('#size_new').val().trim();
        errorMessage = document.querySelector('#errorMessage');
        CheckSize();
        if (sizeTrim.length !== 0){
            NewSizeEmpty = true;
            if(CheckSize()) {
                OkUpdateShoeSize = true;
            } else {
                OkUpdateShoeSize = false;
            }
        } else {
            NewSizeEmpty = false;
        }
        ValUpdateShoe();
    });

    // provera id rasprodaje
    $('#disc_id_new').keyup(function() {
        disc = $('#disc_id_new');
        sizeTrim = disc.val().trim();
        sizeText = "Discount id can only contain numbers";
        errorMessage = document.querySelector('#errorMessage');
        CheckSize();
        if (CheckSize()) {
            OkUpdateDiscId = true;
        } else {
            OkUpdateDiscId = false;
        }
        ValDiscUpdate();
        ValDiscDelete();
    });

    // provera slike
    $('#shoe_image').change(function() {
        image = $('#shoe_image');
        ext =  image.val().split('.').pop().toLowerCase();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckImage();
        if (CheckImage()) {
            OkShoeImage = true;
        } else {
            OkShoeImage = false;
        }
        ValShoeAdd();
    });

    $('#image_new').change(function() {
        image = $('#image_new');
        ext =  image.val().split('.').pop().toLowerCase();
        errorMessage = document.querySelector('#errorMessage');
        CheckImage();
        if(CheckImage()) {
            OkUpdateShoeImage = true;
        } else {
                if (image.get(0).files.length == 0){
                    NewImageEmpty = true;
                } else {
                    NewImageEmpty = false;
                }
                OkUpdateShoeImage = false;
        }
        ValUpdateShoe();
    });

    // provera datuma
    $('#start_adding').change(function() {
        date = $('#start_adding').val();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckDate();
        if (CheckDate()) {
            if (today > date) {
                errorMessage.textContent = startText;
                OkStartDate = false;
            } else {
                start = date;
                OkStartDate = true;
            }
        } else {
            OkStartDate = false;
        }
        ValDiscAdd();
    });

    $('#end_adding').change(function() {
        date = $('#end_adding').val();
        errorMessage = document.querySelector('#errorMessageAdd');
        CheckDate();
        if (CheckDate()) {
            if (date < start){
                errorMessage.textContent = endText;
                OkEndDate = false;
            } else {
                OkEndDate = true;
            }
            
        } else {
            OkEndDate = false;
        }
        ValDiscAdd();
    });

    $('#start_new').change(function() {
        date = $('#start_new').val();
        errorMessage = document.querySelector('#errorMessage');
        CheckDate();
        if (CheckDate()) {
            newStart = date;
            if (today > newStart) {
                errorMessage.textContent = startText;
                OkStartDateUpdate = false;
                NewStartDateEmpty = false;
            } else if (newEnd !== undefined && newStart > newEnd){
                errorMessage.textContent = endText;
                OkStartDateUpdate = false;
                NewStartDateEmpty = false;
            } else {
                OkStartDateUpdate = true;
            }
            
            
        } else {
            if (date.length !== 0){
                NewStartDateEmpty = true;
            } else {
                NewStartDateEmpty = false;
            }
            OkStartDateUpdate = false;
        }
        ValDiscUpdate();
    });

    $('#end_new').change(function() {
        date = $('#end_new').val();
        errorMessage = document.querySelector('#errorMessage');
        CheckDate();
        if (CheckDate()) {
            newEnd = date;
            if (newStart !== undefined && newEnd < newStart) {
                errorMessage.textContent = endText;
                OkEndDateUpdate = false;
                NewEndDateEmpty = false;
            } else if(newStart === undefined && today > newEnd) {
                errorMessage.textContent = "End discount date can't be before today";
                OkEndDateUpdate = false;
                NewEndDateEmpty = false;
            } else {
                OkEndDateUpdate = true;
            }
        } else {
            if (date.length !== 0){
                NewEndDateEmpty = true;
            } else {
                NewEndDateEmpty = false;
            }
            OkEndDateUpdate = false;
        }
        ValDiscUpdate();
    });

    // provera tipa
    $('#reg_type').change(function() {
        type = $('#reg_type').val();
        errorMessage = document.querySelector('#errorMessage');
        CheckType();
        if (CheckType()) {
            OkRegType = true;
        } else {
            OkRegType = false;
        }
        ValReg();
    });

    $('#update_type').change(function() {
        type = $('#update_type').val();
        errorMessage = document.querySelector('#errorMessage');
        CheckType();
        if (CheckType()) {
            OkNewType = true;
        } else {
            OkNewType = false;
        }
        ValUpdate();
        
    });

    /// funkcije za proveru 
    function CheckEmail() {
        if (!email.match(/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/) ) {
        errorMessage.textContent = "Invalid email adress!";
        return false; 
        } else {
            errorMessage.textContent = "";
            return true;
        }
    }

    function CheckPass() {
        if (pass.length <5 || pass.length >30 ) {
        errorMessage.textContent = "Your password must be between 5 and 30 characters!";
        return false; 
        } else {
            errorMessage.textContent = "";
            return true;
        }
    }

    function CheckName() {
        name.val(nameTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        if (nameTrim.length > 25 || nameTrim.length < 2) {
            errorMessage.textContent = nameText;
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }  
    }

    function CheckCode() {
        code.val(codeTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        if (codeTrim.length !== 10) {
            errorMessage.textContent = "Code must have 10 characters";
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }   
    }

    function CheckShoeName() {
        sname.val(snameTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        if (snameTrim.length > 50 || snameTrim.length < 2) {
            errorMessage.textContent = snameText;
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }
    }

    function CheckShoeDesc() {
        desc.val(descTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        if (descTrim.length > 200 || descTrim.length < 2) {
            errorMessage.textContent = "Your shoe description must be between 2 and 200 characters!";
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }     
    }

    function CheckCategory() {
        cat.val(catTrim.replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
        if (catTrim.length > 50 || catTrim.length < 2) {
            errorMessage.textContent = "Your category name must be between 2 and 50 characters!";
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }
    }

    function CheckPrice() {
        if (!priceTrim.match(numberRegex) || !Math.floor(priceTrim) === priceTrim){
            errorMessage.textContent = "Price can only contain numbers";
            return false;
        } else if (priceTrim < 1 || priceTrim > 10000) {
            errorMessage.textContent = "Price must be between 1 and 100000";
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }
    }

    function CheckSize() {
        if (!sizeTrim.match(numberRegex) || !Math.floor(sizeTrim) === sizeTrim){
            errorMessage.textContent = sizeText;
            return false;
        } else if (disc ===  undefined && (sizeTrim < 1 || sizeTrim > 99)) {
            errorMessage.textContent = "Size must be between 1 and 99";;
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }
    }

    function CheckImage() {
        if (image.get(0).files.length !== 0 && (ext !== "png" && ext !== "jpeg" && ext !== "jpg")){
            errorMessage.textContent = "Extention must be JPEG, PNG or JPG!";
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }  
    }

    function CheckDate() {
        let parsedIsoDate = moment(date, ['YYYY-MM-DD'], true).format('YYYY-MM-DD');
        if (parsedIsoDate !== date){
            errorMessage.textContent = "Invalid date";
            return false;
        } else {
            errorMessage.textContent = "";
            return true;
        }
    }

    function CheckType() {
        if (type !== "worker" && type !== "admin") {
            errorMessage.textContent = "Please select authorization type";    
            return false;   
        }
        else {
            errorMessage.textContent = "";
            return true;
        }
    }
});

