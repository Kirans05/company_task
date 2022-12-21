function submit(){
    let password = document.getElementById("exampleInputPassword1")
    let email = document.getElementById("exampleInputEmail1")
    let emailErr = document.getElementById("emailErr")
    let passwordErr = document.getElementById("passwordErr")
    let mainErr = document.getElementById("mainErr")
    if(email.value == ""){
        emailErr.innerHTML = "Please Enter Email"
    }else if(password.value == ""){
        passwordErr.innerHTML = "Please Enter Password"
    }else{
        function checkUser() {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                //   document.getElementById("txtHint").innerHTML = this.responseText;
                console.log(this.responseText)
                if(this.responseText == "User Not Found Please Register"){
                    mainErr.innerText = "User Not Found Please Register"
                }else if(this.responseText == "Incorrect Password"){
                    mainErr.innerText = "Incorrect Password"
                }else if(this.responseText == "somthing went wrong"){
                    mainErr.innerText = "somthing went wrong"
                }else if(this.responseText == "no statement" || this.responseText == "not connected"){
                    mainErr.innerText = "somthing went wrong"
                }else{
                    localStorage.setItem('customerData',this.responseText)
                    window.location.href = "../html/Profile.html";
                }
                }
              };
              xmlhttp.open("GET", "../PHP/Login1.php?email="+email.value+"&password="+password.value, true);
            //   xmlhttp.open("GET", "http://13.230.191.6/PHP/Login1.php?email="+email.value+"&password="+password.value, true);
              xmlhttp.send();
            }

        checkUser()
    }
}

// http://13.230.191.6/html/Login.html
