<?php 
    require "PedidoDAO.php";
    require "ItemPedidoDAO.php";

    
    class PedidoService {

        function inserePedido($cliente, $produtos) {
            if($cliente != null){
                $pedido = new PedidoDAO;
                $itemPedido = new ItemPedidoDAO();

                 $id_pedido  = $pedido->inserePedido($cliente);

                if($id_pedido > 0 && $id_pedido != null){
                    
                    $itemPedido->insertItemPedido($id_pedido, $produtos);
                }
                var_dump($id_pedido);
                return $id_pedido;

            }
        }

        function consultarPedidosUsuario($id_usuario){

            $pedidosDao = new PedidoDAO();
            $pedidos = $pedidosDao->consultarPedidosUsuario($id_usuario);

            return $pedidos;

            
        }

        function consultarTodosOsPedidosSeparacao(){
            $pedidosDao = new PedidoDAO();
            $pedidos = $pedidosDao->consultarTodosOsPedidosSeparacao();

            return $pedidos;
        }

        public function consultarTodosOsPedidosEntrega(){
            $pedidosDao = new PedidoDAO();
            $pedidos = $pedidosDao->consultarTodosOsPedidosEntrega();

            return $pedidos;
        }



        public function tramitar($id_pedido, $status){
            $pedidosDao = new PedidoDAO();
            $pedidos = $pedidosDao->tramitar($id_pedido, $status);
        }

        public function realizarPagamento($id_pedido){
            $pedidosDao = new PedidoDAO();
            $pedidosDao->realizarPagamento($id_pedido);
        }

        public function avaliacaoPedido($id_pedido, $nota, $texto){

        $pedidosDao = new PedidoDAO();
        $pedidosDao->avaliacaoPedido($id_pedido, $nota, $texto);
        }

        public function consultarTodosOsPedidos(){
            $pedidosDao = new PedidoDAO();
             $pedidos = $pedidosDao->consultarTodosOsPedidos();

             return $pedidos;
        }

    }
    
?>