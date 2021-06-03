<?php

	//testa a variável url que veio lá do htaccesss
	
	if (isset($_GET['Acao'])) //se estiver preenchida, pega o valor
	  {		
            $url =  strtoupper($_GET['Acao']);
    		switch ($url){
	    		case "CADASTRARUSUARIO":
					require "Controller/UsuarioController.php";
					
					$usuario = new Usuario();
					$usuario->setNomeUsuario($_POST['nome']);
					$usuario->setSobrenome($_POST['sobrenome']);
					$usuario->setEmail($_POST['email']);
					$usuario->setcidade($_POST['cidade']);
					$usuario->setCep($_POST['cep']);
					$usuario->setRua($_POST['rua']);
					$usuario->setBairro($_POST['bairro']);
					$usuario->setNumero($_POST['numero']);	
					$usuario->setPassword($_POST['password']);
					
				    $controlador = new UsuarioController();
					$controlador->novoUsuario($usuario);
				

					header('location:View/RegistradoSucesso.php');
					break;

				case "FAZERLOGIN":
					require "Controller/UsuarioController.php";

					$usuario = new Usuario();
					$usuario->setEmail($_POST['email']);
					$usuario->setPassword($_POST['password']);

					$controlador = new UsuarioController();
					$usuarioLogado = new Usuario();
					$usuarioLogado = $controlador->consultarUsuario($usuario);

					if($usuarioLogado != "" || $usuarioLogado != null) {
						session_start();
						$_SESSION['UsuarioLogado'] = true;
						$_SESSION['NomeUsuario'] = $usuarioLogado;
						$_SESSION['Carrinho'] += 0.0;

						$_SESSION['carrinhoArray'] = array();
						
						if($usuarioLogado->getRole() == "USUARIO"){
							header('location:View/index.php');
						} else {
							header('location:View/TodosPedidos.php');
						}
						
					} else {
						$_SESSION['UsuarioLogado'] = false;
						//$_SESSION['NaoEncontrado'] = "Email ou senha incorreto(s)";

						header('location:View/login.php?naoencontrado');
					}

					break;

				case "ADICIONARCARRINHO":
					$_SESSION['Carrinho'] = 5.96;
					echo  $_SESSION['Carrinho'];

					break;

				case "REALIZARPEDIDO":
					
					require "Controller/PedidoController.php";
					require "Model/Usuario.php";
					session_start();
					if(isset($_SESSION['UsuarioLogado'])){
					
						$controller = new PedidoController();
						$id_usuario = $_SESSION['NomeUsuario']->getId();
						
						if(isset($_SESSION['carrinhoArray'])){
							$produtos = $_SESSION['carrinhoArray'];
						}

						$id_pedido = $controller->inserePedido($id_usuario, $produtos);
						
						header("location:View/PedidoRealizado.php?pedido=$id_pedido&status=AGUARDANDO%20PAGAMENTO");

					}
					
					break;
				case "PAGARPEDIDO":
					require "Controller/PedidoController.php";
					session_start();
					$id_pedido = $_GET['pedido'];

					$controller = new PedidoController();
					$controller->realizarPagamento($id_pedido);
					header("location:View/sucesso.php");
					break;

				case "TRAMITAR":
					require "Controller/PedidoController.php";
					session_start();
					$id_pedido = intval($_GET['pedido']);
					$status = $_GET['status'];

					$controller = new PedidoController();
					$controller->tramitar($id_pedido, $status);

					header('location:View/TodosPedidos.php');

					break;
			/*	case "INCLUIRLIVRO":
					require "Controller/ControladorNovoLivro.php";    
					$controlador = new ControladorNovoLivro();
					$controlador->processaRequisicao();
					break;
			    case "LISTARLIVRO":
					require "Controller/ControladorLivroListar.php";
                    $controlador = new ControladorLivroListar();
                    $controlador->processaRequisicao();
					break;
				default:
				    require "Controller/ControladorLivroListar.php";
				    $controlador = new ControladorLivroListar();
				    $controlador->processaRequisicao();
				    break;*/
			  } 


			  }
			  else                     //senão, vai para uma página padrão, neste caso a home do site
                $url = '404.php';
?>
	