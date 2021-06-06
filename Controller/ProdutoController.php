<?php
require "Model/Produto.php";
require "Model/ProdutoService.php";

class ProdutoController {
 
 
   
   public function avaliacaoProduto($nome,$email,$texto,$id_produto){
      //receber os dados do formulario e setar o objeto
      $service = new ProdutoService();
      $id_pedido = $service->avaliacaoProduto($nome,$email,$texto,$id_produto);
      return $id_pedido;
     
      //header('Location:index.php', true,302);
   }


}
   
   
?>