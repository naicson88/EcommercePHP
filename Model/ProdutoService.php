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

    }
?>