<?php
    
    //include "Produto.php";
    //include "ItensPedido.php";
    include "Pedido.php";
    class ItemPedidoDAO {
        function insertItemPedido($id_pedido,  $produto){ 

            $conn = new Conexao();
            $pdo =  $conn -> conectar();

            for($i = 0; $i < count($produto); $i++){
               
                try{
                    $cd = $produto[$i]->getId();
                    $vl = $produto[$i]->getVl_produto();
                    $qtd = $produto[$i]->getQuantidade();

                    $insert = $pdo->prepare("insert into tab_item_pedido 
                    (cod_produto, valor_produto,id_pedido, quantidade) 
                    values (:cd_produto, :valor_produto, :id_pedido, :quantidade)");

                    $insert->bindParam("cd_produto",$cd);
                    $insert->bindParam("valor_produto", $vl);
                    $insert->bindParam("id_pedido", $id_pedido);
                    $insert->bindParam("quantidade", $qtd);
                    
                    $insert -> execute();
                    echo "Item inserido com sucesso! <br>";
    
                    $last_id = $pdo-> lastInsertId();
    
                    echo "Id ItemPedido: ", $last_id;
        
                    //$cliente->insertCliente($last_id);
        
                  

                } catch(PDOException $e) {
                    echo "Erro na conexão" .$e->getMessage();
                }
            }
            
            $conn->fechaConexao($conn);

          }
    
            function getItensDoPedido($id_pedido){
                $conn = new Conexao();
                $pdo =  $conn -> conectar();
                
                $consulta = $pdo->prepare("SELECT * FROM tab_item_pedido  INNER JOIN TAB_PRODUTO prod on prod.id = tab_item_pedido.cod_produto
                WHERE id_pedido = :id_pedido ");
                
                $consulta->bindValue("id_pedido", $id_pedido);
                
                $consulta ->execute();
    
                $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);

                $todosPedidos = array();
                $i = 0;
                while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

                    $iped = new ItensPedido();                   
                      
                     $iped->setId($linha['id']);
                     $iped->setCdItem($linha['cod_produto']);
                     $iped->setVl_produto($linha['valor_produto']);
                     $iped->setIdPedido($linha['id_pedido']);
                     $iped->setQuantidade($linha['quantidade']); 
                     $iped->setNomeProduto($linha['nome']); 
                     $iped->setvl_produto($linha['preco']);
                     $iped->setImagem($linha['imagem']);
                     $iped->setCategoria($linha['categoria']);
                         
                     
                     
                     $todosPedidos[$i] = $iped;
                     $i++;
                  
                  }

                  return $todosPedidos;
                
            }

              
         function consultarAvalicao($id_pedido){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
            
            $consulta = $pdo->prepare("SELECT * FROM TAB_PEDIDO WHERE id = :id");
            $consulta->bindValue("id", $id_pedido);
            $consulta ->execute();

            $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);
            
            $todosPedidos = array();

            $i = 0;
            $pedidoEncontrado = new Pedido();
            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

            
                    
               $pedidoEncontrado->setAvaliacaoCliente($linha['avaliacao_cliente']);
               $pedidoEncontrado->setComentario($linha['comentario_cliente']);

                $i++;
            }

            return $pedidoEncontrado;

            $conn->fechaConexao($conn);
        }
        }

      


?>