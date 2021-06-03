<?php 
    class Cliente {
        private $id;
        private $id_usuario;
        private $nome;
        private $rua;
        private $bairro;
        private $cep;

        public function getIdUsuario(){
            return $this->id_usuario;
        }
    
        public function setIdUsuario($id_usuario){
            $this->id = $id_usuario;
        }

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getNome(){
            return $this->nome;
        }
    
        public function setNome($nome){
            $this->nome = $nome;
        }
    
        public function getRua(){
            return $this->rua;
        }
    
        public function setRua($rua){
            $this->rua = $rua;
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
    }
?>