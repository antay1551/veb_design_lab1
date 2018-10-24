function loginFunction(){
    var login_element = document.getElementById("login").value;
    var password_element = document.getElementById("password").value;
    console.log(login_element);
    console.log(password_element);
    var dataString = 'login=' + login_element + '&password=' + password_element ;
    console.log(dataString);

    $.ajax({
        type: "POST",
        url: "http://lab1/connection_user.php",
        data: dataString,
        cache: false,
        success: function(html) {
            //alert(html);
            document.location.href = "http://lab1/connection_user.php";
        }
    });
}