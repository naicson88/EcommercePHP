<?php 

    class Endereco {
        
        private $rua;
        private $numero;
        private $bairro;
        private $cep;
        private $cidade;

        public function getRua(){
            return $this->rua;
        }
    
        public function setRua($rua){
            $this->rua = $rua;
        }
    
        public function getNumero(){
            return $this->numero;
        }
    
        public function setNumero($numero){
            $this->numero = $numero;
        }
    
        public function getBairro(){
            return $this->bairro;
        }
    
        public function setBairro($bairro){
            $this->bairro = $bairro;
        }
    
        public function getCep(){
            return $this->cep;
        }
    
        public function setCep($cep){
            $this->cep = $cep;
        }
    
        public function getcidade(){
            return $this->cidade;
        }
    
        public function setcidade($cidade){
            $this->cidade = $cidade;
        }
    }
?>