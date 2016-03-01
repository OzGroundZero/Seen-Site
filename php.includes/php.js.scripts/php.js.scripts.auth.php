<script>
    function emptyElement(x){
      _(x).innerHTML = "";
    }

    function login(){
      var u = _("lusername").value;
      var p = _("lpassword").value;
      var status = document.getElementById("lstatus");
      var loginButton= document.getElementById("loginBtn");
      if(u == "" || p == ""){
        showAlert("Form Error", "All fields in log in form required.", "", "");
      } else {
        loginButton.disabled=true;
        status.innerHTML = 'Super eyes at work...';
        var ajax = ajaxObj("POST", "login.php");
        ajax.onreadystatechange = function() {
          if(ajaxReturn(ajax) == true) {
            status.innerHTML = "";
            loginButton.disabled=false;

            var dataArray = ajax.responseText.split("|");
            var responseCode = dataArray[0].trim();
            var responseMessage = dataArray[1].trim();
            if( responseCode != "login_success") {
              showAlert("Login Failed", responseMessage, "", "");
            } else {
              window.location = "home";
            }
          }
        }
        ajax.send("u="+u+"&p="+p);
      }
    }

    function signup(){
      var u = document.getElementById("susername").value;
      var p1 = document.getElementById("spassword").value;
      var status = document.getElementById("sstatus");
      var signupButton= document.getElementById("signupBtn");

      if(u == "" || p1 == "" ){
        showAlert("Sign Up Error", "Incomplete Form", "", "");
      } else {
        signupButton.disabled = true;
        status.innerHTML = 'Seeing the World...';
        var ajax = ajaxObj("POST", "signup.php");
          ajax.onreadystatechange = function() {
            if(ajaxReturn(ajax) == true) {
              signupButton.disabled = false;
              status.innerHTML = "";
          
              if(ajax.responseText != "success"){
                showAlert("Sign Up Failed", ajax.responseText, "", "");  
              } else if(ajax.responseText == "success"){
                var signupSuccessMessage="Eyes all around the world are going crazy!<br>";
                signupSuccessMessage+="<b>Welcome to the neighborhood.</b> The World is all ready for you to log in, " + u;
                showAlert("Sign Up Success", signupSuccessMessage, "", "");  

                window.location="login.php?sus_u="+u+"&sus_p="+p1;
              }
            }
          }

          ajax.send("u="+u+"&p="+p1);
      }
    }

    function checkusername(){
      var u = document.getElementById("susername").value;
      var status= document.getElementById("signup_status");
      if(u != ""){
        var ajax = ajaxObj("POST", "check_username_email.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  status.innerHTML = ajax.responseText;
              }
            }
            ajax.send("usernamecheck="+u);
      }
    }
</script>