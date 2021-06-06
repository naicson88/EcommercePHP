<?php 
    //require "../Model/Produto.php";
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

    ?>
        <!-- Fim Bottom-Bar -->       
        
        <!-- Início Main-Slider -->
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <nav class="navbar bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php"><i class="fa fa-home"></i>Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="maisVendidos.php"><i class="fas fa-heart"></i>Mais Vendidos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="novidade.php"><i class="fa fa-plus-square"></i>Novidades</a>
                                </li>
            
                                <li class="nav-item">
                                    <a class="nav-link" href="frutasVerduras.php"><i class="fas fa-apple-alt"></i>Frutas e Verduras</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="limpeza.php"><i class="fas fa-trash"></i>Limpeza</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="frios.php"><i class="fas fa-pizza-slice"></i>Frios e Lanches</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="bebidas.php"><i class="fas fa-wine-bottle"></i>Bebidas</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div  class="col-md-9" id="lista" style="margin-bottom: 120px;"> 
                        <p style="text-align: center; border:solid thin silver;margin-bottom: 10px; font-size: 50px; color: white;
                        background-image: linear-gradient(to right, #f0e7db, #f0d1b6, #f3b997, #f79e80, #fa8072);">                
                      Frutas e Verduras
                    </p>

                    <div class="con" style="margin-left: -20px;">

                        <?php for($i=0; $i < count($listaProdutos); $i++){
                            if($listaProdutos[$i]->getCategoria() == 'FRUTAS E VERDURAS') : ?>

                                <div class="col-md-3" style="margin-left: -10px;">
                                    <div class="product-item">
                                        <div class="product-title" style="width: 100%;">
                                            <a href="detalhe-produto.php?id=<?php echo $listaProdutos[$i]->getId();?>"><?php echo  $listaProdutos[$i]->getName(); ?> </a>
                                        
                                        </div>
                                        <div class="product-image">
                                            <a href="detalhe-produto.php?id=<?php echo $listaProdutos[$i]->getId();?>">
                                                <img src="<?php echo  $listaProdutos[$i]->getImagem(); ?>" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-price" style="width: 100%; ">
                                            <h5><span>R$ </span><?php echo  $listaProdutos[$i]->getvl_produto(); ?>
                                            <a class="btn" href="?adicionar&valor=<?php echo $listaProdutos[$i]->getvl_produto();?>&qtd=1&id=<?php echo $listaProdutos[$i]->getId();?>&nome=<?php echo $listaProdutos[$i]->getName();?>&imagem=<?php echo $listaProdutos[$i]->getImagem();?>" >
                                        
                                            <i class="fas fa-shopping-cart"></i></a></h5>
                                        
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
        <!-- Fim Main-Slider -->        
        
        <!-- Início Feature -->
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
        <!-- Fim Feature -->  
        
        <!-- Início Newsletter -->
        <div class="newsletter">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Se inscreva para receber as novidades</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="form">
                            <input type="email" value="Exemplo: compracerta@gmail.com">
                            <button>Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIm Newsletter -->             
        
        <!-- Início Footer -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Entre em contato</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i><a href="https://www.google.com.br/maps/@-17.6713916,-39.2599974,16.25z" target="_blank">123 E Store, Salvador-BA</a></p>
                                <p><i class="fa fa-envelope"></i><a href="mailto:compracerta@gmail.com.br">compracerta@gmail.com</a></p>
                                <p><i class="fa fa-phone"></i>(71) 9 9999-9999</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Siga-nos</h2>
                            <div class="contact-info">
                                <div class="social">
                                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Informações</h2>
                            <ul>
                                <li><a href="../info/sobrenos.html">Sobre Nós</a></li>
                                <li><a href="../info/politicaPrivacidade.html">Política de Privacidade</a></li>
                                <li><a href="../info/termosCondicoes.html">Termos e Condições</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Informação de Compra</h2>
                            <ul>
                                <li><a href="../info/politicaPagamento.html">Política de Pagamento</a></li>
                                <li><a href="../info/politicaEnvio.html">Política de envio</a></li>
                                <li><a href="../info/politicaDevolucao.html">Política de devolução</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row payment align-items-center">
                    <div class="col-md-6">
                        <div class="payment-method">
                            <h2>Formas pagamento:</h2>
                            <img src="../img/payment-method.png" alt="Payment Method" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-security">
                            <h2>Assegurado por:</h2>
                            <img src="../img/godaddy.svg" alt="Payment Security" />
                            <img src="../img/norton.svg" alt="Payment Security" />
                            <img src="../img/ssl.svg" alt="Payment Security" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Footer -->    
        
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
