function hi(){
    function checkUser() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          //   document.getElementById("txtHint").innerHTML = this.responseText;
          console.log(this.responseText)
        //   console.log(JSON.parse(this.responseText))
        //   if(this.responseText == "User Not Found Please Register"){
        //       mainErr.innerText = "User Not Found Please Register"
        //   }else if(this.responseText == "Incorrect Password"){
        //       mainErr.innerText = "Incorrect Password"
        //   }else if(this.responseText == "somthing went wrong"){
        //       mainErr.innerText = "somthing went wrong"
        //   }else{
        //       localStorage.setItem('customerData',this.responseText)
        //       window.location.href = "http://localhost/practise/html/Profile.html";
        //   }
          }
        };
        xmlhttp.open("GET", "http://localhost/practise/PHP/Mongodb.php", true);
        xmlhttp.send();
      }

      checkUser()
}

hi()