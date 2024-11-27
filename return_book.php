<!DOCTYPE html>
<html>
<head>
    <title>Library Management System - Return Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('lp.jpg');
            margin: 0;
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

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

// Display all issued books in a table
echo "<h2>Issued Books</h2>";
$sql = "SELECT issued_books.book_id, books.title, books.author, issued_books.student_id, students.student_name, issued_books.issue_date 
        FROM issued_books 
        JOIN books ON issued_books.book_id = books.book_id 
        JOIN students ON issued_books.student_id = students.student_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Issue Date</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["book_id"] . "</td>
                <td>" . $row["title"] . "</td>
                <td>" . $row["author"] . "</td>
                <td>" . $row["student_id"] . "</td>
                <td>" . $row["student_name"] . "</td>
                <td>" . $row["issue_date"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No books are currently issued.</p>";
}

// Handle book return
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];

    // Check if the book is issued to this student
    $issued_sql = "SELECT * FROM issued_books WHERE book_id = '$book_id' AND student_id = '$student_id'";
    $issued_result = $conn->query($issued_sql);

    if ($issued_result->num_rows > 0) {
        // Return the book (Delete from issued_books and mark it as available in books)
        $delete_issued_sql = "DELETE FROM issued_books WHERE book_id = '$book_id' AND student_id = '$student_id'";
        if ($conn->query($delete_issued_sql) === TRUE) {
            // Mark the book as available
            $update_book_sql = "UPDATE books SET available = 1 WHERE book_id = '$book_id'";
            $conn->query($update_book_sql);

            echo "<p style='color:green;text-align:center; font-size: 30px;'>Book returned successfully!</p>";
        } else {
            echo "<p style='color:red;text-align:center;font-size: 30px;'>Error returning book: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color:red;text-align:center; font-size: 30px;'>This book is not issued to this student.</p>";
    }
}

$conn->close();
?>

<!-- Form to return a book -->
<div class="form-container">
    <h2>Return a Book</h2>
    <form method="post">
        Book ID: <input type="number" name="book_id" required><br>
        Student ID: <input type="number" name="student_id" required><br>
        <button type="submit">Return Book</button>
    </form>
</div>
<div class="back-link">
   <button> <a href="issue_book.php">Back to Home</a> </button>
   <button> <a href="add_book.php">Add Book</a> </button>
</div>
</body>
</html>
