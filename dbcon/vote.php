<?php
$lines = 0;
$output = "";

$news_id = $_GET['news'];
$user = $_SERVER['REMOTE_ADDR'];

require("./connection.php");
$con = getConnection();
$query = "SELECT id FROM News WHERE id = '".$news_id."'";
$result = mysqli_query($con, $query);
$result = mysqli_fetch_array($result);
$id = $result['id'];
if ($id != null) {
	$query = "INSERT INTO News_votes (news, user) VALUES ('".$id."', '".$user."')";
	$lines = mysqli_query($con, $query);
}
closeConnection($con);

if ($lines == 1) echo '{"result": "Voto recibido con éxito. ¡Gracias por participar!"}';
else echo '{"result": "Voto no recibido."}';
?>
