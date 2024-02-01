<?php
function fetch(PDO $pdo): array | false
{
    $sql = "SELECT * FROM list";
    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt) {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "couldn't continue after preparing" . "<br>";
        }
    } catch (\Throwable $th) {
        $th->getMessage();
    }
    return [];
}

// delete rows

if (isset($_GET["delete"])) {
    $sql = "DELETE FROM list WHERE id = :id and status=1";
    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':id', $_GET["deleteId"]);
            $stmt->execute();
            echo "Deletion has been completed";
        } else {
            echo "Error preparing the statement";
        }
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
}


