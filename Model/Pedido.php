<?php 
    class Pedido {
        private $id;
        private $cliente;
        private $itensPedido = array();
        private $avaliacaoCliente;
        private $status;
        private $data;
        private $rastreio;

        public function getId(){
            return $this->id;
        }
        
        public function setData($data){
            $this->data = $data;
        }

        public function getRastreio(){
            return $this->rastreio;
        }

        public function setRastreio($rastreio){
            $this->rastreio = $rastreio;
        }


        public function getData(){
            return $this->data;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getStatus(){
            return $this->status;
        }
    
        public function setStatus($status){
            $this->status = $status;
        }
    
        public function getCliente(){
            return $this->cliente;
        }
    
        public function setCliente($cliente){
            $this->cliente = $cliente;
        }
    
        public function getItensPedido(){
            return $this->itensPedido;
        }
    
        public function setItensPedido($itensPedido){
            $this->itensPedido = $itensPedido;
        }
    
        public function getAvaliacaoCliente(){
            return $this->avaliacaoCliente;
        }
    
        public function setAvaliacaoCliente($avaliacaoCliente){
            $this->avaliacaoCliente = $avaliacaoCliente;
        }
    }

?>