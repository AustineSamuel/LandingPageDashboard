<?php
require "../connection.php";
require "../operations/servicesWeProvide.class.php";

$error = false;
$success = false;

// Fetch existing records
$servicesInfo = new ServicesWeProvideInfo($GLOBALS['CONNECTION']);
$existingServices = $servicesInfo->readServicesWeProvide();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {
    $heading = $_POST['heading'];
    $subHeading = $_POST['subHeading'];

    // Check if record exists
    if (!empty($existingServices)) {
        // Update existing record
        $existingService = $existingServices[0]; // Assuming you only need to update the first record
        $id = $existingService['id'];

        if ($servicesInfo->updateServicesWeProvide($id, $heading, $subHeading)) {
            $success = "ServicesWeProvide updated successfully";
        } else {
            $error = "Failed to update ServicesWeProvide: " . $GLOBALS['CONNECTION']->error;
        }
    } else {
        // Insert new record
        if ($servicesInfo->createServicesWeProvide($heading, $subHeading)) {
            $success = "ServicesWeProvide added successfully";
        } else {
            $error = "Failed to add ServicesWeProvide: " . $GLOBALS['CONNECTION']->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit ServicesWeProvide</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Edit ServicesWeProvide</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="">
            <?php if (!empty($existingServices)): ?>
                <?php // Populate form with existing values if record exists ?>
                <?php $existingService = $existingServices[0]; ?>
                <input type="hidden" name="id" value="<?php echo $existingService['id']; ?>">

                <label for="heading">Heading</label><br/>
                <input type="text" name="heading" id="heading" placeholder="Enter Heading" required value="<?php echo $existingService['heading']; ?>">

                <label for="subHeading">Sub Heading</label><br/>
                <textarea type="text" name="subHeading" id="subHeading" placeholder="Enter Sub Heading" required value="<?php echo $existingService['subHeading']; ?>"><?php echo $existingService['subHeading']; ?></textarea>

            <?php else: ?>
                <?php // Default form for new record insertion ?>
                <label for="heading">Heading</label><br/>
                <input type="text" name="heading" id="heading" placeholder="Enter Heading" required>

                <label for="subHeading">Sub Heading</label><br/>
                <textarea type="text" name="subHeading" id="subHeading" placeholder="Enter Sub Heading" required></textarea>

            <?php endif; ?>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
