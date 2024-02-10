<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Include database connection file
require('dbconn.php');

// Query to fetch data from records table
$sql = "SELECT * FROM records, book, user WHERE user.email=records.email AND records.book_id = book.BookId ORDER BY borrowdate";
$result = $conn->query($sql);

// Set headers for CSV file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="Library_report.csv"');
header('Cache-Control: max-age=0');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Write headers to the CSV file
fputcsv($output, ['Names','Category','Email','Department', 'Book Name', 'Borrow Date', 'Due Date', 'Status', 'Returned Date', 'Renewals']);

// Fetch data from the database and write it to the CSV file
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [$row['names'],$row['category'],$row['email'],$row['department'], $row['Title'], $row['borrowdate'], $row['duedate'], $row['Status'], $row['returndate'], $row['renewals']]);
}

// Close database connection
$conn->close();

// End script execution
exit();
?>
