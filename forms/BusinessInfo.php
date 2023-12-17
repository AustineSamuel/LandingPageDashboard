<?php
require "../connection.php";
require "../operations/BussinessInfoImages.class.php";

$error = false;
$success = false;

// Fetch existing business info images
$businessInfoImageInfo = new BusinessInfoImageInfo($GLOBALS['CONNECTION']);
$existingImages = $businessInfoImageInfo->readBusinessInfoImages();

// Handle form submission for both add and edit
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $heading = $_POST['heading'];
    $text = $_POST['text'];

    // Check if an image file is selected and uploaded successfully
    if (isset($_FILES["image"]) && $_FILES["image"]['error'] == UPLOAD_ERR_OK) {
        // Process the image upload
        $uploadedImage = uploadImage($_FILES["image"], "../images/");
        if ($uploadedImage) {
            $image = "/images/" . $uploadedImage;
        } else {
            $error = "Error uploading image";
        }
    } else {
        // No new image selected, use the existing image path
        $image = $existingImages[0]['image'] ?? "";
    }

    // Determine whether to add a new record or update an existing one
    if (count($existingImages) <=0) {
        // Add a new record
        if ($businessInfoImageInfo->createBusinessInfoImage($heading, $text, $image)) {
            $success = "Business Info Image added successfully";
        } else {
            $error = "Failed to add Business Info Image";
        }
    } else {
        $id=$existingImages[0]['id'];
        // Update an existing record
        if ($businessInfoImageInfo->updateBusinessInfoImage($id, $heading, $text, $image)) {
            $success = "Business Info Image updated successfully";
        } else {
            $error = "Failed to update Business Info Image";
        }
    }
}

// Fetch the existing record if editing
$editId = $_GET['edit'] ?? null;
$editImage = null;
$editHeading = null;
$editText = null;

if (!empty($existingImages)) {
    $editImage = $existingImages[0]['image'];
    $editHeading = $existingImages[0]['heading'];
    $editText = $existingImages[0]['text'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add/Edit Business Info Image</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2><?php echo $editId ? 'Edit' : 'Add'; ?> Business Info Image</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $editId; ?>">
            <br/>
            <label for="image">Image</label>
            <input type="file" class="img" name="image" id="image" accept="image/*">
                <img src="<?php echo $editImage; ?>" alt="Preview" id="preview" style="margin-top:5;display:<?php $existingImages? "block":"none"?>;max-width: 100px; max-height: 100px;">
<br/>
            <label for="heading">Heading</label>
            <input type="text" name="heading" id="heading" placeholder="Enter Heading" required value="<?php echo $editHeading; ?>">
            <br/>
            <label for="text">Text</label>
            <textarea name="text" id="text" placeholder="Enter Text" value="<?php echo $editText; ?>" required><?php echo $editText; ?></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>

        <script>
            const imageInput = document.getElementById("image");
            const preview = document.getElementById("preview");

            if (imageInput) {
                imageInput.addEventListener('change', function () {
                    const file = this.files[0];
                    const reader = new FileReader();
                    reader.onloadend = function () {
                        preview.src = reader.result;
                        preview.style.display = 'block';
                    };
                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = '';
                        preview.style.display = 'none';
                    }
                });
            }
        </script>
    </div>
</div>
</body>
</html>
