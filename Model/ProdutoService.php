<?php 

require "ProdutoDAO.php";
    class ProdutoService{

        function listarTodosProdutos(){
           
                $prodDAO = new ProdutoDAO();
                //$usu = new Usuario();
                $produtos=array();
                $produtos = $prodDAO->listarTodosProdutos();
                //echo $produtos[0]->getName();
                return $produtos;

        }

        public function listarProdutoEspecifico($id_produto){
            $prodDAO = new ProdutoDAO();
            //$usu = new Usuario();
            
            $produto = $prodDAO->listarProdutoEspecifico($id_produto);
            //echo $produtos[0]->getName();
            return $produto;
        }

       public function avaliacaoProduto($nome,$email,$texto,$id_produto){
        $prodDAO = new ProdutoDAO();
        
        $produto = $prodDAO->avaliacaoProduto($nome,$email,$texto,$id_produto);
        return $produto;
       }

       public function consultaAvaliacao($id_produto){
        $prodDAO = new ProdutoDAO();
        
        $aval = $prodDAO->consultaAvaliacao($id_produto);
        return $aval;
       }


    }
?>