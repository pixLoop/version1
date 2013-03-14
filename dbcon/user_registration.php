<?php
session_start();
require("./connection.php");
$con = getConnection();

$fields = "page,id,name";
$values = "'".$_SESSION["login"]["page"]."','".$_SESSION["login"]["id"]."','".$_SESSION["login"]["name"]."'";
if (isset($_SESSION["login"]["url"])) {
	$fields .= ",url";
	$values .= ",'".$_SESSION["login"]["url"]."'";
}
if (isset($_SESSION["login"]["image"])) {
	$fields .= ",image";
	$values .= ",'".$_SESSION["login"]["image"]."'";
}
$query = "INSERT INTO Users (".$fields.") values (".$values.")";

echo $query;
$rows = mysqli_query($con, $query);

closeConnection($con);

//header("Location: ./?".$_SESSION['last_page']);
?>
