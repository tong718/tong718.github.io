
function logoff() { 
    var txt;
    var r = confirm("Do you want to logout?");
    if (r == true) {
        $.post("../io/api/00000002.php",function (data) {data=data.trim();window.location=data;});
    } else {
        txt = "Nothing has been done!";
    }
 
}