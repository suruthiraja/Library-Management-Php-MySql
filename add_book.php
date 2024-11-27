<!DOCTYPE html>
<html>
<head>
    <title>Library Management System - Add Book</title>
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

// Handle adding a new book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_book_id = $_POST['new_book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    // Add the book to the database and mark it as available
    $add_book_sql = "INSERT INTO books (book_id, title, author, available) VALUES ('$new_book_id', '$title', '$author', 1)";
    if ($conn->query($add_book_sql) == TRUE) {
        echo "<p style='color:green;text-align:center;font-size: 30px;'>New book added successfully!</p>";
    } else {
        echo "<p style='color:red;text-align:center;font-size: 30px;'>Error adding book: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!-- Form to add a new book -->
<div class="form-container">
    <h2>Add a New Book</h2>
    <form method="post">
        Book ID: <input type="number" name="new_book_id" required><br>
        Title: <input type="text" name="title" required><br>
        Author: <input type="text" name="author" required><br>
        <button type="submit">Add Book</button>
    </form>
</div>

<div class="back-link">
   <button> <a href="issue_book.php">Back to Home</a> </button>
   <button> <a href="return_book.php">Return Book</a> </button>

</div>

</body>
</html>
