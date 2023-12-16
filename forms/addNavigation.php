<?php
require "../connection.php";
require "../operations/navigations.class.php";

$error = false;
$success = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $hashTag = $_POST["hashTag"];
    $navigation = new NavigationInfo($GLOBALS['CONNECTION']);

    if ($navigation->createNavigation($name, $hashTag)) {
        $success = "Navigation added successfully";
    } else {
        $error = "Failed to add navigation: " . $GLOBALS['CONNECTION']->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Navigation</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Add Navigation</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>
        <form method="post" action="">
            <label for="name">Name</label>
            <input onkeyup="setTag()" type="text" name="name" id="name" placeholder="Enter name" required>
            <label for="hashTag">HashTag</label>
            <input type="text" name="hashTag" id="hashTag" placeholder="Enter hashTag" required>

            <button type="submit" name="login">Submit</button>
        </form>
    </div>
    <script>
        const setTag = () => {
            const nameValue = document.querySelector('#name').value;
            const hashTagValue = nameValue.split(' ').join('');
            document.querySelector('#hashTag').value = hashTagValue;
        }
    </script>
</body>
</html>
