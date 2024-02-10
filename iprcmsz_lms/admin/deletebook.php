<?php
require('dbconn.php');

$bookid=$_GET['id'];

$sql="DELETE FROM book WHERE BookId='$bookid'";

if($conn->query($sql) === TRUE)
{
    echo "<script type='text/javascript'>alert('BOOK Deleted Successfully')
    window.location.href='allbook.php'; </script>";
}else {
	echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:0.01; url=allbook.php", true, 303);
}

?>