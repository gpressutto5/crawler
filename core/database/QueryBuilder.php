<?php
class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table, $limit = null, $offset = 0)
    {
        $query = "SELECT * FROM {$table}";
        if ($limit) {
            $query .= " LIMIT :offset,:limit";
        }
        $statement = $this->pdo->prepare($query);
        if ($limit) {
            $statement->bindParam(":limit", $limit, PDO::PARAM_INT);
            $statement->bindParam(":offset", $offset, PDO::PARAM_INT);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function select($table, $columns, $limit = null, $offset = 0)
    {
        foreach ($columns as &$value) {
            $value = "`{$value}`";
        }
        $query = "SELECT ".implode(",", $columns)." FROM {$table}";
        if ($limit) {
            $query .= " LIMIT :offset,:limit";
        }
        $statement = $this->pdo->prepare($query);
        if ($limit) {
            $statement->bindParam(":limit", $limit, PDO::PARAM_INT);
            $statement->bindParam(":offset", $offset, PDO::PARAM_INT);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function countAll($table)
    {
        $statement = $this->pdo->prepare("SELECT COUNT(*) AS count FROM {$table}");
        $statement->execute();
        return $statement->fetch()['count'];
    }
}
