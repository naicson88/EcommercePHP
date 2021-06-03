
<?php 

    class Produto {
        private $id;
        private $name;
        private $vl_produto;
        private $categoria;
        private $quantidade;
        private $imagem;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }

        public function getImagem(){
            return $this->imagem;
        }
    
        public function setImagem($imagem){
            $this->imagem = $imagem;
        }

        public function getQuantidade(){
            return $this->quantidade;
        }
    
        public function setQuantidade($quantidade){
            $this->quantidade = $quantidade;
        }

        public function getName(){
            return $this->name;
        }
    
        public function setName($name){
            $this->name = $name;
        }
    
        public function getvl_produto(){
            return $this->vl_produto;
        }
    
        public function setvl_produto($vl_produto){
            $this->vl_produto = $vl_produto;
        }
    
        public function getCategoria(){
            return $this->categoria;
        }
    
        public function setCategoria($categoria){ 
            $this->categoria = $categoria; 
        }
            
    } 

?>