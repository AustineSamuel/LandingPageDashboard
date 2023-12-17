<?php
require "../connection.php";
require "../operations/LetestProjects.class.php";

$error = false;
$success = false;

// Fetch existing projects
$latestProjectsInfo = new LatestProjectsInfo($GLOBALS['CONNECTION']);
$existingProjects = $latestProjectsInfo->readLatestProjects();


$id = null;
$heading = '';
$subHeading = '';
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['editLatestProject'])) {
    // Assuming there's only one record for LatestProjects
    $project = reset($existingProjects);
    if($existingProjects && count($existingProjects) > 0){
    $id = $project['id'] ?? null;
    $heading = $project['heading'];
    $subHeading = $project['subHeading'];
    }

    // Check if form is submitted with updated values
    if (isset($_POST['heading']) && isset($_POST['subHeading'])) {
        $heading = $_POST['heading'];
        $subHeading = $_POST['subHeading'];

        // Update existing record
        if(count($existingProjects)>0){
        if ($latestProjectsInfo->updateLatestProject($id, $heading, $subHeading)) {
            $success = "Latest Project updated successfully";
        } else {
            $error = "Failed to update Latest Project: " . $GLOBALS['CONNECTION']->error;
        }
    }
    else{
        //else add new
        if ($latestProjectsInfo->createLatestProject($heading, $subHeading)) {
            $success = "Latest Project added successfully";
        } else {
            $error = "Failed to add Latest Project: " . $GLOBALS['CONNECTION']->error;
        }
    
    }
    } else {
        // Form submitted without updated values, no need to update, just display the existing values
    }
}
$existingProjects=$existingProjects[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Latest Project</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Edit Latest Project</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="">
            <div class="record" style="text-align: start;width:100%;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <br/>
                <label for="heading">Heading</label><br/>
                
                <input style="width:95%;" type="text" name="heading" id="heading" placeholder="Enter Heading" required value="<?php echo $existingProjects['heading']; ?>">

<br/>
                <label for="subHeading">Subheading</label><br/>
                <textarea style="width:95%;" type="text" name="subHeading" id="subHeading" placeholder="Enter Subheading" required value="<?php echo $existingProjects['subHeading']; ?>"><?php echo $existingProjects['subHeading']; ?></textarea>

            </div>
            <button type="submit" name="editLatestProject">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
