<?php
require('dbconn.php');

$id=$_GET['id'];

$Email = $_GET['id2'];

$sql="insert into renew (email,BookId) values ('$Email','$id')";

if($conn->query($sql) === TRUE)
{
echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
header( "Refresh:0.01; url=borrowedbooks.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Request Already Sent.')</script>";
    header( "Refresh:0.01; url=borrowedbooks.php", true, 303);

}


?>