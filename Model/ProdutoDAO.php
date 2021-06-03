<?php 
    include "Conexao.php";

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
    }
?>