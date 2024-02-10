
?>

<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$Email = $_GET['id2'];

$sql = "select Category from user where email='$Email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$category = $row['Category'];

if ($category == 'student' || $category == 'teacher') {
    $sql1 = "update records set borrowdate=Now(), duedate=date_add(Now(),interval 10 day),Renewals=1,dues = DATEDIFF(CURRENT_DATE(), duedate), Status='Accepted' where book_id='$bookid' and email='$Email'";

    if ($conn->query($sql1) === TRUE) {
        $sql3 = "update book set Availability=Availability-1 where BookId='$bookid'";
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
