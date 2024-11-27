<!DOCTYPE html>
<html>
<head>
    <title>Library Management System - Issue Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('lp.jpg');
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #f2f2f2;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .form-container {
            width: 60%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        .form-container input[type="text"],
        .form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<?php
include 'db.php';

// Display all books in a table
echo "<h2>Available Books</h2>";
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Available</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["book_id"]. "</td>
                <td>" . $row["title"]. "</td>
                <td>" . $row["author"]. "</td>
                <td>" . ($row["available"] ? "Yes" : "No") . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No books available.</p>";
}

// Handle book issuance
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];

    // Check if the student exists
    $student_sql = "SELECT * FROM students WHERE student_id = '$student_id' AND student_name = '$student_name'";
    $student_result = $conn->query($student_sql);

    if ($student_result->num_rows > 0) {
        // Check if the book is available
        $book_sql = "SELECT * FROM books WHERE book_id = '$book_id' AND available = 1";
        $book_result = $conn->query($book_sql);

        if ($book_result->num_rows > 0) {
            // Issue the book
            $issue_sql = "INSERT INTO issued_books (book_id, student_id, issue_date) VALUES ('$book_id', '$student_id', CURDATE())";
            if ($conn->query($issue_sql) === TRUE) {
                // Mark the book as unavailable
                $update_book_sql = "UPDATE books SET available = 0 WHERE book_id = '$book_id'";
                $conn->query($update_book_sql);

                echo "<p style='color:green;text-align:center;font-size: 30px;'>Book issued successfully!</p>";
            } else {
                echo "<p style='color:red;text-align:center;font-size: 30px;'>Error issuing book: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color:red;text-align:center;font-size: 30px;'>Book is not available.</p>";
        }
    } else {
        echo "<p style='color:red;text-align:center;font-size: 30px;'>Student not found.</p>";
    }
}

$conn->close();
?>

<!-- Form to issue a book -->
<div class="form-container">
    <h2>Issue a Book</h2>
    <form method="post">
        Book ID: <input type="number" name="book_id" required><br>
        Student ID: <input type="number" name="student_id" required><br>
        Student Name: <input type="text" name="student_name" required><br>
        <button type="submit">Issue Book</button>
    </form>
</div>
<div class="back-link">
   <button> <a href="return_book.php">Return Book</a> </button>
   <button> <a href="add_book.php">Add Book</a> </button>
</div>
</body>
</html>
