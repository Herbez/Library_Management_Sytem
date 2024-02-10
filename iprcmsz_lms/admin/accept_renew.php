<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$Email = $_GET['id2'];

$sql = "select Category from user where email='$Email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$category = $row['Category'];

if ($category == 'student' || $category == 'teacher') {
    $sql1 = "update records set duedate=date_add(duedate,interval 10 day),Renewals=0 where book_id='$bookid' and email='$Email'";

    if ($conn->query($sql1) === TRUE) {
        $sql3 = "Delete from renew where BookId='$bookid' and email='$Email'";
        $result = $conn->query($sql3);

        echo "<script type='text/javascript'>alert('Request Accepted')</script>";
        header("Refresh:0.01; url=borrow_request.php", true, 303);
        exit;
    } else {
        echo "<script type='text/javascript'>alert('Error')</script>";
        header("Refresh:1; url=borrow_request.php", true, 303);
        exit;
    }
}
?>
