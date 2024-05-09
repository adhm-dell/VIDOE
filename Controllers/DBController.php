<?php
class DBController
{
    private string $dbHost = 'localhost';
    private string $dbUser = 'root';
    private string $dbPassword = '';
    private string $dbName = 'vidoe';
    private $conn;

    public function openConnection(): bool
    {
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
            return false;
        } else {
            return true;
        }
    }
    public function closeConnection(): bool
    {
        if ($this->conn) {
            $this->conn->close();
            return true;
        } else {
            return false;
        }
    }
    public function insert($data, $tableName): int
    {
        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO " . $tableName . " (";
        $sql .= implode(",", array_keys($data)) . ") VALUES (";
        $placeholders = array_fill(0, count($data), "?");
        $sql .= implode(",", $placeholders) . ")";

        $stmt = $this->conn->prepare($sql);

        // Bind values to placeholders
        $values = array_values($data);
        $stmt->bind_param(str_repeat('s', count($values)), ...$values);

        // Execute the statement
        $stmt->execute();

        // Check for errors
        if ($stmt->error) {
            die("Error inserting data: " . $stmt->error);
        }

        return $stmt->insert_id;
        // returns the id for the last inserted row (if > 0 it works fine otherwise there is an error)
    }

    public function delete($id, $tableName): int
    {
        $sql = "DELETE FROM " . $tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->error) {
            die("Error deleting data: " . $stmt->error);
        }

        return $stmt->affected_rows;
        // return the number of affected rows (if 0 there is an error)
    }

    public function update($id, $data, $tableName): int
    {
        $sql = "UPDATE " . $tableName . " SET ";
        $updates = [];
        foreach ($data as $key => $value) {
            $updates[] = $key . "=?";
        }
        $sql .= implode(",", $updates) . " WHERE id = ?";

        // example: UPDATE your_table_name SET name=?, email=? WHERE id = ?

        $stmt = $this->conn->prepare($sql);

        $values = array_merge(array_values($data), [$id]);
        $stmt->bind_param(str_repeat('s', count($values)), ...$values);
        $stmt->execute();

        if ($stmt->error) {
            die("Error updating data: " . $stmt->error);
        }

        return $stmt->affected_rows;
        // return the number of affected rows (if 0 there is an error)
    }

    public function select($where = null, $order = null, $limit = null, $tableName): array
    {
        $sql = "SELECT * FROM " .  $tableName;
        if ($where) {
            $sql .= " WHERE " . $where;
        }
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        if ($limit) {
            $sql .= " LIMIT " . $limit;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $stmt->close();
        return $data;
    }

    public function selectWithInnerJoin($where = "", $order = "", $limit = "", $tableName, $joinTable, $joinCondition): array
    {
        $sql = "SELECT * FROM " . $tableName;
        if ($joinTable && $joinCondition) {
            $sql .= " INNER JOIN " . $joinTable . " ON " . $joinCondition;
        }
        if ($where) {
            $sql .= " WHERE " . $where;
        }
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        if ($limit) {
            $sql .= " LIMIT " . $limit;
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function selectWithInnerJoinThreeTables($where = null, $order = null, $limit = null, $tableName, $joinTable1, $joinCondition1, $joinTable2, $joinCondition2): array
    {
        $sql = "SELECT * FROM " . $tableName;
        if ($joinTable1 && $joinCondition1) {
            $sql .= " INNER JOIN " . $joinTable1 . " ON " . $joinCondition1;
        }
        if ($joinTable2 && $joinCondition2) {
            $sql .= " INNER JOIN " . $joinTable2 . " ON " . $joinCondition2;
        }
        if ($where) {
            $sql .= " WHERE " . $where;
        }
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        if ($limit) {
            $sql .= " LIMIT " . $limit;
        }

        // ex: SELECT * FROM video_category INNER JOIN video ON video_category.video_id=video.id INNER JOIN category ON video_category.category_id = category.id

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
    public function count($tableName): int
    {
        $sql = "SELECT COUNT(*) FROM " . $tableName;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_row();
        $count = $row[0]; // Assuming the first column (index 0) holds the count

        $stmt->close();
        return $count;
    }

    public function Query($qry): bool
    {
        $result = $this->conn->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->conn);
            return false;
        } else {
            return $result;
        }
    }
}
