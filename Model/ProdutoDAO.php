<?php 
    include "Conexao.php";
    include "AvaliacaoProduto.php";
    class ProdutoDAO {

        function  listarTodosProdutos(){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();

            try{

                $consulta = $pdo->prepare("SELECT * FROM db_mercado.tab_produto");
                
                $consulta ->execute();

                $listaProduto = array();

                $i=0;

                $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);

                while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                    $produto = new Produto();

                    $produto->setId($linha['id']);
                    $produto->setName($linha['nome']);
                    $produto->setvl_produto($linha['preco']);
                    $produto->setCategoria($linha['categoria']);
                    $produto->setImagem($linha['imagem']);
                    
                    $listaProduto[$i] = $produto;
           
                    $i++;
                    
                }

                return $listaProduto;

                $conn->fechaConexao($conn);

               

            }catch(PDOException $e) {
                echo "Erro na conexão" . $e->getMessage();
            }
        }

        public function listarProdutoEspecifico($id_produto){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();

            try{

                $consulta = $pdo->prepare("SELECT * FROM db_mercado.tab_produto where id = :id");
                $consulta->bindValue("id",$id_produto);
               
                $consulta ->execute();

               // $listaProduto = array();

                $i=0;

                $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);

                while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                    $produto = new Produto();

                    $produto->setId($linha['id']);
                    $produto->setName($linha['nome']);
                    $produto->setvl_produto($linha['preco']);
                    $produto->setCategoria($linha['categoria']);
                    $produto->setImagem($linha['imagem']);
                    
                   // $listaProduto[$i] = $produto;
           
                    $i++;
                    
                }

                return $produto;

                $conn->fechaConexao($conn);
     

            }catch(PDOException $e) {
                echo "Erro na conexão" . $e->getMessage();
            }
        }

        public function avaliacaoProduto($nome,$email,$texto,$id_produto) {
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
  
              try{
                  $insert = $pdo->prepare("INSERT INTO tab_aval_produto (nome, email, texto,id_produto,data)
                  values (:nome, :email, :texto, :id_produto, CURDATE())");
                  $insert->bindValue("nome", $nome);
                  $insert->bindValue("email", $email);
                  $insert->bindValue("texto", $texto);
                  $insert->bindValue("id_produto", $id_produto);
                 // $insert->bindValue("data", "curdate()");                  
                  var_dump($insert);
                  $insert -> execute();
                  echo "Item inserido com sucesso! <br>";
  
                  $last_id = $pdo-> lastInsertId();
  
                  echo "Id gerado: ", $last_id;
      
                  $conn->fechaConexao($conn);
              } catch(PDOException $e) {
                  echo "Erro na conexão" .$e->getMessage();
              }
             
        }

        public function consultaAvaliacao($Id_produto){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();

            try{

                $consulta = $pdo->prepare("SELECT * FROM db_mercado.tab_aval_produto where id_produto = :id_produto");
                $consulta->bindValue("id_produto", $Id_produto);
                $consulta ->execute();

                $lista = array();

                $i=0;

                $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);

                while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                    $aval = new AvaliacaoProduto();

                    $aval->setId_produto($linha['id_produto']);
                    $aval->setNome($linha['nome']);
                    $aval->setEmail($linha['email']);
                    $aval->setTexto($linha['texto']);
                    $aval->setdata($linha['data']);
                    
                    $lista[$i] = $aval;
           
                    $i++;
                    
                }

                return $lista;

                $conn->fechaConexao($conn);

               

            }catch(PDOException $e) {
                echo "Erro na conexão" . $e->getMessage();

            }
    }
}
?>