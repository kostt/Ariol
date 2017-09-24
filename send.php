<?php


class Send{

private $host = 'localhost'; 
private $username = 'id2650221_root'; 
private $pass = '12345'; 
private $dbname = 'id2650221_my_db'; 

public function connect(){
$link = mysqli_connect($this->host, $this->username, $this->pass, $this->dbname) or die("Ошибка " . mysqli_error($link));
return 	$link;
}

public function query($query){
$link = $this->connect();
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link) . ";<br>"); 
return $result;
}

public function table(){

$query_pri = "SELECT * FROM users"; 
$result = $this->query($query_pri);

echo "<table border='1'><tr><td>id</td><td>Имя</td><td>Дата рождения</td><td>Телефон</td><td>Email</td><td>О себе</td><td></td></tr>";
while($r = mysqli_fetch_array($result)){
echo <<<TXT
<tr id="tr_$r[id]"><td>$r[id]</td><td>$r[name]</td><td>$r[date]</td><td>$r[tell]</td><td>$r[email]</td><td>$r[about]</td><td><input value="Удалить" onclick="dell($r[id]);" type="submit"></td></tr>
TXT;
}
echo "</table><br><br>";

}

public function dell(){
if(isset($_POST['dell_id'])){
$dell_id = $_POST['dell_id'];
$query_insrt = "DELETE FROM `users` WHERE `id`='$dell_id'";
$this->query($query_insrt);
$this->table();
exit;
}
}

function validation($var) {
$link = $this->connect();
$var= mysqli_real_escape_string($link,$var);
$var= htmlspecialchars($var);
$var = trim($var);
if (empty($var)){die('<font style="color:red;">Заполните обязательные поля!</font>');}
return $var;
}

function checkEmail($email) {
$validation = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$validation){
die('<font style="color:red;">Неправильно введен Email!</font>');}
}

function checkTell($tell) {
$pattern = "/^\+375\d{2}\d{3}\d{2}\d{2}$/";
 if(!preg_match($pattern, $tell)){
die('<font style="color:red;">Неправильно введен Телефон!</font>');}
}

function checkName($name) {
$pattern = "/^[a-zA-Zа-яА-Я]+$/ui";
 if(!preg_match($pattern, $name)){
die('<font style="color:red;">Неправильно введено Имя!</font>');}
}


public function post(){

if(isset($_POST['name'])){$name = $_POST['name'];}
if(isset($_POST['date'])){$date = $_POST['date'];}
if(isset($_POST['tell'])){$tell = $_POST['tell'];}
if(isset($_POST['email'])){$email = $_POST['email'];}
if(isset($_POST['about'])){$about = $_POST['about'];}

$name = $this->validation($name);
$tell = $this->validation($tell);
$email = $this->validation($email);

$this->checkName($name);
$this->checkTell($tell);
$this->checkEmail($email);

$query_insrt = "INSERT INTO users (`name`,`date`,`tell`,`email`,`about`) VALUES ('$name','$date','$tell','$email','$about')";
$this->query($query_insrt);
$this->table();
}

}

$obj = new Send;

$obj->dell();
$obj->post();



?>