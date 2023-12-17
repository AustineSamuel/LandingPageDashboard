<?php
require "../connection.php";
require "../operations/BusinessInfoList.class.php";
$error=false;
$success=false;
// Handle form submission for editing or deleting an item
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $businessInfoListInfo = new BusinessInfoListInfo($GLOBALS['CONNECTION']);

    if (isset($_POST['editItem'])) {
        // Edit an existing record
        $id = $_POST['id'];
        $text = $_POST['text'];

        if ($businessInfoListInfo->updateBusinessInfoListItem($id, $text)) {
            $success = "Business Info List Item updated successfully";
        } else {
            $error = "Failed to update Business Info List Item";
        }
    } elseif (isset($_POST['deleteItem'])) {
        // Delete an existing record
        $id = $_POST['id'];

        if ($businessInfoListInfo->deleteBusinessInfoListItem($id)) {
            $success = "Business Info List Item deleted successfully";
        } else {
            $error = "Failed to delete Business Info List Item";
        }
    }
}

// Fetch existing business info list items
$existingItems = (new BusinessInfoListInfo($GLOBALS['CONNECTION']))->readBusinessInfoListItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit/Delete Business Info List Item</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Edit/Delete Business Info List Item</h2>

        <?php
        echo $success ? "<div class='alert alert-success'>
            <strong>Success!</strong> $success
        </div>" : "";

        echo $error ? "<div class='alert alert-danger'>
            <strong>Error:</strong> $error
        </div>" : "";
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Text</th>
                <th>Action</th>
            </tr>
            <?php foreach ($existingItems as $item): ?>
                <tr style="padding:5px"> </tr>
                <tr style="padding:10px;box-shadow:1px 1px 10px 0px lightgrey">
                <form method="post" action="">

                    <td><?php echo $item['id']; ?></td>
                    <td>  <textarea name="text" value="<?php echo $item['text']; ?>"><?php echo $item['text']; ?></textarea>
                    <td>
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                          
                            <button type="submit" name="editItem">Edit</button>
                            <button type="submit" name="deleteItem" style="margin:2px;" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <Button style="width:100%;" onclick="window.location.href='addBusinessInfo.php'">Add new</Button>
        <br/>
    </div>
</div>
</body>
</html>
