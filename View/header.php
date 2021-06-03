<?php

       

        if(isset( $_SESSION['UsuarioLogado'])){
            $userName =  $_SESSION['NomeUsuario']->getNomeUsuario() . " " . $_SESSION['NomeUsuario']->getSobrenome();
            $role =  $_SESSION['NomeUsuario']->getRole();
        } else {
            $userName =  "Fazer Login";
        }

        if(isset($_GET['adicionar'])){
           
            if(isset($_SESSION['Carrinho'])){   
              $valor = $_GET['valor'];
              $_SESSION['Carrinho'] += $valor;
              $carrinho = $_SESSION['Carrinho'];
            }

            

            if(isset($_SESSION['carrinhoArray'])){

                $produto = new Produto();

                $id = $_GET['id'];
                $produto->setId($_GET['id']);
                $produto->setImagem($_GET['imagem']);
                $produto->setName($_GET['nome']);
                $produto->setvl_produto($_GET['valor']);
                $produto->setQuantidade($_GET['qtd']);

                $count = count($_SESSION['carrinhoArray']);
               
                $isIgual = false;
                
                if($count > 0 ) {
                  
                    for($i = 0; $i < $count; $i++){
                        
                        $idAux = $_SESSION['carrinhoArray'][$i]->getId();
                       
                        if($id ===  $idAux ){
                            $isIgual = true;    
                            $qtd = $_SESSION['carrinhoArray'][$i]->getQuantidade();
                            $_SESSION['carrinhoArray'][$i]->setQuantidade($qtd + 1);
                            break;
                        }

                      
                    }
                } else {
                    array_push($_SESSION['carrinhoArray'], $produto);
                }

               if($isIgual == false && $count > 0){
                    array_push($_SESSION['carrinhoArray'], $produto);
                }
             

            }
        } else {
            $carrinho = "";
        }

        if(isset($_GET['deslogar'])){
            session_destroy();
            header("location:login.php");
        }
?>

<head>
        <meta charset="utf-8">
        <title>Compra certa </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- Favicon -->
        <link href="img/favicon_io/favicon-16x16.png" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
            #lista div {
                display: inline-block;
                margin: 5px;
               
            }

            #lista div img{
               max-height: 350px;
            
            }

            
        </style>
    </head>

    <body>
        <!-- Top bar Start -->
        <div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:suporte@email.com.br">suporte@email.com.br</a>
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-phone-alt"></i>
                        (71) 99999-9999
                    </div>
                </div>
            </div>
        </div>
        <!-- Top bar End -->
        
        <!-- Nav Bar Start -->
        <div class="nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                
                            <a href="cart.php" class="nav-item nav-link">Carrinho</a>
                            <a href="registro.php" class="nav-item nav-link">Registrar</a>
                         
                       
                        </div>
                        <div class="navbar-nav ml-auto">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> <?php echo $userName ?>  </a>
                                <div class="dropdown-menu">

                                    <?php if($userName == 'Fazer Login'): ?>
                                     <a href="login.php" class="dropdown-item">Login</a>
                                    <?php endif; ?>
                                    
                                    <?php if($userName != 'Fazer Login'): ?>
                                     <a href="?deslogar" class="dropdown-item">Logout</a>
                                    <?php endif; ?>
                                    
                                    <?php if($userName == 'Fazer Login'): ?>
                                        <a href="registro.php" class="dropdown-item">Registrar-se</a>
                                    <?php endif; ?>
                                    
                                    <?php if($userName != 'Fazer Login' && $role = "USUARIO"): ?>
                                        <a href="pedidos.php" class="dropdown-item">Meus pedidos</a>
                                    <?php endif; ?>
   
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->      
        
        <!-- Bottom Bar Start -->
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="index.php">
                                <img src="img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search">
                            <input type="text" placeholder="Procurar por nome">
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user">

                            <a href="cart.php" class="btn cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span> R$ <span id="cartPrice"> <?php if($carrinho > 0){echo number_format($carrinho,2,'.','') ;} ?> </span>  </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>