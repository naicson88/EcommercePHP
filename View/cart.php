<?php 


require "../Model/ProdutoService.php";
require "../Model/Usuario.php";
require "../Model/ItemPedidoDAO.php";
require "../Model/ItensPedido.php";
//require "../Model/Produto.php";

?>
<!DOCTYPE html>
<html lang="en">

<?php 
    session_start();
        include("header.php");
    
        /*if(isset($_GET['excluir'])){
            $count = count( $_SESSION['carrinhoArray']);
            $id = intval($_GET['excluir']);

            foreach($_SESSION['carrinhoArray'] as $array ){
                $index = 0;
                $idAux = intval($array->getId());
                var_dump($idAux);
                var_dump($id);
                if($id === $idAux ){
                  unset($_SESSION['carrinhoArray'][1]);
                  break;
                }
                $index++;
                
            }
        } */

        if(isset($_GET['excluir'])){
            $id = intval($_GET['excluir']);

            if(isset($_SESSION['carrinhoArray'])){
               
                array_splice($_SESSION['carrinhoArray'],$id);
                $_SESSION['carrinhoArray'] = array_values($_SESSION['carrinhoArray']); 
              
    
             }
 
        } 

        if(isset($_SESSION['carrinhoArray'])){
              
            $valorCompra = 0.0;
            $carrinho = $_SESSION['carrinhoArray'];

            foreach($carrinho as $arr){
                $valorCompra += $arr->getvl_produto() * $arr->getQuantidade();
            }
        }

        if(isset($_GET['pedido'])){
            $idPedido = intval($_GET['pedido']);
            $dao = new ItemPedidoDAO();
            $itens = $dao->getItensDoPedido($idPedido);

            $_SESSION['carrinhoArray'] = $itens;

        }
   
        
    ?>
        <!-- Fim Breadcrumb -->
        
        <!-- Início Cart -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Produto</th>
                                            <th>Preço</th>
                                            <th>Quantidade</th>
                                            <th>Total</th>
                                            <th>Remover</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody class="align-middle">
                                   
                                    <?php for($i=0; $i < count($_SESSION['carrinhoArray']); $i++){ ?>
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="<?php echo $_SESSION['carrinhoArray'][$i]->getImagem();?>" alt="Image"></a>
                                                    <p><?php echo $_SESSION['carrinhoArray'][$i]->getName();?>  </p>
                                                </div>
                                            </td>
                                            <td>R$ <span class="precoUnitario"> <?php echo $_SESSION['carrinhoArray'][$i]->getvl_produto();?> </span>  </td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="<?php echo $_SESSION['carrinhoArray'][$i]->getQuantidade();?> ">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td>R$ <span class="precoTotalItem"> 
                                            <?php echo  number_format($_SESSION['carrinhoArray'][$i]->getQuantidade() * $_SESSION['carrinhoArray'][$i]->getvl_produto(),2,'.','');?> 
                                            </span>  </td>
                                            <td>
                                            <a href="?excluir=<?php echo $i?>"">
                                                <button ><i class="fa fa-trash"> 
                                             </i></button>
                                            </a>   
                                               </td>
                                         
                                        </tr>
                                        
                                    <?php } ?> 
                                   
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="coupon">
                                        <input type="text" placeholder="Cupom Desconto">
                                        <button>Aplicar Cupom</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Resumo do Carrinho</h1>
                                            <p>Sub Total <span id="valorSubtotal">R$ <?php  echo $valorCompra; ?> </span> </p>
                                            <p>Preço Frete<span>R$ <span id="precoFrete"> 25.00 </span> </span></p>
                                            <h2>Total Compra<span id="precoTotalCompra"> R$ 125.00</span></h2>
                                        </div>
                                        <div class="cart-btn">
                                            <a href="../index.php?Acao=RealizarPedido">
                                                <button type="button" class="btn btn-primary" >
                                                Confirmar Pedido</button>
                                            </a>
                                           

                                        </div>
                                        <!-- Modal Pagamento-->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" 
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informações do cartão</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form style="background-color: ghostwhite; padding: 20px; border-radius: 10px;">
                                                        <div class="form-row">
                                                          <div class="col-sm-8">
                                                            <label >Nome Titular</label>
                                                            <input type="text" class="form-control">
                                                          </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm-6">
                                                            <label >Numero Cartão</label>
                                                              <input type="texts" class="form-control" placeholder="**** **** **** ****"
                                                              maxlength="16"    >
                                                            </div>
                                                           
                                                            <div class="col-sm-2">
                                                                <label >Validade</label>
                                                                <input type="texts" class="form-control"  maxlength="16" placeholder="10/21">
                                                              
                                                            </div>
                                                          
                                                            <div class="col-sm-2">
                                                                <label >CVV</label>
                                                                <input type="password" class="form-control" maxlength="3"placeholder="123" >  
                                                            </div>
                                                          </div>

                                                          <div class="form-row">
                                                            <div class="col-sm-5">
                                                              <label >Quantidade Parcelas</label>
                                                              <select class="custom-select mr-sm-2" id="parcelas">
                                                                <option selected>1x   S/ JUROS</option>
                                                                <option value="1">3X  S/ JUROS</option>
                                                                <option value="2">6X  S/ JUROS</option>
                                                                <option value="3">9X  C/ JUROS</option>
                                                                <option value="3">12X C/ JUROS</option>
                                                              </select>
                                                            </div>

                                                            <div class="col-sm-7">
                                                                <label >Descrição na Fatura</label>
                                                                <input type="text" class="form-control" maxlength="16">  
                                                              </div>
                                                          </div>
                                                          
                                                      </form>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                                <button  type="button" class="btn btn-primary" 
                                                style="background-color:royalblue;color: white;">
                                                   <a href="sucesso.html" style="color: white;">Finalizar Compra</a> 
                                                </button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Cart -->
        
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Entre em contato</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i><a href="https://www.google.com.br/maps/@-17.6713916,-39.2599974,16.25z" target="_blank">123 E Store, Salvador-BA</a></p>
                                <p><i class="fa fa-envelope"></i><a href="mailto:compracerta@gmail.com.br">compracerta@gmail.com</a> </p>
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
        <!-- Footer End -->    
          
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- JavaScript Libraries -->
        <script>
           window.onload = calculaTotalCarrinho();
        </script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
