<?php 

    class AvaliacaoProduto {
        
        private $id_produto;
        private $nome;
        private $email;
        private $texto;
        private $data;

        public function getId_produto(){
            return $this->id_produto;
        }
    
        public function setId_produto($id_produto){
            $this->id_produto = $id_produto;
        }
    
        public function getNome(){
            return $this->nome;
        }
    
        public function setNome($nome){
            $this->nome = $nome;
        }
    
        public function getEmail(){
            return $this->email;
        }
    
        public function setEmail($email){
            $this->email = $email;
        }
    
        public function getTexto(){
            return $this->texto;
        }
    
        public function setTexto($texto){
            $this->texto = $texto;
        }
    
        public function getdata(){
            return $this->data;
        }
    
        public function setdata($data){
            $this->data = $data;
        }
    }
?>