<?php 
    session_start();

    if(isset($_SESSION['UsuarioLogado'])){
        header("location: View/index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php 
        include("header.php");
           
         
    ?>
        <!-- Nav Bar End -->      
        
        <!-- Login Start -->
        <div class="login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8" >    
                        <form class="register-form" method="POST" name="Registro" action="../index.php?Acao=CadastrarUsuario" style="border: solid thin silver;">
                        <div>
                            <h1>Registro</h1>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nome</label>
                                    <input class="form-control" type="text"  required name="nome">
                                </div>
                                <div class="col-md-6">
                                    <label>Sobrenome</label>
                                    <input class="form-control" type="text" required name="sobrenome">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" required name="email">
                                </div>
                                <div class="col-md-6">
                                    <label>Cidade</label>
                                    <input class="form-control" type="text" required name="cidade">
                                </div>
                                <div class="col-md-4">
                                    <label>CEP</label>
                                    <input class="form-control" type="text"required name="cep">
                                </div>
                                <div class="col-md-4">
                                    <label>Rua</label>
                                    <input class="form-control" type="text"required name="rua">
                                </div>
                                <div class="col-md-4">
                                    <label>Bairro</label>
                                    <input class="form-control" type="text"  required name="bairro">
                                </div>
                                <div class="col-md-3">
                                    <label>Numero</label>
                                    <input class="form-control" type="text" required name="numero">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="password" required name="password" type="password"> 
                                </div>
                                <div class="col-md-12">
                                    <button class="btn" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
             
                </div>
            </div>
        </div>
        <!-- Login End -->
        
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
        
        <!-- Footer Bottom Start -->
 
        <!-- Footer Bottom End -->       
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
