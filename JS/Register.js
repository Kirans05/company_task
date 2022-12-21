function submitHandler(){
    let name = document.getElementById("exampleInputname1")
    let email = document.getElementById("exampleInputEmail1")
    let password = document.getElementById("exampleInputPassword1")
    let confirmPassword = document.getElementById("exampleInputConfirmPassword1")
    let nameErr = document.getElementById("nameErr")
    let emailErr = document.getElementById("emailErr")
    let passwordErr = document.getElementById("passwordErr")
    let confirmPasswordErr = document.getElementById("confirmPasswordErr")
    let mainErr = document.getElementById("mainErr")

    if(name.value == ""){
        nameErr.innerHTML = "Please Enter Name"
    }else if(email.value == ""){
        nameErr.innerHTML = ""
        emailErr.innerHTML = "Please Enter Email"
    }else if(password.value == ""){
        emailErr.innerHTML = ""
        passwordErr.innerHTML = "Please Enter Password"
    }else if(confirmPassword.value == ""){
        passwordErr.innerHTML = ""
        confirmPasswordErr.innerHTML = "Please Enter Confirm Password" 
    }else if(confirmPassword.value != password.value){
        mainErr.innerText = "Password Does Not Match"
    }else{
        function registerUser() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
              //   document.getElementById("txtHint").innerHTML = this.responseText;
              console.log(this.responseText)
              if(this.responseText == "something went wrong"){
                  mainErr.innerText = "something went wrong"
              }else if(this.responseText == "This username is already taken"){
                  mainErr.innerText = "This username is already taken"
              }else{
                  window.location.href = "../html/Login.html";
              }
              }
            };
            xmlhttp.open("GET", "../PHP/Register1.php?email="+email.value+"&password="+password.value+"&name="+name.value, true);
            xmlhttp.send();
          }

          registerUser()
    }
}