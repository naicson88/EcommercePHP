<?php
require "Model/Usuario.php";
require "Model/UsuarioService.php";
class UsuarioController {
   protected $usuario;

   public function __construct(){
      $this->usuario = new Usuario();
  }
   
   public function novoUsuario(Usuario $usu){
      //receber os dados do formulario e setar o objeto
      $this->usuario = $usu;
     
      $service = new UsuarioService();
      $service->cadastraUsuario($this->usuario);
    
     echo "Usuario cadastrado com sucesso";
      //header('Location:index.php', true,302);
   }

   public function consultarUsuario(Usuario $usu) {
      $this->usuario = $usu;

      $service = new UsuarioService();
      $encontrado = $service->consultaUsuario($this->usuario);

     /* if($encontrado == "" || $encontrado == null){
         echo "Operador não encontrado <br>";
     } else {
         echo "<p style='color:blue'> Operador encontrado com sucesso na pagina Controller! </p> <br>";
     }*/

     return $encontrado;

     
   }
}
   
   
?>