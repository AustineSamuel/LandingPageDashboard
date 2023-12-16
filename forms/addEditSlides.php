<?php
require "../connection.php";
require "../operations/headingSlideContainers.class.php";

$error = false;
$success = false;

// Fetch existing records
$headingSlideContainers = new HeadingSlideContainersInfo($GLOBALS['CONNECTION']);
$existingRecords = $headingSlideContainers->readHeadingSlideContainers();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Loop through posted data to add/update records
    if(isset($_POST['records'])){
    foreach ($_POST['records'] as $record) {
        $id = $record['id'] ?? null; // Check if ID exists for update
        print_r($record);
        $iconImage = $record["iconImage".$id];
        $name = $record['name'];
        $clickRedir = $record['clickRedir'];
        // Process image upload
        $imageFile = $_FILES['records']['tmp_name'][$id]['iconImage'] ?? null;
        if ($imageFile) {
            $uploadedImage = uploadImage($_FILES['records'], "/images/");
            if ($uploadedImage) {
                $iconImage = $uploadedImage;
            } else {
                $error = "Error uploading image";
                break;  // Exit the loop if there's an error
            }
        }

        if ($id !== null) {
            // Update existing record
            if ($headingSlideContainers->updateHeadingSlideContainer($id, "/images/".$iconImage, $name, $clickRedir)) {
                $success = "Heading Slide Container updated successfully";
            } else {
                $error = "Failed to update Heading Slide Container: " . $GLOBALS['CONNECTION']->error;
            }
        } else {
            // Create new record
            if ($headingSlideContainers->createHeadingSlideContainer($iconImage, $name, $clickRedir)) {
                $success = "Heading Slide Container added successfully";
            } else {
                $error = "Failed to add Heading Slide Container: " . $GLOBALS['CONNECTION']->error;
            }
        }
    }
}

    // Process the new record
    $newIconImage = $_FILES['iconImage']['tmp_name'] ?? null;
    if ($newIconImage) {
        $uploadedImage = uploadImage($_FILES['iconImage'], "/images/");
        if ($uploadedImage) {
            $newName = $_POST['name'];
            $newClickRedir = $_POST['clickRedir'];
            
            // Create new record
            if ($headingSlideContainers->createHeadingSlideContainer("/images/".$uploadedImage, $newName, $newClickRedir)) {
                $success = "Heading Slide Container added successfully";
            } else {
                $error = "Failed to add Heading Slide Container: " . $GLOBALS['CONNECTION']->error;
            }
        } else {
            $error = "Error uploading new image";
        }
    }
}
print_r($existingRecords);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add/Edit Heading Slide Containers</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Add/Edit Heading Slide Containers</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="" enctype="multipart/form-data">
            <?php foreach ($existingRecords as $record): ?>
                <div class="record" style="text-align: start;">
                    <input type="hidden" name="records[<?php echo $record['id']; ?>][id]" value="<?php echo $record['id']; ?>">

                    <label for="iconImage_<?php echo $record['id']; ?>">Icon Image</label><br/>
                    <input type="file" name="iconImage<?php echo $record['id']; ?>" id="iconImage_<?php echo $record['id']; ?>" accept="image/*">
                    <?php if ($record['iconImage']): ?>
                        <img src="<?php echo $record['iconImage']; ?>" alt="Preview" style="max-width: 100px; max-height: 100px;">
                    <?php endif; ?>

                    <label for="name_<?php echo $record['id']; ?>">Name</label><br/>
                    <input type="text" name="records[<?php echo $record['id']; ?>][name]" id="name_<?php echo $record['id']; ?>" placeholder="Enter Name" required value="<?php echo $record['name']; ?>">

                    <label for="clickRedir_<?php echo $record['id']; ?>">Click Redirect</label><br/>
                    <input type="text" name="records[<?php echo $record['id']; ?>][clickRedir]" id="clickRedir_<?php echo $record['id']; ?>" placeholder="Enter Click Redirect" required value="<?php echo $record['clickRedir']; ?>">
                </div>
            <?php endforeach; ?>
            <br/>
<b>New</b><br/>
            <div class="new-record" style="text-align: start;" >
            <div style="text-align: center;">
            <img id="preview" style="max-width: 100px; max-height: 100px; display: none;">
            </div>
            <label for="new_iconImage">Icon Image</label><br/>
                <input type="file" name="iconImage" id="new_iconImage" accept="image/*">
               
                <label for="new_name">Name</label><br/>
                <input type="text" name="name" id="new_name" placeholder="Enter Name" >

                <label for="new_clickRedir">Click Redirect</label><br/>
                <input type="text" name="clickRedir" id="new_clickRedir" placeholder="Enter Click Redirect" >
            </div>

            <button type="submit" name="addEditHeadingSlideContainers">Submit</button>
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
