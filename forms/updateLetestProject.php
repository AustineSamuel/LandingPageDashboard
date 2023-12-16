<?php
require "../connection.php";
require "../operations/LetestProjectsList.class.php";

$error = false;
$success = false;

// Initialize LatestProjectsListInfo object
$latestProjectsListInfo = new LatestProjectsListInfo($GLOBALS['CONNECTION']);

// Fetch existing projects
$existingProjects = $latestProjectsListInfo->readLatestProjectList();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['editLatestProjectList'])) {
    foreach ($existingProjects as $project) {
        $id = $project['id'] ?? null;
        $image = $project['image'];
        $heading = $project['heading'];
        $subHeading = $project['subHeading'];

        // Process image upload
        if (isset($_FILES["image" . $id]) && $_FILES["image" . $id]['error'] == UPLOAD_ERR_OK){
            if (file_exists($image)) {
                if (!unlink($image)) {
                    $error = "Failed to delete file";
                }
            }

            $uploadedImage = uploadImage($_FILES["image" . $id], "../images/");
            if ($uploadedImage) {
                $image = "/images/" . $uploadedImage;
            } else {
                $error = "Error uploading image";
                break;
            }
        }

        // Update existing record
        if ($id !== null) {
            if ($latestProjectsListInfo->updateLatestProjectList($id, $image, $heading, $subHeading)) {
                $success = "Latest Project List updated successfully";
            } else {
                $error = "Failed to update Latest Project List: " . $GLOBALS['CONNECTION']->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Latest Project List</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container" style="display:block">
    <div class="card" style="margin:0 auto;">
        <h2>Edit Latest Project List</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="" enctype="multipart/form-data">
            <?php foreach ($existingProjects as $project): ?>
                <div class="record" style="text-align: start;">
                <br/>
                    <input type="hidden" name="<?php echo $project['id']; ?>" value="<?php echo $project['id']; ?>">

                    <?php if ($project['image']): ?>
                        <img src="<?php echo $project['image']; ?>" alt="Preview" id="preview_<?php echo $project['id']?>" style="max-width: 100px; max-height: 100px;"><br/>
                    <?php endif; ?>
                    <label for="image_<?php echo $project['id']; ?>">Image</label><br/>
                    <input style="width:90%" type="file" class="img" name="image<?php echo $project['id']?>" id="image_<?php echo $project['id']; ?>" accept="image/*">
                
                    <label for="heading_<?php echo $project['id']; ?>">Heading</label><br/>
                    <input  style="width:90%" type="text" name="heading_<?php echo $project['id']; ?>" id="heading_<?php echo $project['id']; ?>" placeholder="Enter Heading" required value="<?php echo $project['heading']; ?>">

                    <label for="subHeading_<?php echo $project['id']; ?>">Subheading</label><br/>
                    <input  style="width:90%" type="text" name="subHeading_<?php echo $project['id']; ?>" id="subHeading_<?php echo $project['id']; ?>" placeholder="Enter Subheading" required value="<?php echo $project['subHeading']; ?>">
                </div>
            <?php endforeach; ?>
            <button type="submit" name="editLatestProjectList">Submit</button>
        </form>

        <script>
            const inputs=document.getElementsByClassName("img")

            for(let i = 0; i < inputs.length; i++){
                const e = inputs[i];
                if (!inputs[i]) continue;
                if (e.getAttribute("type") !== "file") continue;

                e.addEventListener('change', function () {
                    const preview = document.getElementById(this.getAttribute("id").replace("image_", "preview_"));
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
