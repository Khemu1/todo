<?php
require_once("DB.php");
require("Task.php");



if (isset($_POST["add"])) {
    if (!empty(trim($_POST["task"]))) {
        $data = ['task' => $_POST["task"]]; // Create an array with the task name
        Task::insert($data);
    }
}

if (isset($_GET["delete"]) && isset($_GET["deleteId"])) {
    echo "E";
    Task::delete([
        "id" => $_GET["deleteId"],
        "status" => 1
    ]);

    header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mark"])) {
    $data;
    if ($_POST["status"] == 0) {
        $data = ["status" => 1];
    } else {
        $data = ["status" => 0];
    }
    echo $data == null;
    Task::update($_POST["id"][0], $data);
}



$lists = Task::select();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/style.css" />
    <title>To-do</title>
</head>

<body>
    <div class="container">
        <div class="add-area">
            <form method="POST">
                <div class="add-field">
                    <input type="text" placeholder="add the list" name="task" />
                </div>
                <div class="add-button">
                    <button class="button" name="add">Add</button>
                </div>
            </form>
        </div>
        <div class="list-area">
            <?php if (count($lists) > 0) {
                foreach ($lists as $list) { ?>
                    <form method="POST">
                        <button class="<?= ($list['status'] == 0 ? 'list-container' : 'selected') ?>" name="mark">
                            <input type="hidden" value="<?= $list['id'] ?>" name="id[]" />
                            <input type="hidden" value="<?= $list['status'] ?>" name="status" />
                            <div class="list">
                                <?= $list['task'] ?>
                            </div>
                            <a class="delete-button" href="index.php?delete=true&deleteId=<?= $list['id'] ?>">Delete</a>
                        </button>
                    </form>
                <?php }
            } ?>
        </div>
    </div>
</body>

</html>