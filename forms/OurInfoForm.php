<?php
require "../connection.php";
require "../operations/OurInfo.class.php";

$error = false;
$success = false;

// Fetch existing records
$ourInfo = new OurInfo($GLOBALS['CONNECTION']);
$existingInfo = $ourInfo->readOurInfo();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {
    $yearsOfExperience = $_POST['yearsOfExperience'];
    $talentedTeam = $_POST['talentedTeam'];
    $projectsDelivered = $_POST['projectsDelivered'];
    $countriesServed = $_POST['countriesServed'];

    // Check if record exists
    if (!empty($existingInfo)) {
        // Update existing record
        $existingRecord = $existingInfo[0]; // Assuming you only need to update the first record
        $id = $existingRecord['id'];

        if ($ourInfo->updateOurInfo($id, $yearsOfExperience, $talentedTeam, $projectsDelivered, $countriesServed)) {
            $success = "OurInfo updated successfully";
        } else {
            $error = "Failed to update OurInfo: " . $GLOBALS['CONNECTION']->error;
        }
    } else {
        // Insert new record
        if ($ourInfo->createOurInfo($yearsOfExperience, $talentedTeam, $projectsDelivered, $countriesServed)) {
            $success = "OurInfo added successfully";
        } else {
            $error = "Failed to add OurInfo: " . $GLOBALS['CONNECTION']->error;
        }
    }
}

//print_r($existingInfo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit OurInfo</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Edit OurInfo</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="">
            <?php if (!empty($existingInfo)): ?>
                <?php // Populate form with existing values if record exists ?>
                <?php $existingRecord = $existingInfo[0]; ?>
                <input type="hidden" name="id" value="<?php echo $existingRecord['id']; ?>">

                <label for="yearsOfExperience">Years of Experience</label><br/>
                <input type="text" name="yearsOfExperience" id="yearsOfExperience" placeholder="Enter Years of Experience" required value="<?php echo $existingRecord['YearsOfExperience']; ?>">

                <label for="talentedTeam">Talented Team</label><br/>
                <input type="text" name="talentedTeam" id="talentedTeam" placeholder="Enter Talented Team" required value="<?php echo $existingRecord['talentedTeam']; ?>">

                <label for="projectsDelivered">Projects Delivered</label><br/>
                <input type="text" name="projectsDelivered" id="projectsDelivered" placeholder="Enter Projects Delivered" required value="<?php echo $existingRecord['projectsDelivered']; ?>">

                <label for="countriesServed">Countries Served</label><br/>
                <input type="text" name="countriesServed" id="countriesServed" placeholder="Enter Countries Served" required value="<?php echo $existingRecord['countriesServed']; ?>">
            <?php else: ?>
                <?php // Default form for new record insertion ?>
                <label for="yearsOfExperience">Years of Experience</label><br/>
                <input type="text" name="yearsOfExperience" id="yearsOfExperience" placeholder="Enter Years of Experience" required>

                <label for="talentedTeam">Talented Team</label><br/>
                <input type="text" name="talentedTeam" id="talentedTeam" placeholder="Enter Talented Team" required>

                <label for="projectsDelivered">Projects Delivered</label><br/>
                <input type="text" name="projectsDelivered" id="projectsDelivered" placeholder="Enter Projects Delivered" required>

                <label for="countriesServed">Countries Served</label><br/>
                <input type="text" name="countriesServed" id="countriesServed" placeholder="Enter Countries Served" required>
            <?php endif; ?>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
