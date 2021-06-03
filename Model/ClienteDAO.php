<?php 
    //include "Conexao.php";
    class ClienteDAO {

        function insertCliente($id_usuario){

            try{
                $conn = new Conexao();
                $pdo =  $conn -> conectar();

                $insert = $pdo->prepare("INSERT INTO tab_cliente (id_usuario)
                values (:id_usuario)");
                $insert->bindParam("id_usuario", $id_usuario);

                $insert->execute();


            } catch(PDOException $e) {
                echo "Erro na conexão" .$e->getMessage();
            }
            
        }

    }

?>