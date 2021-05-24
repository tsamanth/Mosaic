function confirmation() {
    var username = document.Registration.username.value;
    var password = document.Registration.password.value;

    username = String(username);
    password = String(password);


    try {
      err = "";
      if (username.length < 6 || username.length > 10){
        err += "Username must be between 6 and 10 characters in length \n";
      }
      if (checkSymbols(username)){
        err += "Username cannot contain special characters \n";
      }
      if (!isNaN(username.charAt(0))){
        err += "Username must start with a character \n";
      }
      if (password.length < 6 || password.length > 15){
        err += "Password must be between 6 and 15 characters \n";
      }
      if (!checkPassword(password)){
        err += "Password must contain one lower case letter, one upper case letter, and one number \n";
      }

      if (err != ""){
        throw err;
      }
      else {
          console.log(err);
          alert("User Validated");
          window.location.href = "signin.php";
      }
    }
    catch(err) {
      alert(err);
    }

}

function wipe() {
  document.getElementById("Registration").reset();
}

function checkSymbols(str){
    var regex = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;
	return regex.test(str);
}


function checkPassword(str){
    if (str.search(/[a-z]/) == -1) {
        return false;
    }
    if (str.search(/[A-Z]/) == -1) {
        return false;
    }
    if (str.search (/[0-9]/) == -1) {
        return false;
    }
    return true;
}


