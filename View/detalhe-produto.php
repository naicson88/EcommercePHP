<?php 
      require "../Model/Produto.php";
      require "../Model/ProdutoService.php";
      require "../Model/Usuario.php";
      require "../Model/ItensPedido.php";
      
    session_start();
    if (isset($_GET['id'])) {
        $id_produto = intval($_GET['id']);
        $service = new ProdutoService();
        
      $produto =   $service->listarProdutoEspecifico($id_produto);

      $aval = $service->consultaAvaliacao($id_produto);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php   
        include("header.php");
    ?>


        <!-- Nav Bar End -->      
        
        <!-- Bottom Bar Start -->
      
        <!-- Bottom Bar End --> 
        
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Produto</a></li>
                    <li class="breadcrumb-item active">Detalhes</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Product Detail Start -->
        <div class="product-detail" style="margin-left: 20%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="product-detail-top">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="product-slider-single normal-slider">
                                    <img src="<?php echo  $produto->getImagem(); ?>" alt="Product Image">
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="product-content">
                                        <div class="title"><h2><?php echo $produto->getName(); ?></h2></div>
                                 
                                        <div class="price">
                                            <h4>Preço:</h4>
                                            <p>R$ <?php echo $produto->getvl_produto() ?></p>
                                        </div>
                                        <div class="quantity">
                                            <h4>Quantidade:</h4><br>
                                            <div class="qty">
                                                <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="1">
                                                <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="action">
                                            <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Add carrinho</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row product-detail-bottom">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills nav-justified">
                                   
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#reviews">Reviews </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                               
                                    <div id="reviews" class="container tab-pane fade">
                                        <div class="reviews-submitted">
                                        <?php for($i=0; $i < count($aval); $i++){ ?>
                                            <div class="reviewer"><?php echo $aval[$i]->getNome();?> - <span><?php echo (new DateTime($aval[$i]->getdata()))->format('d/m/Y '); ?></span></div>
                                       
                                            <p>
                                                <?php echo $aval[$i]->getTexto(); ?>
                                            </p>
                                        </div>
                                        <?php } ?>
                                        <div class="reviews-submit">
                                        <form  method="POST" action="../index.php?Acao=AvaliacaoProduto">
                                            <h4>Deixe sua opinião:</h4>
                                            
                                            <div class="row form">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Nome" name="nome">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="email" placeholder="Email" name="email">
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea placeholder="Review" name="texto"></textarea>
                                                </div>
                                                <input type="hidden" name="id_produto" value="<?php echo $produto->getId();?>">
                                                <div class="col-sm-12">
                                                    <button type="submit">Enviar</button>
                                                </div>
                                            </div>
                                        </form>
                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>

                </div>
            </div>
        </div>
        <!-- Product Detail End -->
        
        <!-- Footer Start -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Entre em contato</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>123 E Store, Salvador-BA</p>
                                <p><i class="fa fa-envelope"></i>email@examplo.com</p>
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
