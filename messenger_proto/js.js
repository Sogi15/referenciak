
setInterval(function(){
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
    document.getElementById("mess").innerHTML = this.responseText;
}
xhttp.open("POST", "messages.php");
xhttp.send();},
1000)