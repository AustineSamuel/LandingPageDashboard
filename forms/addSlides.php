<?php
require "../connection.php";
require "../operations/headingSlideContainers.class.php";

$error = false;
$success = false;

// Fetch existing records
$headingSlideContainers = new HeadingSlideContainersInfo($GLOBALS['CONNECTION']);
$existingRecords = $headingSlideContainers->readHeadingSlideContainers();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Process the new record
    $newIconImage = $_FILES['iconImage']['tmp_name'] ?? null;
    if ($newIconImage) {
        $uploadedImage = uploadImage($_FILES['iconImage'], "../images/");
        if ($uploadedImage) {
            $newName = $_POST['name'];
            $newClickRedir = $_POST['clickRedir'];

            // Create new record
            if ($headingSlideContainers->createHeadingSlideContainer("/images/" . $uploadedImage, $newName, $newClickRedir)) {
                $success = "Heading Slide Container added successfully";
            } else {
                $error = "Failed to add Heading Slide Container: " . $GLOBALS['CONNECTION']->error;
            }
        } else {
            $error = "Error uploading new image";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Heading Slide Containers</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Add Heading Slide Containers</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="" enctype="multipart/form-data">
            <div class="new-record" style="text-align: start;" >
                <div style="text-align: center;">
                    <img id="preview" style="max-width: 100px; max-height: 100px; display: none;">
                </div>
                <label for="new_iconImage">Icon Image</label><br/>
                <input type="file" name="iconImage" id="new_iconImage" accept="image/*">

                <label for="new_name">Name</label><br/>
                <input type="text" name="name" id="new_name" placeholder="Enter Name">

                <label for="new_clickRedir">Click Redirect</label><br/>
                <input type="text" name="clickRedir" id="new_clickRedir" placeholder="Enter Click Redirect">
            </div>

            <button type="submit" name="addHeadingSlideContainers">Submit</button>
        </form>

        <script>
            document.getElementById('new_iconImage').addEventListener('change', function () {
                const preview = document.getElementById('preview');
                const file = this.files[0];
                const reader = new FileReader();

                reader.onloadend = function () {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                }

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            });
        </script>
    </div>
</div>
</body>
</html>
