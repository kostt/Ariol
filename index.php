<html>
<head>
<title>Ареол</title>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
</head>
<body>


<div align="center">
Имя *:<br>
<input type="text" id="name"><br>
Дата рождения:<br>
<input type="text" id="date"><br>
Телефон *:<br>
<input type="text" value="+375" id="tell"><br>
Email *:<br>
<input type="text" id="email"><br>
О себе:<br>
<input type="text" id="about"><br><br>
<input type="submit" onclick="send();"><br><br>
<div style="display:none" id="load">Подождите...</div>
<div id="resp"></div>
</div>

<script>
function send() {
document.getElementById("load").style.display = "block";
  var name = document.getElementById("name").value;
  var date = document.getElementById("date").value;
  var tell = document.getElementById("tell").value;
  var email = document.getElementById("email").value;
  var about = document.getElementById("about").value;
$.ajax({type: 'post',
      data: {name: name, date: date, tell: tell, email: email, about: about},
  url: 'send.php',
cache: true,  
  success: function(html) {
    $('#resp').html(html);
    document.getElementById("load").style.display = "none";
  }
});
}

function dell(num) {
var isDell = confirm("Удалить запись?");
if(isDell==true){
document.getElementById("load").style.display = "block";
var num =num;
num2 = 'tr_'+num;
$.ajax({type: 'post',
      data: {dell_id: num},
  url: 'send.php',
cache: true,  
  success: function(html) {
document.getElementById(num2).style.display = "none";
document.getElementById("load").style.display = "none";
alert("Запись удалена");
  }
});
}
}
</script>

</body>
</html>