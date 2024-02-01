<?php

class DB
{
    private string $server = "localhost";
    private string $user = "root";
    private string $db = "lists";
    private string $password = "";
    public static PDO $pdo;

    // if you have any static attributes use ->   self:: to call them
    public function __construct()
    {
        try {
            self::$pdo = new PDO("mysql:host=$this->server;dbname=$this->db", $this->user, $this->password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Throwable $th) {
            echo $th->getMessage() . "<br>" . "bro cant open the db so sad";
        }
    }

    public static function insert(string $table, array $data): bool
    {
        $binds = array_keys($data);
        $placeholders = array_map(
            fn(string $key): string => ":$key",
            array_keys($data)
        );

        $sql = "INSERT INTO $table (" . implode(", ", $binds) . ")
            VALUES (" . implode(", ", $placeholders) . ")";

        $statement = self::$pdo->prepare($sql);

        return $statement->execute($data);
    }


    public static function select(string $table, array $columns): array
    {
        $statement = self::$pdo->prepare("
            SELECT " . implode(", ", $columns) . " FROM $table
        ");

        $statement->execute();
        return $statement->fetchAll();
    }

    public static function update(string $table, int $id, array $data): bool
    {
        $placeholder = array_map(
            fn(string $key): string => "{$key} = :{$key}",
            array_keys($data)
        );
        // had to remove the parentheses from the SET
        $statement = self::$pdo->prepare("
            UPDATE $table SET " . implode(", ", $placeholder) . "
            WHERE id = $id
        ");

        return $statement->execute($data);
    }

    public static function delete(string $table, array $conditions): void
    {
        $extraQuery = array_map(
            fn(string $key): string => "$key = :$key",
            array_keys($conditions)
        );

        $statement = self::$pdo->prepare("DELETE FROM $table WHERE " . implode(" AND ", $extraQuery));
        echo "DELETE FROM $table WHERE " . implode(" AND ", $extraQuery);
        $statement->execute($conditions);
    }
}