<?php 
      require "../Model/Produto.php";
      require "../Model/ProdutoService.php";
      require "../Model/Usuario.php";
      require "../Model/ItensPedido.php";
    session_start();
    $produto = new Produto();
    $produtoService = new ProdutoService();

    $listaProdutos = $produtoService->listarTodosProdutos();


?>
<!DOCTYPE html>
<html lang="pt-br">
    <?php 
        include("header.php");

      /*  if(isset($_GET['adicionar'])){
           
            if(isset($_SESSION['Carrinho'])){
                echo $_SESSION['Carrinho'] ;
               $valor = $_GET['valor'];
               echo $valor;
               $_SESSION['Carrinho'] +=  $valor;
                echo $_SESSION['Carrinho'] ;
            }
        }*/
           
         
    ?>

        <!-- Bottom Bar End -->       
        
        <!-- Main Slider Start -->
       <!----> <div class="header">
            <div class="container-fluid">
                <div class="row">
                            <div class="col-md-3">
                                <nav class="navbar bg-light">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="index.html"><i class="fa fa-home"></i>Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="navbar_category/maisVendidos.html"><i class="fa fa-shopping-bag"></i>Mais Vendidos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="navbar_category/novidade.html"><i class="fa fa-plus-square"></i>Novidades</a>
                                        </li>
                    
                                        <li class="nav-item">
                                            <a class="nav-link" href="navbar_category/frutasVerduras.html"><i class="fas fa-apple-alt"></i>Frutas e Verduras</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="navbar_category/limpeza.html"><i class="fas fa-trash"></i>Limpeza</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="navbar_category/frios.html"><i class="fas fa-pizza-slice"></i>Frios e Lanches</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="navbar_category/bebidas.html"><i class="fas fa-wine-bottle"></i>Bebidas</a>
                                        </li>
                                    </ul>
                                </nav>
                        </div>

                  <!-- Featured Product Start -->

                        <div class="featured-product product col-md-9" >
                        <div class="container-fluid" >
                        <div class="section-header border" 
                        style="background-image: linear-gradient(to right, #f0e7db, #f0d1b6, #f3b997, #f79e80, #fa8072);">
                            <h1>Mais Vendidos</h1>
                        </div>
                        <div class="row align-items-center product-slider product-slider-4">

                        <?php for($i=0; $i < count($listaProdutos); $i++){
                            if($listaProdutos[$i]->getCategoria() == 'MAIS VENDIDOS') : ?>

                                <div class="col-md-3" style="height: 25% !important;">
                                    <div class="product-item">
                                        <div class="product-title">
                                            <a href="detalhe-produto.html"><?php echo  $listaProdutos[$i]->getName(); ?> </a>
                                        
                                        </div>
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="<?php echo  $listaProdutos[$i]->getImagem(); ?>" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-price">
                                            <h3><span>R$ </span><?php echo  $listaProdutos[$i]->getvl_produto(); ?></h3>
                                            <a class="btn" href="?adicionar&valor=<?php echo $listaProdutos[$i]->getvl_produto();?>&qtd=1&id=<?php echo $listaProdutos[$i]->getId();?>&nome=<?php echo $listaProdutos[$i]->getName();?>&imagem=<?php echo $listaProdutos[$i]->getImagem();?>" >
                                           
                                            <i class="fa fa-shopping-cart"></i></a>
                                        
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>
                      <?php }?>

                        </div>
                        </div>
                        <!--Frutas e Verduras-->
                        <div class="container-fluid" style="margin-top:0">
                            <div class="section-header border"
                             style="background-image: linear-gradient(to right, #f0e7db, #eedcaf, #dfd484, #c3d05b, #9acd32);">
                                <h1 style="color: green  !important; ">Frutas e Verduras</h1>
                            </div>
                            <div class="row align-items-center product-slider product-slider-4">
                                
                                    
                        <?php for($i=0; $i < count($listaProdutos); $i++){
                            if($listaProdutos[$i]->getCategoria() == 'FRUTAS E VERDURAS') : ?>

                                <div class="col-md-3" style="height: 25% !important;">
                                    <div class="product-item">
                                        <div class="product-title">
                                            <a href="detalhe-produto.html"><?php echo  $listaProdutos[$i]->getName(); ?> </a>
                                        
                                        </div>
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="<?php echo  $listaProdutos[$i]->getImagem(); ?>" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-price">
                                            <h3><span>R$ </span><?php echo  $listaProdutos[$i]->getvl_produto(); ?></h3>
                                            <a class="btn" href="?adicionar&valor=<?php echo $listaProdutos[$i]->getvl_produto();?>&qtd=1&id=<?php echo $listaProdutos[$i]->getId();?>&nome=<?php echo $listaProdutos[$i]->getName();?>&imagem=<?php echo $listaProdutos[$i]->getImagem();?>" >
                                           
                                            <i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>
                      <?php }?>
                        
                            </div>
                        </div>
                           <!--Limpeza-->
                           <div class="container-fluid">
                            <div class="section-header border" 
                            style="background-image: linear-gradient(to right, #f0e7db, #d8d7bb, #b0cba6, #7ac0a0, #20b2aa);">
                                <h1 style="color:lightseagreen  !important;">Limpeza</h1>
                            </div>
                            <div class="row align-items-center product-slider product-slider-4">

                            <?php for($i=0; $i < count($listaProdutos); $i++){
                            if($listaProdutos[$i]->getCategoria() == 'LIMPEZA') : ?>

                                <div class="col-md-3" style="height: 25% !important;">
                                    <div class="product-item">
                                        <div class="product-title">
                                            <a href="detalhe-produto.html"><?php echo  $listaProdutos[$i]->getName(); ?> </a>
                                        
                                        </div>
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="<?php echo  $listaProdutos[$i]->getImagem(); ?>" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-price">
                                            <h3><span>R$ </span><?php echo  $listaProdutos[$i]->getvl_produto(); ?></h3>
                                            <a class="btn" href=""><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>
                      <?php }?>
                                

                            </div>
                        </div>
                               

                </div>
            </div>
        </div>
    </div>
    
        <div class="feature">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fab fa-cc-mastercard"></i>
                            <h2>Pagamento Seguro</h2>
                            <p>
                               Pagamento seguro via cartão de crédito
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-truck"></i>
                            <h2>Entrega Expressa</h2>
                            <p>
                               Receba sua compra no conforto da sua casa
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-sync-alt"></i>
                            <h2>90 dias para devolver</h2>
                            <p>
                                Caso insatisfeito, você tem até 90 dias para devolver
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-comments"></i>
                            <h2>Suporter 24h</h2>
                            <p>
                               Conte com nosso atendimento 24h por dia!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End-->  
        
        <!-- Newsletter Start -->
        <div class="newsletter">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Se inscreva e receba as novidades</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="form">
                            <input type="email" value="Seu email aqui">
                            <button>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter End -->             
        
        <!-- Footer Start -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Entre em contato</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>123 E Store, Salvador-BA</p>
                                <p><i class="fa fa-envelope"></i>email@example.com</p>
                                <p><i class="fa fa-phone"></i>71-99999-9999</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Siga-nos</h2>
                            <div class="contact-info">
                                <div class="social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Informações</h2>
                            <ul>
                                <li><a href="#">Sobre Nós</a></li>
                                <li><a href="#">Politica de Privacidade</a></li>
                                <li><a href="#">Termos e Condições</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Informação de Compra</h2>
                            <ul>
                                <li><a href="#">Politica de Pagamento</a></li>
                                <li><a href="#">Politica de envio</a></li>
                                <li><a href="#">Politica de devolução</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row payment align-items-center">
                    <div class="col-md-6">
                        <div class="payment-method">
                            <h2>Forma pagamento:</h2>
                            <img src="img/payment-method.png" alt="Payment Method" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-security">
                            <h2>Assegurado por:</h2>
                            <img src="img/godaddy.svg" alt="Payment Security" />
                            <img src="img/norton.svg" alt="Payment Security" />
                            <img src="img/ssl.svg" alt="Payment Security" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->    

        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!--  Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
