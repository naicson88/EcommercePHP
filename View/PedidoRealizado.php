<?php 


require "../Model/ProdutoService.php";
require "../Model/Usuario.php";
//require "../Model/ItemPedidoDAO.php";
require "../Model/ItensPedido.php";
require "../Model/PedidoService.php";


session_start();
$status = $_GET['status'];
$id_pedido = $_GET['pedido'];

if(isset($_SESSION['carrinhoArray'])){
    $valorCompra = 0.0;
    $carrinho = $_SESSION['carrinhoArray'];

    foreach($carrinho as $arr){
        $valorCompra += $arr->getvl_produto() * $arr->getQuantidade();
    }
}

if(isset($_SESSION['NomeUsuario'])){
    $dadosUsuario = $_SESSION['NomeUsuario'];
}

if(isset($_GET['pedido'])){
    $idPedido = intval($_GET['pedido']);
    $dao = new ItemPedidoDAO();
    $itens = $dao->getItensDoPedido($idPedido);

    $_SESSION['carrinhoArray'] = $itens;


    $aval = $dao->consultarAvalicao($id_pedido);


}


?>
<!DOCTYPE html>
<html lang="en">
<?php 
        include("header.php");

        if(isset($_GET['excluir'])){
            $count = count( $_SESSION['carrinhoArray']);
            $id = $_GET['excluir'];

            foreach($_SESSION['carrinhoArray'] as $array){
                $idAux = $array->getId();
                var_dump($array);
                if($id === $idAux ){
                  unset($array);
                }

                break;
            }
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
                            <div class="alert alert-warning" >
                               Pedido realizado com sucesso! Número: <b> <?php echo $id_pedido?> </b> - 
                               Status: <i style="color:blue"> <?php echo $status;?></i>
                                </div>
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
                                                    <p><?php echo $_SESSION['carrinhoArray'][$i]->getName();?></p>
                                                </div>
                                            </td>
                                            <td>R$ <span class="precoUnitario"> <?php echo $_SESSION['carrinhoArray'][$i]->getvl_produto();?> </span>  </td>
                                            <td>
                                                <div class="qty">
                                                 
                                                    <input type="text" value="<?php echo $_SESSION['carrinhoArray'][$i]->getQuantidade();?> ">
                                                  
                                                </div>
                                            </td>
                                            <td>R$ <span class="precoTotalItem">
                                            <?php echo $_SESSION['carrinhoArray'][$i]->getQuantidade() * $_SESSION['carrinhoArray'][$i]->getvl_produto();?> 
                                            </span>  </td>
                                            <td>
                                               
                                                <button onclick="removeProduto(this)"><i class="fa fa-trash"> 
                                             </i></button></td>
                                          
                                           
                                        </tr>
                                    <?php }?> 

                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        
                       
                        <div class="reviews-submitted" 
                        style="border: solid thin silver; padding:10px;background-color: white; border-radius: 10px; margin-bottom: 10px;">
                                      <h2 style="color:indianred;">Avaliação cliente</h2>
                                      <?php if($aval->getComentario() != null) :?>
                                            <div class="reviewer">Avaliação: <b>  <span><?php echo $aval->getAvaliacaoCliente()?></span></b></div>
                                            <br>
                                            <p>
                                             Comentário: <?php echo $aval->getComentario() ?>
                                            </p>
                                        </div>
                                        <?php elseif($aval->getComentario() == null) :?>
                                        
                                            <p>
                                             <i>Nenhuma avaliação feita</i>
                                            </p>
                                        </div>
                                        <?php endif; ?>
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
                                            <h1>Endereço de Entrega</h1>
                                            <p> <b>Cidade:</b> <span id="valorSubtotal"><?php  echo  $dadosUsuario->getcidade(); ?></span> </p>
                                            <p><b>CEP:</b> <span><?php  echo  $dadosUsuario->getCep(); ?> </span></p>
                                            <p> <b>Rua:</b> <span id="valorSubtotal"><?php  echo  $dadosUsuario->getRua(); ?></span> </p>
                                            <p><b>Bairro:</b> <span><?php  echo  $dadosUsuario->getBairro(); ?> </span></p>
                                            <p><b>Numero:</b> <span><?php  echo  $dadosUsuario->getNumero(); ?> </span></p>
                                            <h2>Total Compra<span id="precoTotalCompra"> R$ <?php echo  $valorCompra  ?></span></h2>
                                        </div>
                                        <div class="cart-btn">
                                                <?php if($status == "AGUARDANDO PAGAMENTO") : ?>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                Pagamento</button>
                                               <?php elseif($status!= "AGUARDANDO PAGAMENTO"): ?>
                                                <button type="button" class="btn btn-primary" disabled>
                                                Pago</button> <?php endif; ?>

                                                <?php if($status == "ENTREGUE" && $aval->getComentario() == null ) : ?>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aval">
                                                Avaliar Compra</button>
                                                <?php endif; ?>
                                            
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
                                                            <input type="text" class="form-control" required>
                                                          </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm-6">
                                                            <label >Numero Cartão</label>
                                                              <input type="texts" class="form-control" placeholder="**** **** **** ****"
                                                              maxlength="16"   required >
                                                            </div>
                                                           
                                                            <div class="col-sm-2">
                                                                <label >Validade</label>
                                                                <input type="texts" class="form-control"  maxlength="16" placeholder="10/21" required>
                                                              
                                                            </div>
                                                          
                                                            <div class="col-sm-2">
                                                                <label >CVV</label>
                                                                <input type="password" class="form-control" maxlength="3"placeholder="123" required>  
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
                                                   <a href="../index.php?Acao=PagarPedido&pedido=<?php echo $id_pedido?>" style="color: white;">Finalizar Compra</a> 
                                                </button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- avaliar compra-->
                                        <div class="modal fade" id="aval" tabindex="-1" 
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Avaliar Compra</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form style="background-color: ghostwhite; padding: 20px; border-radius: 10px;" method="POST" action="../index.php?Acao=AvaliacaoPedido">
                                                        <div class="form-row">
                                                          <div class="col-sm-8">
                                                            <label >Escolha uma nota</label>
                                                           <select name="nota" id="nota">
                                                                <option value="Pessimo">Pessimo</option>
                                                                <option value="Ruim">Ruim</option>
                                                                <option value="Regular">Regular</option>
                                                                <option value="Bom">Bom</option>
                                                                <option value="Excelente">Excelente</option>
                                                           </select>
                                                          </div>
                                                        </div>
                                                        <label >Descreva sua opinião:</label>
                                                          <div class="form-row">
                                                                <textarea name="texto" id="texto" cols="50" rows="6" required name="texto"></textarea>
                                                          </div>
                                                          <input type="hidden" name="id_pedido" value="<?php echo  $id_pedido; ?>">
                                                          <input type="hidden" name="status" value="<?php echo $status;?>">
                                                          <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                                        <button  type="submit" class="btn btn-primary"  style="background-color:royalblue;color: white;">  
                                                        Enviar
                                                  
                                                </button>
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
            function removeProduto(item) {
                
                $(item).closest("tr").remove();
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
