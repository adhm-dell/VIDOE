<?php
class DBController
{
    private string $dbHost = 'localhost';
    private string $dbUser = 'root';
    private string $dbPass = '';
    private string $dbName = 'vidoe';
    private $conn;

    public function openConnection(): bool
    {
        // implement this

        return true | false;
    }
    public function closeConnection(): bool
    {
        // implement this

        return true | false;
    }
    public function runQuery($query): bool
    {
        // implement this
        return true | false;
    }
    public function select($query): array
    {
        // implement this
        return [];
    }
    public function insert($query): bool
    {
        // implement this
        return true | false;
    }
    public function update($query): bool
    {
        // implement this
        return true | false;
    }
    public function delete($query): bool
    {
        // implement this
        return true | false;
    }
    public function count($query): int
    {
        // implement this
        return 0;
    }
}
