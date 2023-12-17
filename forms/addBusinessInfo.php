<?php
require "../connection.php";
require "../operations/BusinessInfoList.class.php";

$error = false;
$success = false;

// Handle form submission for adding a new item
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['addItem'])) {
    $text = $_POST['text'];

    // Add a new record
    $businessInfoListInfo = new BusinessInfoListInfo($GLOBALS['CONNECTION']);
    if ($businessInfoListInfo->createBusinessInfoListItem($text)) {
        $success = "Business Info List Item added successfully";
    } else {
        $error = "Failed to add Business Info List Item";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Business Info List Item</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Add Business Info List Item</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="">
            <label for="text">Text</label><br/>
            <input type="text" name="text" id="text" placeholder="Enter Text" required>

            <button type="submit" name="addItem">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
