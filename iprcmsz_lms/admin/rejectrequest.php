<?php
require('dbconn.php');

$bookid=$_GET['id1'];
$Email=$_GET['id2'];

$sql="update records set  Status='Rejected' where book_id='$bookid' and email='$Email'";

if($conn->query($sql) === TRUE)
{

echo "<script type='text/javascript'>alert('Request Reject Successfully')</script>";
header( "Refresh:0.01; url=borrow_request.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    header( "Refresh:0.01; url=borrow_request.php", true, 303);

}
