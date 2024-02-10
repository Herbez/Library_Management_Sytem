<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../index.php"); // Redirect to login page if not logged in
    exit();
}

require('dbconn.php');

if (isset($_GET['id'])) {
    $bookid = $_GET['id'];
    $userid = $_SESSION["email"];

    // Check if the book exists
    $checkBookQuery = "SELECT Availability FROM book WHERE BookId = ?";
    $checkBookStmt = $conn->prepare($checkBookQuery);
    $checkBookStmt->bind_param("s", $bookid);
    $checkBookStmt->execute();
    $checkBookResult = $checkBookStmt->get_result();

    if ($checkBookResult->num_rows > 0) {
        $book = $checkBookResult->fetch_assoc();
        $availability = $book['Availability'];

        if ($availability > 0) {
            // Book is available, proceed with the borrowing request
            $borrowQuery = "INSERT INTO records (email, book_id, borrowdate) VALUES (?, ?, NOW())";
            $borrowStmt = $conn->prepare($borrowQuery);
            $borrowStmt->bind_param("ss", $userid, $bookid);

            if ($borrowStmt->execute()) {
                // Redirect to borrowed books page or display a success message
                echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
                header("Refresh:0.01; url=allbook.php", true, 303);
            } else {
                echo "Error processing borrowing request.";
            }
        } else {
            echo "Sorry, the selected book is not available for borrowing.";
        }
    } else {
        echo "Error retrieving book information.";
    }

    $checkBookStmt->close();
    $borrowStmt->close();
}

$conn->close();
?>
