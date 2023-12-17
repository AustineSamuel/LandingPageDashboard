<?php
require "../connection.php";
require "../operations/navigations.class.php";
$error = false;
$success = false;
// Handle form submission for deleting an item
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['deleteItem'])) {
    $navigationInfo = new NavigationInfo($GLOBALS['CONNECTION']);
    $id = $_POST['id'];
    if ($navigationInfo->deleteNavigation($id)) {
        $success = "Navigation item deleted successfully";
    } else {
        $error = "Failed to delete navigation item";
    }
}
// Fetch existing navigation items
$existingNavigations = (new NavigationInfo($GLOBALS['CONNECTION']))->readNavigations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List/Delete Navigation Items</title>
    <link rel="stylesheet" href="../login/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>List/Delete Navigation Items</h2>

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
                <th>Name</th>
                <th>HashTag</th>
                <th>Action</th>
            </tr>
            <?php foreach ($existingNavigations as $navigation): ?>
                <tr style="border:1px solid lightgrey;padding:10px; margin-top:4px;">
                    <td><?php echo $navigation['id']; ?></td>
                    <td><?php echo $navigation['name']; ?></td>
                    <td><?php echo $navigation['hashTag']; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="id" value="<?php echo $navigation['id']; ?>">
                            <button type="submit" name="deleteItem" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>
