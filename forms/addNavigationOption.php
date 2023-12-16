<?php
require "../connection.php";

require "../operations/subNavigations.class.php";

$error = false;
$success = false;
$options=getTable("navigations");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $url = $_POST['url'];
    $hashTag = $_POST['hashTag'];

    $subNavigation = new SubNavigationInfo($GLOBALS['CONNECTION']);

    if ($subNavigation->createSubNavigation($name, $url, $hashTag)) {
        $success = "SubNavigation added successfully";
    } else {
        $error = "Failed to add SubNavigation: " . $GLOBALS['CONNECTION']->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add SubNavigation</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Add SubNavigation</h2>

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
            <input type="text" name="name" id="name" placeholder="Enter name" required>
            
            <label for="url">URL</label>
            <input type="text" name="url" id="url" placeholder="Enter URL" required>

            <label for="hashTag">HashTag</label>
            <select  type="text" name="hashTag" id="hashTag" placeholder="Enter hashTag" required>
               
              <?php foreach($options as $option){
                $name=$option['name'];
                 echo "<option value='$name'>$name</option>";
              }
              ?>
            </select>

            <button type="submit" name="addSubNavigation">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
