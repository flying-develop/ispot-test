<?php

if (!defined('IN_ENGINE')) {
    die('<b>Error.</b> Script ' . $_SERVER['PHP_SELF'] . ' cannot be runned directly');
}
class Database
{
    private PDO $connection;

    public function __construct()
    {

        try {
            $this->connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USER, DB_PASSWORD);
            $this->checkProductsTable();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }

    public function checkProductsTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `products` (
            `id` INT AUTO_INCREMENT NOT NULL,
            `articul` VARCHAR(255) NOT NULL,
            `name` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE `unique_articul` (`articul`)
        ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }

    public function newProduct(array $data): array
    {

        $response = [
            'status' => 'success',
            'error' => null,
            'row' => $data
        ];

        $sql = 'INSERT INTO products SET articul = :articul, name = :name';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':articul', $data['articul'] ?? null);
        $stmt->bindValue(':name', $data['name'] ?? null);

        try {
            $stmt->execute();
            $response['row']['id'] = $this->connection->lastInsertId();
        } catch (PDOException $e) {
            $response['status'] = 'error';
            $response['error'] = $e->getMessage();
        }

        return $response;
    }

    public function deleteProduct(int $id): array
    {

        $response = [
            'status' => 'success',
            'error' => null,
        ];

        $sql = 'DELETE FROM products WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $response['status'] = 'error';
            $response['error'] = $e->getMessage();
        }

        return $response;

    }

    public function products(): array
    {
        return $this->connection
            ->query('SELECT * FROM products')
            ->fetchAll();
    }

}