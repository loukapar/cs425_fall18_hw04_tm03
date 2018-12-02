
(function ($) {
    "use strict";


    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    

})(jQuery);


$(document).ready(function() {
    document.getElementById('login').onclick = login;
    document.getElementById('signup').onclick = signup;
});


function signup(){
    postAjaxSignUp($("#orangeForm-name").val(), $("#orangeForm-pass").val());
    $("#modalRegisterForm").modal('hide');
}

function login(){
    postAjax($("#username").val(), $("#password").val());
}

function postAjax(username, password) {

    var element = {
        username : username,
        password : password
    };

    console.log(JSON.stringify(element));

    $.ajax({
        type: "POST", //rest Type
        dataType: 'json', //mispelled
        url: "http://52.26.216.32/cs425_fall18_hw04_tm03/api/login.php",
        async: true,
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(element),
        success: function (msg) {
            console.log(msg);

            if (msg.stat){
                swal("Good job!", msg.message, "success");
                window.location = "map.php";
            }else swal("Oops..", msg.message, "error");
        },
        error: function (msg) {
            console.log('Error: ' + msg);
            swal("Oops..", "Something went wrong!!", "error");
        }
    });
}

function postAjaxSignUp(username, password) {

    var element = {
        username : username,
        password : password
    };

    console.log(JSON.stringify(element));

    $.ajax({
        type: "POST", //rest Type
        dataType: 'json', //mispelled
        url: "http://52.26.216.32/cs425_fall18_hw04_tm03/api/signup.php",
        async: true,
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(element),
        success: function (msg) {
            console.log(msg);
            swal("Good job!", "Signup Success!", "success");
        },
        error: function (msg) {
            console.log('Error: ' + msg);
            swal("Oops..", "Something went wrong!!", "error");
        }
    });
}


// to not sumbit form

$("#prospects_form").submit(function(e) {
    e.preventDefault();
});