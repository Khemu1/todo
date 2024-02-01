<?php
$db_server = "localhost";
$db_server_name = "root";
$db_name = "lists";
$db_pass = "";

try {
  $pdo = new PDO("mysql:host=$db_server;dbname=$db_name", $db_server_name, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);?>
<?php } catch (\Throwable $th) {
  $th->getMessage() . "<br>";
  echo "<br>" . "didn't Connect to database" . "<br>";

  exit();
}
?>