function checkEmpty() {
    var userName = document.forms["loginForm"]["userName"].value;
    var password = document.forms["loginForm"]["password"].value;
    var errorMessage = "";
    if (userName == "" && password != "") {
        errorMessage = "*Please enter your user name*";
    } else if (userName != "" && password == "") {
        errorMessage = "*Please enter your password*";
    } else if (userName == "" && password == "") {
        errorMessage = "*Please enter your user name & password*";
    }

    if (errorMessage != "") {
        document.getElementById('errorMessage').innerHTML = errorMessage;
        return false;
    } else {
        document.getElementById('errorMessage').innerHTML = "";
        return true;
    }
}

function checkFormat() {
    if (checkEmpty()) {
        var uname = document.getElementById('userName').value;
        var psw = document.getElementById('password').value; 
       $.post("io/api/00000000.php", {
           userName: uname,
           password: psw
        },
        function (data) {
            data=data.trim();
            console.log(data);
            if (data === "CorrectUserName&Password") {

                window.location = "/?account";

            } else if (data === "*Your password is incorrect*") {

                document.forms["loginForm"]["password"].value = "";
                document.getElementById('errorMessage').innerHTML = data;

            } else {

                document.forms["loginForm"]["userName"].value = "";
                document.forms["loginForm"]["password"].value = "";
                document.getElementById('errorMessage').innerHTML = data;		

            }
        });
    }
}

function logout() {
    var txt;
    var r = confirm("Do you want to logout?");
    if (r == true) {
        $.post("io/api/00000002.php",function (data) {
            data=data.trim();
            window.location = data;
        });
    } else {
        txt = "Nothing has been done!";
    }
}

function forceLogout(uname) {
    if (confirm("Do you want to force login?") == true) {
        $.post("io/api/00000001.php", {
            userName: uname
        },
        function (data) {
            window.location = data;
        });
    } else {
        document.forms["loginForm"]["userName"].value = "";
        document.forms["loginForm"]["password"].value = "";
    }
}
