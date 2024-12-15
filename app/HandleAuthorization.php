<?php 
class HandleAuthorization extends MySQLConnection {
    public function checkValidLogin($login, $password) {
        $this->connection();
        try {
            $query = "SELECT * FROM users WHERE login = :login";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1) {
                foreach ($stmt as $row) {
                    if ($login == $row['login'] && password_verify($password, $row['password']) == TRUE) {
                        $_SESSION['login'] = $login;
                        session_regenerate_id();
                        return true;
                    } else {
                        return false;
                    }
                }
            }

            if ($stmt->rowCount() > 1) {
                return false;
            }

            if ($stmt->rowCount() == 0) {
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        $this->disconnect();
    }

    public function addUser($login, $password) {
        $this->connection();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (login, password)
        VALUES (:login, :password)";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":login", $login);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->execute();

        echo "Użytkownik {$login} dodany.";
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        

        $this->disconnect();
    }

    public function logOut(){
        session_destroy();
        header("location: /");
    }
}