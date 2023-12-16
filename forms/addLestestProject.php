<?php
require "../connection.php";
require "../operations/LetestProjectsList.class.php";

$error = false;
$success = false;

// Initialize LatestProjectsListInfo object
$latestProjectsListInfo = new LatestProjectsListInfo($GLOBALS['CONNECTION']);

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['addLatestProjectList'])) {
    // Fetch form data
    $heading = $_POST['heading'] ?? "";
    $subHeading = $_POST['subHeading'] ?? "";

    // Process image upload
    $uploadedImage = uploadImage($_FILES["image"], "../images/");
    if ($uploadedImage) {
        $image = "/images/" . $uploadedImage;

        // Create new record
        if ($latestProjectsListInfo->createLatestProjectList($image, $heading, $subHeading)) {
            $success = "Latest Project List added successfully";
        } else {
            $error = "Failed to add Latest Project List: " . $GLOBALS['CONNECTION']->error;
        }
    } else {
        $error = "Error uploading image";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Latest Project List</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Add Latest Project List</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="" enctype="multipart/form-data">
            <div class="record" style="text-align: start;">
                <label for="image">Image</label><br/>
                <input type="file" style="width:90%;" class="img" name="image" id="image" accept="image/*">
                <img src="" alt="Preview" id="preview" style="display:none;max-width: 100px; max-height: 100px;"><br/>

                <label for="heading">Heading</label><br/>
                <input type="text" style="width:90%;" name="heading" id="heading" placeholder="Enter Heading" required>

                <label for="subHeading">Subheading</label><br/>
                <input style="width:90%;" type="text" name="subHeading" id="subHeading" placeholder="Enter Subheading / Technology" required>
            </div>
            <button type="submit" name="addLatestProjectList">Submit</button>
        </form>

        <script>
            const imageInput = document.getElementById("image");
            const preview = document.getElementById("preview");

            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                const reader = new FileReader();

                reader.onloadend = function () {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                    review.style.display="inline-block"
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
