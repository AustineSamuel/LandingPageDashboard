<?php
require "../connection.php";
require "../operations/whoWeAre.class.php";

$error = false;
$success = false;

// Initialize the WhoWeAreComponentInfo object
$whoWeAreComponentInfo = new WhoWeAreComponentInfo($GLOBALS['CONNECTION']);

// Fetch existing records
$existingComponents = $whoWeAreComponentInfo->readWhoWeAreComponents();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {
    // Assuming the form fields are named 'heading', 'text', 'buttonText', and 'clickRedir'
    $heading = $_POST['heading'];
    $text = $_POST['text'];
    $buttonText = $_POST['buttonText'];
    $clickRedir = $_POST['clickRedir'];

    if (count($existingComponents) > 0) {
        // At least one record exists, update the first record
        $firstComponent = $existingComponents[0];
        $id = $firstComponent['id'];

        if ($whoWeAreComponentInfo->updateWhoWeAreComponent($id, $heading, $text, $buttonText, $clickRedir)) {
            $success = "Who We Are Component updated successfully";
        } else {
            $error = "Failed to update Who We Are Component: " . $GLOBALS['CONNECTION']->error;
        }
    } else {
        // No records exist, insert a new record
        if ($whoWeAreComponentInfo->createWhoWeAreComponent($heading, $text, $buttonText, $clickRedir)) {
            $success = "Who We Are Component added successfully";
        } else {
            $error = "Failed to add Who We Are Component: " . $GLOBALS['CONNECTION']->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add/Edit Who We Are Component</title>
    <link rel="stylesheet" href="../login/style.css">
    <!-- Add your stylesheets or include Bootstrap, etc. -->
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Add/Edit Who We Are Component</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <form method="post" action="">
        <?php if (count($existingComponents) > 0): ?>
        <?php // Populate form with existing values if record exists ?>
        <?php $firstComponent = $existingComponents[0]; ?><br/>
        <label for="heading">Heading</label>
        <input type="text" name="heading" id="heading" placeholder="Enter Heading" required value="<?php echo $firstComponent['heading']; ?>">
<br/>
        <label for="text">Text</label>
        <textarea name="text" id="text" placeholder="Enter Text" required><?php echo $firstComponent['text']; ?></textarea>
<br/>
        <label for="buttonText">Button Text</label>
        <input type="text" name="buttonText" id="buttonText" placeholder="Enter Button Text" required value="<?php echo $firstComponent['buttonText']; ?>">
<br/>
        <label for="clickRedir">Click Redirect</label>
        <input type="text" name="clickRedir" id="clickRedir" placeholder="Enter Click Redirect" required value="<?php echo $firstComponent['clickRedir']; ?>">
    <?php else: ?>
        <?php // Default form for new record insertion ?>
        <br/>
        <label for="heading">Heading</label>
        <input type="text" name="heading" id="heading" placeholder="Enter Heading" required>
<br/>
        <label for="text">Text</label>
        <textarea name="text" id="text" placeholder="Enter Text" required></textarea>
<br/>
        <label for="buttonText">Button Text</label>
        <input type="text" name="buttonText" id="buttonText" placeholder="Enter Button Text" required>
        <br/>
        <label for="clickRedir">Click Redirect</label>
        <input type="text" name="clickRedir" id="clickRedir" placeholder="Enter Click Redirect" required>
    <?php endif; ?>

    <Button type="submit" name="submit">Submit</Button>

</form>
    </div>
</div>

</body>
</html>
