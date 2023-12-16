<?php
require "../connection.php";
require "../operations/Technologies.class.php";

$error = false;
$success = false;

// Fetch existing technologies
$technologiesInfo = new TechnologiesInfo($GLOBALS['CONNECTION']);
$existingTechnologies = $technologiesInfo->readTechnologies();

// Add new technology
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['addTechnology'])) {
    $name = $_POST['name'];
    $iconFile = $_FILES['icon']['tmp_name'];

    // Process image upload
    $uploadedIcon = uploadImage($_FILES['icon'], "../images/");
    if ($uploadedIcon) {
        if ($technologiesInfo->createTechnology($name, "/images/" . $uploadedIcon)) {
            $success = "Technology added successfully";
        } else {
            $error = "Failed to add technology: " . $GLOBALS['CONNECTION']->error;
        }
    } else {
        $error = "Error uploading icon image";
    }
}

//print_r($existingTechnologies);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Technology</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Add Technology</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="" enctype="multipart/form-data">
            <label for="name">Technology Name</label><br/>
            <input type="text" name="name" id="name" placeholder="Enter Technology Name" required>

            <label for="icon">Icon Image</label><br/>
            <input type="file" name="icon" id="icon" accept="image/*">
            <img id="preview" alt="Preview" style="max-width: 100px; max-height: 100px; display: none;">

            <button type="submit" name="addTechnology">Add Technology</button>
        </form>

        <script>
            const iconInput = document.getElementById('icon');
            const preview = document.getElementById('preview');

            iconInput.addEventListener('change', function () {
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
