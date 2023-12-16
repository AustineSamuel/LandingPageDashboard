<?php
require "../connection.php";
require "../operations/headingSlideContainers.class.php";

$error = false;
$success = false;

// Fetch existing records
$headingSlideContainers = new HeadingSlideContainersInfo($GLOBALS['CONNECTION']);
$existingRecords = $headingSlideContainers->readHeadingSlideContainers();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['editHeadingSlideContainers'])) {
    foreach ($existingRecords as $record) {
        $id = $record['id'] ?? null;
        $iconImage = $record['iconImage'];
        $name = $record['name'];
        $clickRedir = $record['clickRedir'];

        // Process image upload
        if (isset($_FILES["iconImage".$id])) {
            if(file_exists($iconImage)){
            if(!unlink($iconImage)){
                $error = "Fail to delete file";
            }
        }
        
            $uploadedImage = uploadImage($_FILES["iconImage".$id], "../images/");
            if ($uploadedImage) {
                $iconImage = "/images/" . $uploadedImage;
            } else {
                $error = "Error uploading image";
                break;
            }
        }
        if ($id !== null) {
            // Update existing record
            if ($headingSlideContainers->updateHeadingSlideContainer($id, $iconImage, $name, $clickRedir)) {
                $success = "Heading Slide Container updated successfully";
            } else {
                $error = "Failed to update Heading Slide Container: " . $GLOBALS['CONNECTION']->error;
            }
        }
    }
}
//print_r($existingRecords);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Heading Slide Containers</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Edit Heading Slide Containers</h2>

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
                    <input type="hidden" name="<?php echo $record['id']; ?>" value="<?php echo $record['id']; ?>">

                    <label for="iconImage_<?php echo $record['id']; ?>">Icon Image</label><br/>
                    <input type="file" class="img"; name="iconImage<?php echo $record['id']?>" imageName="preview_<?php echo $record['id']?>" id="iconImage_<?php echo $record['id']; ?>" accept="image/*">
                    <?php if ($record['iconImage']): ?>
                        <img src="<?php echo $record['iconImage']; ?>" alt="Preview" id="preview_<?php echo $record['id']?>" style="max-width: 100px; max-height: 100px;">
                    <?php endif; ?>

                    <label for="name_<?php echo $record['id']; ?>">Name</label><br/>
                    <input type="text" name="name_<?php echo $record['id']; ?>" id="name_<?php echo $record['id']; ?>" placeholder="Enter Name" required value="<?php echo $record['name']; ?>">

                    <label for="clickDir_<?php echo $record['id']; ?>">Click Redirect</label><br/>
                    <input type="text" name="clickDir_<?php echo $record['id']; ?>" id="clickRedir_<?php echo $record['id']; ?>" placeholder="Enter Click Redirect" required value="<?php echo $record['clickRedir']; ?>">
                </div>
            <?php endforeach; ?>
            <button type="submit" name="editHeadingSlideContainers">Submit</button>
        </form>

        <script>
            const inputs=document.getElementsByClassName("img")

            for(let i =0;i<inputs.length;i++){
                const e=inputs[i];
if(!inputs[i])continue;
                if(e.getAttribute("type")!=="file")continue;
console.log(e);            
                e.addEventListener('change', function () {

                const preview = document.getElementById(this.getAttribute("imageName"));
                console.log(preview);
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
            }
        </script>
    </div>
</div>
</body>
</html>
