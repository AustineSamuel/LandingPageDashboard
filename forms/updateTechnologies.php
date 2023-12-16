<?php
require "../connection.php";
require "../operations/Technologies.class.php";

$error = false;
$success = false;

// Fetch existing technologies
$technologiesInfo = new TechnologiesInfo($GLOBALS['CONNECTION']);
$existingTechnologies = $technologiesInfo->readTechnologies();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['editTechnologies'])) {
    foreach ($existingTechnologies as $technology) {
        $id = $technology['id'] ?? null;
        $iconImage = $technology['icon'];
        $name = $technology['name'];
if(isset($_POST["name".$id]))$name=$_POST["name".$id];
        // Process image upload
        if (isset($_FILES["iconImage" . $id]) && $_FILES["iconImage" . $id]['error'] === UPLOAD_ERR_OK) {
            if (file_exists($iconImage)) {
                if (!unlink($iconImage)) {
                    $error = "Failed to delete file";
                }
            }

            $uploadedIcon = uploadImage($_FILES["iconImage" . $id], "../images/");
            if ($uploadedIcon) {
                $iconImage = "/images/" . $uploadedIcon;
            } else {
                $error = "Error uploading icon image";
                break;
            }
        }

        if ($id !== null) {
            // Update existing record
            if ($technologiesInfo->updateTechnology($id, $name, $iconImage)) {
                $success = "Technology updated successfully";
            } else {
                $error = "Failed to update technology: " . $GLOBALS['CONNECTION']->error;
            }
        }
    }
}
//print_r($existingTechnologies);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Technologies</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Edit Technologies</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="" enctype="multipart/form-data">
            <?php foreach ($existingTechnologies as $technology): ?>
                <div class="record" style="text-align: start;">
                    <input type="hidden" name="<?php echo $technology['id']; ?>" value="<?php echo $technology['id']; ?>">

                    <label for="iconImage_<?php echo $technology['id']; ?>">Icon Image</label><br/>
                    <input type="file" class="img" name="iconImage<?php echo $technology['id']?>" imageName="preview_<?php echo $technology['id']?>" id="iconImage_<?php echo $technology['id']; ?>" accept="image/*">
                    <?php if ($technology['icon']): ?>
                        <img src="<?php echo $technology['icon']; ?>" alt="Preview" id="preview_<?php echo $technology['id']?>" style="max-width: 100px; max-height: 100px;">
                    <?php endif; ?><br/>

                    <label for="name_<?php echo $technology['id']; ?>">Name</label><br/>
                    <input type="text" name="name<?php echo $technology['id']; ?>" id="name_<?php echo $technology['id']; ?>" placeholder="Enter Name" required value="<?php echo $technology['name']; ?>">
                </div>
            <?php endforeach; ?>
            <button type="submit" name="editTechnologies">Submit</button>
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
