function validateUsername(fld) {
    var error = "";
    var illegalChars = /\W/; // allow letters, numbers, and underscores

    if (fld.value == "") {
        fld.style.background = 'Yellow';
        error = "You didn't enter a name.\n";
    } else if ((fld.value.length < 5) || (fld.value.length > 30)) {
        fld.style.background = 'Yellow';
        error = "The name is the wrong length. (max=30)\n";
    } else if (illegalChars.test(fld.value)) {
        fld.style.background = 'Yellow';
        error = "The name contains illegal characters.\n";
    } else {
        fld.style.background = 'White';
    }
    return error;
}

function validatePassword(fld) {
    var error = "";
    var illegalChars = /[\W_]/; // allow only letters and numbers 

    if (fld.value == "") {
        fld.style.background = 'Yellow';
        error = "You didn't enter a password.\n";
    } else if ((fld.value.length < 4) || (fld.value.length > 15)) {
        error = "The password must be between 4 and 15 characters. \n";
        fld.style.background = 'Yellow';
    } else if (illegalChars.test(fld.value)) {
        error = "The password contains illegal characters.\n";
        fld.style.background = 'Yellow';
    } else if (!((fld.value.search(/(a-z)+/)) && (fld.value.search(/(0-9)+/)))) {
        error = "The password must contain at least one numeral.\n";
        fld.style.background = 'Yellow';
    } else {
        fld.style.background = 'White';
    }
    return error;
}

function validateEmpty(fld) {
    var error = "";

    if (fld.value.length == 0) {
        fld.style.background = 'Yellow';
        error = "The required field has not been filled in.\n"
    } else {
        fld.style.background = 'White';
    }
    return error;
}

function validateFormOnSubmit() {
    var reason = "";

    
    reason += validateUsername(document.getElementById('name'));

    if (reason != "") {
        swal("Some fields need correction..", reason, "warning");
        return false;
    }

    return true;
}

function validateSignin() {
    var reason = "";

    reason += validateUsername(document.getElementById('username'));
    reason += validatePassword(document.getElementById('password'));

    if (reason != "") {
        swal("Some fields need correction..", reason, "warning");
        return false;
    }

    return true;
}


function validateSignup() {
    var reason = "";

    reason += validateUsername(document.getElementById('orangeForm-name'));
    reason += validatePassword(document.getElementById('orangeForm-pass'));


    if (reason != "") {
        swal("Some fields need correction..", reason, "warning");
        return false;
    }

    return true;
}
