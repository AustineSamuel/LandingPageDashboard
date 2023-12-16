<?php
require "../connection.php";
require "../operations/editHeadingTexts.class.php";

$error = false;
$success = false;

// Fetch existing record
$editHeadingTexts = new EditHeadingTextsInfo($GLOBALS['CONNECTION']);
$existingRecords = $editHeadingTexts->readEditHeadingTexts();

// Check if there's only one record
$isSingleRecord = count($existingRecords) === 1;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $h1 = $_POST['h1'];
    $playButtonLink = $_POST['playButtonLink'];
    $subH1 = $_POST['subH1'];
    $getStartedLink = $_POST['getStartedLink'];
    $headingMessageText = $_POST['headingMessageText'];

    if ($isSingleRecord) {
        // Update existing record
        if ($editHeadingTexts->updateEditHeadingTexts($existingRecords[0]['id'], $h1, $playButtonLink, $subH1, $getStartedLink, $headingMessageText)) {
            $success = "Edit Heading Texts updated successfully";
        } else {
            $error = "Failed to update Edit Heading Texts: " . $GLOBALS['CONNECTION']->error;
        }
    } else {
        // Create new record
        if ($editHeadingTexts->createEditHeadingTexts($h1, $playButtonLink, $subH1, $getStartedLink, $headingMessageText)) {
            $success = "Edit Heading Texts added successfully";
        } else {
            $error = "Failed to add Edit Heading Texts: " . $GLOBALS['CONNECTION']->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add/Edit Heading Texts</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Add/Edit Heading Texts</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>
        <form method="post" action="">
            <label for="h1">H1</label>
            <input type="text" name="h1" id="h1" placeholder="Enter H1" required value="<?php echo $isSingleRecord ? $existingRecords[0]['h1'] : ''; ?>">
        
            <label for="playButtonLink">Play Button Link</label>
            <input type="text" name="playButtonLink" id="playButtonLink" placeholder="Enter Play Button Link" required value="<?php echo $isSingleRecord ? $existingRecords[0]['playButtonLink'] : ''; ?>">
        
            <label for="subH1">Sub H1</label>
            <input type="text" name="subH1" id="subH1" placeholder="Enter Sub H1" required value="<?php echo $isSingleRecord ? $existingRecords[0]['subH1'] : ''; ?>">
        
            <label for="getStartedLink">Get Started Link</label>
            <input type="text" name="getStartedLink" id="getStartedLink" placeholder="Enter Get Started Link" required value="<?php echo $isSingleRecord ? $existingRecords[0]['getStartedLink'] : ''; ?>">
        
            <label for="headingMessageText">Heading Message Text</label>
            <textarea name="headingMessageText" id="headingMessageText" placeholder="Enter Heading Message Text" required><?php echo $isSingleRecord ? $existingRecords[0]['headingMessageText'] : ''; ?></textarea>
            <br/>
            <button type="submit" name="addEditHeadingTexts">Submit</button>
        </form>
        
    </div>
</div>
</body>
</html>
