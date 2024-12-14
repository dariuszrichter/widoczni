<?php 
class GetDataFromMySQL extends MySQLConnection {
    

    public function getAllData($table) {
        $this->connection();

        $query = "SELECT * FROM $table";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->disconnect();

        return $data;
    }

    public function getIndividualData($query) {
        $this->connection();

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->disconnect();

        return $data;
    }

    
}