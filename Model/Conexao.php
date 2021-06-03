<?php
    class Conexao {
    private $servername = "localhost:3306";
    private $username = "root";
    private $password = 91628319;
    private $dbname = "db_mercado";

    private $conn;
           

     function conectar(){

        try {
            $this->conn =   new PDO("mysql:host=$this->servername; 
            dbname=$this->dbname", $this->username, $this->password);

            $this->conn = new PDO("mysql:host=$this->servername; 
            dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           

            return $this->conn;
            
        } catch(PDOException $e) {
            echo "Erro na conexão: " .$e->getMessage() ."<br>";
        }
    } 

    function executar($insert){
        $this->conn->exec($insert);
       return  $this->conn->lastInsertId();
    }

    function fechaConexao($conn){
        $conn = null;
        return $conn;
    }

    }
    
?>