<?php 
    include "Conexao.php";
    include "ClienteDAO.php";

    class UsuarioDAO {

        function insertUsuario(Usuario $usuario){
           
          $conn = new Conexao();
          $pdo =  $conn -> conectar();

            try{
                $insert = $pdo->prepare("INSERT INTO tab_cliente (nome, sobrenome, email,cidade,cep,rua,bairro,numero,password, role)
                values (:nome, :sobrenome, :email, :cidade, :cep, :rua,:bairro,:numero,:password, :role)");
                $insert->bindValue("nome", $usuario->getNomeUsuario());
                $insert->bindValue("sobrenome", $usuario->getSobrenome());
                $insert->bindValue("email", $usuario->getEmail());
                $insert->bindValue("cidade", $usuario->getcidade());
                $insert->bindValue("cep", $usuario->getCep());
                $insert->bindValue("rua", $usuario->getRua());
                $insert->bindValue("bairro", $usuario->getBairro());
                $insert->bindValue("numero", $usuario->getNumero());
                $insert->bindValue("password", $usuario->getPassword());
                $insert->bindValue("role", 'USUARIO');
                

                
                $insert -> execute();
                echo "Item inserido com sucesso! <br>";

                $last_id = $pdo-> lastInsertId();

                echo "Id gerado: ", $last_id;
    
                $conn->fechaConexao($conn);
            } catch(PDOException $e) {
                echo "Erro na conexão" .$e->getMessage();
            }
           
        }

        function  consultaUsuario(Usuario $usuario){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();

            try{

                $consulta = $pdo->prepare("SELECT * FROM TAB_CLIENTE WHERE EMAIL = :email and password = :password");
               
                $consulta->bindValue("email", $usuario->getEmail());
                $consulta->bindValue("password", $usuario->getPassword());
                
                $consulta ->execute();

                $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);
              

                while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                    echo "Email: ", $linha['email'] ."<br>";
                    echo "Password: ", $linha['password'] ."<br>";
                    $encontrado = new Usuario();
                    
                   $encontrado->setId($linha['id']);
                   $encontrado->setNomeUsuario($linha['nome']);
                   $encontrado->setSobrenome($linha['sobrenome']);
                   $encontrado->setRole($linha['role']);
                   $encontrado->setcidade($linha['cidade']);
                   $encontrado->setCep($linha['cep']);
                   $encontrado->setRua($linha['rua']);
                   $encontrado->setBairro($linha['bairro']);
                   $encontrado->setNumero($linha['numero']);
                    
                }

                if($encontrado == "" || $encontrado == null){
                    echo "Operador não encontrado <br>";
                } else {
                    echo "<p style='color:green'> Operador encontrado com sucesso! </p> <br>";
                }

                $conn->fechaConexao($conn);

                return $encontrado;

            }catch(PDOException $e) {
                echo "Erro na conexão" . $e->getMessage();
            }
        }
    }
?>