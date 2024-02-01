<?php
/**
 * @var PDO $pdo
 */
require_once "DB.php";

//$pdo->

class Task
{
    //    self::$columns
    private static string $table = "list";
    private static array $columns = ["id", "task", "status"];
    private static DB $db;

    public function __construct()
    {
    }
    // must be added in order to make the object because you can't give default values to objects in classes in PHP
    public static function init()
    {
        if (!isset(self::$db)) {
            self::$db = new DB();
        }
    }

    public static function insert(array $data): bool
    {
        self::init();
        return self::$db->insert(self::$table, $data);
    }

    public static function select($columns = null): array
    {
        self::init();
        return self::$db->select(self::$table, $columns ?? self::$columns); // this says if the user don't the $columns it will take the default columns of the class
    }

    public static function delete(array $conditions): void
    {
        self::init();
        self::$db->delete(self::$table, $conditions);
    }

    public static function getCompleted(array $columns = ["*"]): array
    {
        self::init();
        $statement = self::$db->pdo->prepare("SELECT * FROM" . self::$table . " WHERE status = 1");
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function update(int $id, array $data)
    {
        self::init();
        self::$db->update(self::$table, $id, $data);
    }
}