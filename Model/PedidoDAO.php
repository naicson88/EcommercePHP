<?php 
   include_once "Conexao.php";
   // include "Produto.php";
   include_once("ItensPedido.php");
    class PedidoDAO {
        
         
        function inserePedido($cliente){
           
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
                
            /*  $insert = "insert INTO tab_usuario (user_name, password, cod_cliente, role)
              values ('Usuario Cliente 3', '123456', 3, 'CLIENTE')";*/
              try{
                  $insert = $pdo->prepare("insert into tab_pedido (cliente, avaliacao_cliente,status, data) 
                  values (:cliente, :avaliacao_cliente, :status, CURDATE())");
                  $insert->bindParam("cliente", $cliente);
                  $insert->bindValue("avaliacao_cliente", null);
                  $insert->bindValue("status", "AGUARDANDO PAGAMENTO");
                 // $insert->bindValue("data", "CURDATE()");
                  
                  $insert -> execute();
                  echo "Item inserido com sucesso! <br>";
  
                  $last_id = $pdo-> lastinsertId();
  
                 // echo "Id gerado: ", $last_id;

                  $conn->fechaConexao($conn);

                  return $last_id;
              } catch(PDOException $e) {
                  echo "Erro na conexão" .$e->getMessage();
              }
             
          }

          function consultarPedidosUsuario($id_usuario) {
            
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
            
            $consulta = $pdo->prepare("SELECT * FROM TAB_PEDIDO WHERE cliente = :cliente");
            
            $consulta->bindValue("cliente", $id_usuario);
            
            $consulta ->execute();

            $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);
            
            $todosPedidos = array();

            $i = 0;

            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

              $pedidoEncontrado = new Pedido();
              $iped = new ItemPedidoDAO(); 
              $itens = $iped->getItensDoPedido($linha['id']);
             
                
               $pedidoEncontrado->setId($linha['id']);
               $pedidoEncontrado->setCliente($linha['cliente']);
               $pedidoEncontrado->setAvaliacaoCliente($linha['avaliacao_cliente']);
               $pedidoEncontrado->setStatus($linha['status']);
               $pedidoEncontrado->setData($linha['data']);
               $pedidoEncontrado->setItensPedido($itens);
               $pedidoEncontrado->setRastreio($linha['rastreio']);

               $todosPedidos[$i] = $pedidoEncontrado;
                $i++;
            }

           
            return $todosPedidos;

            $conn->fechaConexao($conn);


          }

          public function consultarTodosOsPedidosSeparacao(){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
            
            $consulta = $pdo->prepare("SELECT * FROM TAB_PEDIDO WHERE STATUS IN ('PAGO','EM SEPARACAO')");
            
            $consulta ->execute();

            $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);
            
            $todosPedidos = array();

            $i = 0;

            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

              $pedidoEncontrado = new Pedido();
              $iped = new ItemPedidoDAO(); 
              $itens = $iped->getItensDoPedido($linha['id']);         
                
               $pedidoEncontrado->setId($linha['id']);
               $pedidoEncontrado->setCliente($linha['cliente']);
               $pedidoEncontrado->setAvaliacaoCliente($linha['avaliacao_cliente']);
               $pedidoEncontrado->setStatus($linha['status']);
               $pedidoEncontrado->setData($linha['data']);
               $pedidoEncontrado->setItensPedido($itens);

               $todosPedidos[$i] = $pedidoEncontrado;
                $i++;
            }

            return $todosPedidos;

            $conn->fechaConexao($conn);
          }

          
          public function consultarTodosOsPedidosEntrega(){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
            
            $consulta = $pdo->prepare("SELECT * FROM TAB_PEDIDO WHERE STATUS IN ('SETOR ENTREGA', 'ENVIADO')");
            
            $consulta ->execute();

            $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);
            
            $todosPedidos = array();

            $i = 0;

            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

              $pedidoEncontrado = new Pedido();
              $iped = new ItemPedidoDAO(); 
              $itens = $iped->getItensDoPedido($linha['id']);
             
                
               $pedidoEncontrado->setId($linha['id']);
               $pedidoEncontrado->setCliente($linha['cliente']);
               $pedidoEncontrado->setAvaliacaoCliente($linha['avaliacao_cliente']);
               $pedidoEncontrado->setStatus($linha['status']);
               $pedidoEncontrado->setData($linha['data']);
               $pedidoEncontrado->setItensPedido($itens);

               $todosPedidos[$i] = $pedidoEncontrado;
                $i++;
            }

            return $todosPedidos;

            $conn->fechaConexao($conn);
          }


          public function realizarPagamento($id_pedido) {
              
            $conn = new Conexao();
            $pdo =  $conn -> conectar();

            try{
                $update = $pdo->prepare("update tab_pedido set status = 'PAGO' where id =:id_pedido");
                //values (:cliente, :avaliacao_cliente, :status, CURDATE())");
             
                $update->bindValue("id_pedido", intval($id_pedido));
               // $insert->bindValue("data", "CURDATE()");
                
                $update -> execute();
                echo "Atualizado com sucesso! <br>";

                $conn->fechaConexao($conn);

             
            } catch(PDOException $e) {
                echo "Erro na conexão" .$e->getMessage();
            }
           
        }
           
        public function tramitar($id_pedido, $status){

            $conn = new Conexao();
            $pdo =  $conn -> conectar();
            $newStatus = "";

            switch($status){

                case "PAGO" : $newStatus = "EM SEPARAÇÃO";
                break;

                case "EM SEPARAÇÃO" : $newStatus = "SETOR ENTREGA";
                break;

                case "SETOR ENTREGA" : $newStatus = "ENVIADO";    
                break;

                case "ENVIADO" : $newStatus = "ENTREGUE";    
                break;

            }
            
            if($newStatus == "ENVIADO") {
                $this->insertRastreio($id_pedido);
            }

            try{
                $update = $pdo->prepare("update tab_pedido set status = :status where id = :id_pedido");
                //values (:cliente, :avaliacao_cliente, :status, CURDATE())");
             
                $update->bindValue("id_pedido", intval($id_pedido));
                $update->bindValue("status", $newStatus);

               // $insert->bindValue("data", "CURDATE()");
                
                $update -> execute();
                echo "Atualizado com sucesso! <br>";

                $conn->fechaConexao($conn);

             
            } catch(PDOException $e) {
                echo "Erro na conexão" .$e->getMessage();
            }
        }
        
        private function insertRastreio($id_pedido) {
            
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
            $rastreio = uniqid();
            var_dump($rastreio);

            try{
                $update = $pdo->prepare("update tab_pedido set rastreio = :rastreio where id = :id_pedido");
             
                $update->bindValue("id_pedido", intval($id_pedido));
                $update->bindValue("rastreio", $rastreio);

               // $insert->bindValue("data", "CURDATE()");
                
                $update -> execute();
                echo "Atualizado com sucesso! <br>";

                $conn->fechaConexao($conn);

             
            } catch(PDOException $e) {
                echo "Erro na conexão" .$e->getMessage();
            }
        }

        public function avaliacaoPedido($id_pedido, $nota, $texto){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
         

            try{
                $update = $pdo->prepare("update tab_pedido set avaliacao_cliente = :aval, comentario_cliente = :texto where id = :id_pedido");
             
                $update->bindValue("id_pedido", intval($id_pedido));
                $update->bindValue("aval", $nota);
                $update->bindValue("texto", $texto);

               // $insert->bindValue("data", "CURDATE()");
                
                $update -> execute();
                echo "Atualizado com sucesso! <br>";

                $conn->fechaConexao($conn);

             
            } catch(PDOException $e) {
                echo "Erro na conexão" .$e->getMessage();
            }
        }

        public function consultarTodosOsPedidos(){
            $conn = new Conexao();
            $pdo =  $conn -> conectar();
            
            $consulta = $pdo->prepare("SELECT * FROM TAB_PEDIDO");
            
            $consulta ->execute();

            $result = $consulta->setFetchMode(PDO::FETCH_ASSOC);
            
            $todosPedidos = array();

            $i = 0;

            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

              $pedidoEncontrado = new Pedido();
              $iped = new ItemPedidoDAO(); 
              $itens = $iped->getItensDoPedido($linha['id']);
             
                
               $pedidoEncontrado->setId($linha['id']);
               $pedidoEncontrado->setCliente($linha['cliente']);
               $pedidoEncontrado->setAvaliacaoCliente($linha['avaliacao_cliente']);
               $pedidoEncontrado->setStatus($linha['status']);
               $pedidoEncontrado->setData($linha['data']);
               $pedidoEncontrado->setItensPedido($itens);

               $todosPedidos[$i] = $pedidoEncontrado;
                $i++;
            }

            return $todosPedidos;

            $conn->fechaConexao($conn);
        }
  
    }

?>