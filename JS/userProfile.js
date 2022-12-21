
const submitHandler = () => {

    let customerData = JSON.parse(localStorage.getItem("customerData"));

  let username = document.getElementById("exampleInputName1");
  let city = document.getElementById("exampleInputCity1");
  let phone = document.getElementById("exampleInputPhone1");
  let pincode = document.getElementById("exampleInputPincode1");
  let mainErr = document.getElementById("mainErr");
  let successMsg = document.getElementById("successMsg");

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //   document.getElementById("txtHint").innerHTML = this.responseText;
      if(this.responseText == "old Record Updated"){
        successMsg.innerText = "Data Udated Successfully"
      }else if(this.responseText == "New Record Inserted"){
        localStorage.setItem('userExist',true)
        successMsg.innerText = "Data Udated Successfully"
      }else{
        mainErr.innerText == "Something went wrong";
      }
      // if (this.responseText == "updated") {
      //   successMsg.innerText = "Successfully Data Updated";
      // } else if (this.responseText == "something went wrong") {
      //   mainErr.innerText = "something went wrong";
      // }
    }
  };
  xmlhttp.open(
    "GET",
    "../PHP/Profile1.php?name=" +
      username.value +
      "&city=" +
      city.value +
      "&phone=" +
      phone.value +
      "&pincode=" +
      pincode.value +
      "&fetch=" +true+
      "&email="+customerData.email+
      "&id="+customerData.id+
      "&userExist="+localStorage.getItem("userExist"),
      true,
    true
  );
  xmlhttp.send();
};

const fetchData = () => {
  let customerData = JSON.parse(localStorage.getItem("customerData"));

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //   document.getElementById("txtHint").innerHTML = this.responseText;
      console.log(this.responseText)
      if(this.responseText == ""){
        localStorage.setItem("userExist",false)
      }else{
        let fetchedData = JSON.parse(this.responseText)
        localStorage.setItem("userExist",true)
        let username = document.getElementById("exampleInputName1");
        let city = document.getElementById("exampleInputCity1");
        let phone = document.getElementById("exampleInputPhone1");
        let pincode = document.getElementById("exampleInputPincode1");
        username.value = fetchedData.name;
        city.value = fetchedData.city;
        phone.value = fetchedData.phone;
        pincode.value = fetchedData.pincode;
      }
    }
  };
  xmlhttp.open(
    "GET",
    "../PHP/Profile1.php?fetch=" +
      false +
      "&email=" +
      customerData.email,
    true
  );
  xmlhttp.send();
};

fetchData();



function logout(){

  function removeSeesionRedis() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      //   document.getElementById("txtHint").innerHTML = this.responseText;
      console.log(this.responseText)
      }
    };
    xmlhttp.open("GET", "http://localhost/taskfiles/PHP/Logout.php", true);
    xmlhttp.send();
  }

  removeSeesionRedis()

    localStorage.removeItem('customerData')
    // localStorage.removeItem('userExist')
    window.location.href = "http://localhost/taskfiles/html/Login.html";
}