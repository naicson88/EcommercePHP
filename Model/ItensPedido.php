<?php 

    class ItensPedido extends Produto{
        private $id;
        private $cdItem;
        private $quantidade;
        private $produto;
        private $vl_produto;
        private $idPedido;
        private $nomeProduto;

        public function getId(){
            return $this->id;
        }
    
        public function setIdPedido($idPedido){
            $this->idPedido = $idPedido;
        }
        
        public function getIdPedido(){
            return $this->idPedido;
        }

        public function setNomeProduto($nomeProduto){
            $this->nomeProduto = $nomeProduto;
        }
        
        public function getNomeProduto(){
            return $this->nomeProduto;
        }

        public function setId($id){
            $this->id = $id;
        }
        
        public function getVl_produto(){
            return $this->vl_produto;
        }
    
        public function setVl_produto($vl_produto){
            $this->vl_produto = $vl_produto;
        }


        public function getCdItem(){
            return $this->cdItem;
        }
    
        public function setCdItem($cdItem){
            $this->cdItem = $cdItem;
        }
    
        public function getQuantidade(){
            return $this->quantidade;
        }
    
        public function setQuantidade($quantidade){
            $this->quantidade = $quantidade;
        }
    
        public function getProduto(){
            return $this->produto;
        }
    
        public function setProduto($produto){
            $this->produto = $produto;
        }
        
    }
?>