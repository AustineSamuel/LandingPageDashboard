<?php
require "../connection.php";
require "../operations/PageInfo.class.php";

// Registration File (inserts a default admin)
$error = false;
$success = false;
$currentInfo = getTable("pageInfo");

// Login File
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pageInfo = new Pageinfo($GLOBALS['CONNECTION']);
    $logo = uploadImage($_FILES['logo'],"../images/");
    
    if (!$logo) {
        $error = "Error: Logo upload returned with {$logo}";
    } else {
        $name = $_POST["name"];
        
        if (count($currentInfo) <= 0) {
            $pageInfo->createPageInfo("/images/", $name);
        } else {
            if ($pageInfo->updatePageInfo($currentInfo[0]['id'],"/images/".$logo, $name)) {
                $success = "Update successful!";
            } else {
                $error = "Failed to update logo";
            }
        }
    }
}

// HTML Form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Page Logo</title>
    <link rel="stylesheet" href="../../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="" enctype="multipart/form-data">
            <?php
         $url = count($currentInfo) > 0 ? $currentInfo[0]['logo'] : "/frontend/images/logo-black.svg";
            echo "<br/>
                <div style='text-align:center'>
                    <img id='logoReview' style='width:140px;height:140px;' src='$url'/>
                </div>";
            ?>

            <h2>Update page logo</h2>

            <label for="name">Site Name</label>
            <input value="<?=$currentInfo[0]['name']?>" type="text" name="name" id="name" placeholder="Enter site name" required>

            <label class="btn" for="logo" style="
                padding: 10px;
                background-color:maroon;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                display:inline-block;
                text-align:center;
            ">Select Image File</label><br/>

            <input onchange="updateLogoReview()" type="file" name="logo" id="logo" hidden required>
<button type="submit" name="login">Submit</button>
<br/>
        </form>
    </div>
</body>
<script>
    function updateLogoReview() {
        // Update #logoReview with the selected image file
        var selectedFile = document.getElementById('logo').files[0];
        if (selectedFile) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('logoReview').src = e.target.result;
            };
            reader.readAsDataURL(selectedFile);
        }
    }
</script>
</html>
