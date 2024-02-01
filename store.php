<?php
function store(PDO $pdo ) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
        if (!empty(trim($_POST["task"])))   {
            $sql = "INSERT INTO list(task, status) VALUES (:task, 1)";
            try {
                $stmt = $pdo->prepare($sql);
                if ($stmt) {
                    $stmt->bindParam(':task', $_POST["task"]);
                    $stmt->execute();
                    echo "data sent";
                } else {
                    echo "couldn't prep the statement";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
    }
}
// works 5 by 5
