<?php 
    require "Model/UsuarioDAO.php";
    class UsuarioService {

        function cadastraUsuario(Usuario $usuario){
            if($usuario != null) {
                $usuDAO = new UsuarioDAO();
                //$usu = new Usuario();
                $usuDAO->insertUsuario($usuario);

            }else {
                throw new Exception ("Não foi possível cadastrar o usuário");
            }
        }

        function consultaUsuario(Usuario $usuario) {
            if($usuario != null){
                $usuDAO = new UsuarioDAO();

               $encontrado = $usuDAO->consultaUsuario($usuario);

               return $encontrado;
               
            } else {
                throw new Exception ("Não foi possível consultar o usuário");
            }
           
        }
    }
?>