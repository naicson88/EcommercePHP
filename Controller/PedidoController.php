<?php
require "Model/Pedido.php";
require "Model/PedidoService.php";

class PedidoController {
   protected $pedido;
   protected $usuario;

   public function __construct(){
      $this->pedido = new Pedido();
      
  }
   
   public function inserePedido($usu, $iped){
      //receber os dados do formulario e setar o objeto
      $service = new PedidoService();
      $id_pedido = $service->inserePedido($usu, $iped);
      var_dump($id_pedido);
      return $id_pedido;
     
      //header('Location:index.php', true,302);
   }

   public function realizarPagamento($id_pedido){
        $service = new PedidoService();
        $id_pedido = $service->realizarPagamento($id_pedido);
   }

  public function tramitar($id_pedido, $status){
   $service = new PedidoService();
   $id_pedido = $service->tramitar($id_pedido, $status);
  }

}
   
   
?>