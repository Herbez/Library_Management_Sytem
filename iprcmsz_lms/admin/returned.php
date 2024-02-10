<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$Email = $_GET['id2'];
$dues = $_GET['id3'];

$sql = "select Category from user where email='$Email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$category = $row['Category'];


$sql1="update records set returndate=NOW(),Dues='$dues' where book_id='$bookid' and email='$Email'";
 
if($conn->query($sql1) === TRUE)
{$sql3="update book set Availability=Availability+1 where BookId='$bookid'";
 $result=$conn->query($sql3);
 $sql4 = "INSERT INTO `return` (email, BookId) VALUES ('$Email', '$bookid')";
 $result=$conn->query($sql4);
echo "<script type='text/javascript'>alert('Book Returned Successfully')</script>";
header( "Refresh:0.01; url=activities.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    header( "Refresh:1; url=activities.php", true, 303);

}





?>