<?php 
    require "../Model/Pedido.php";
    require "../Model/PedidoService.php";
    require "../Model/Usuario.php";
    

    session_start();

    if(isset($_SESSION['NomeUsuario'])){

        $id_usuario = intval($_SESSION['NomeUsuario']->getId());

        $pedido = new Pedido();
        $pedidoService = new PedidoService();
        $pedidos = $pedidoService->consultarPedidosUsuario($id_usuario);
    }
    

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
        <!-- Fim Nav Bar -->      
        
        <!-- Início Pedidos -->
        <div class="login">
            <div class="container-fluid" style="margin-bottom: 50px;">
                <div>
                    <h1>Pedidos</h1>
                </div>
                <div class="row" style="width: 85%; border: double silver;">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Numero</th>
                            <th scope="col">Itens</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Rastreio</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php for($i=0; $i < count($pedidos); $i++){
                                    $total = 0;
                                  foreach($pedidos[$i]->getItensPedido() as $itens){
                                    $total += $itens->getVl_produto();
                                  }
                            ?>
                          
                          <tr>
                         
                            <th scope="row"><?php echo (new DateTime($pedidos[$i]->getData()))->format('d/m/Y '); ?> </th>
                            
                            <td>
                                <a href="PedidoRealizado.php?pedido=<?php echo $pedidos[$i]->getId(); ?>&status=<?php echo $pedidos[$i]->getStatus(); ?>">
                                     <?php echo $pedidos[$i]->getId(); ?>
                                </a>  
                            </td>

                            <td>
                                <?php foreach($pedidos[$i]->getItensPedido() as $itens){
                                    $nome = $itens->getNomeProduto();
                                    echo $nome ."&nbsp;" .$itens->getQuantidade() ."x; &nbsp; ";
                                  } ?>
                            </td>
                            <td>R$ <?php echo number_format($total,2,'.','') ;?> </td>
                            <?php if($pedidos[$i]->getStatus() == "AGUARDANDO PAGAMENTO") :?>
                                 <td style="color:indigo ; font-weight: bold;"><?php echo $pedidos[$i]->getStatus(); ?></td>
                            <?php endif;?>

                            <?php if($pedidos[$i]->getStatus() == "PAGO") :?>
                                 <td style="color:olivedrab ; font-weight: bold;"><?php echo $pedidos[$i]->getStatus(); ?></td>
                            <?php endif;?>

                            <?php if($pedidos[$i]->getStatus() == "EM SEPARAÇÃO") :?>
                                 <td style="color:darkgoldenrod ; font-weight: bold;"><?php echo $pedidos[$i]->getStatus(); ?></td>
                            <?php endif;?>

                            <?php if($pedidos[$i]->getStatus() == "EM TRANSPORTE") :?>
                                 <td style="color:deepskyblue ; font-weight: bold;"><?php echo $pedidos[$i]->getStatus(); ?></td>
                            <?php endif;?>

                            <?php if($pedidos[$i]->getStatus() == "ENTREGUE") :?>
                                 <td style="color:green ; font-weight: bold;"><?php echo $pedidos[$i]->getStatus(); ?></td>
                            <?php endif;?>

                            <?php if($pedidos[$i]->getStatus() == "CANCELADO") :?>
                                 <td style="color:RED ; font-weight: bold;"><?php echo $pedidos[$i]->getStatus(); ?></td>
                            <?php endif;?>

                            
                            <?php if($pedidos[$i]->getStatus() == "SETOR ENTREGA") :?>
                                 <td style="color:cadetblue ; font-weight: bold;"><?php echo $pedidos[$i]->getStatus(); ?></td>
                            <?php endif;?>

                            <?php if($pedidos[$i]->getStatus() == "ENVIADO") :?>
                                 <td style="color:goldenrod; font-weight: bold;"><?php echo $pedidos[$i]->getStatus(); ?></td>
                            <?php endif;?>
                                
                            <td ><a href="#"><?php echo $pedidos[$i]->getRastreio(); ?> </a> </td>
                                
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
             
                </div>
            </div>
        </div>
        <!-- Fim Pedidos -->
        
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
                                <li><a href="info/sobrenos.html">Sobre Nós</a></li>
                                <li><a href="info/politicaPrivacidade.html">Politica de Privacidade</a></li>
                                <li><a href="info/termosCondicoes.html">Termos e Condições</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Informação de Compra</h2>
                            <ul>
                                <li><a href="info/politicaPagamento.html">Politica de Pagamento</a></li>
                                <li><a href="info/politicaEnvio.html">Politica de envio</a></li>
                                <li><a href="info/politicaDevolucao.html">Politica de devolução</a></li>
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
        <!-- Fim Footer -->       
        
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
