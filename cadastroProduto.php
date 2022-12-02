<?php
require_once "includes/header2.php";
?>
<button><a href="cliente.php">Voltar</a></button>
<section id="" class=" main-bg ">
    <div class="">
      <?php
      if (isset($_POST["nomeCliente"])) {

        $nomeCliente = $_POST['nomeCliente'];
        $cpf = $_POST['cpfCliente'];
        $email = $_POST['emailCliente'];
        $dtPedido = $_POST['dtPedido'];
        $codBarras = $_POST['codBarras'];
        $nomeProduto = $_POST['nomeProduto'];
        $quantidade = $_POST['quantidadePedido'];
        $valorU = $_POST['valorUnitario'];
        $status = @$_POST['statusCliente'];

        if (
          !empty($nomeCliente) && !empty($cpf) && !empty($email) && !empty($dtPedido)
          && !empty($codBarras) && !empty($nomeProduto) && !empty($quantidade) && !empty($valorU) && !empty($status)
        ) {

          $sql = "SELECT  id  FROM pedido  WHERE emailCliente ='$email' AND cpfCliente = '$cpf'";
          $res = $pdo->query($sql);
          if (mysqli_num_rows($res) > 0) {
            echo "pedido ja existe";
          } else {

            $sqlInsert = "INSERT INTO pedido (nomeCliente,cpfCliente,emailCliente,dtPedido,codBarras,nomeProduto,quantidadePedido,valorUnitario,statusCliente)
            VALUES ('$nomeCliente','$cpf','$email','$dtPedido','$codBarras','$nomeProduto','$quantidade','$valorU','$status')";
            $res = $pdo->query($sqlInsert);

            header('location:index.php');
          }
        }
      }
      ?>
      <form method="post">
        <section id="" met class=" main-bg section">
          <div class="main-content ">
            <div class="contact-form">
              <h2>Cadastro de Pedido</h2>
              <fieldset class="form-grid">
                <div class="form-group">
                  <label>Nome do produto</label>
                  <input type="text" placeholder=" " name="nomeProduto" id="nomeProduto">
                </div>

                <div class="form-group">
                  <label>Data da compra</label>
                  <input type="date" name="dtPedido" id="dtPedido">
                </div>

                <div class="form-group ">
                  <label>Codigo de barra</label>
                  <input type="text" placeholder="" name="codBarras" id="codBarras">
                </div>

                <div class="form-group">
                  <label>Quantidade</label>
                  <input type="text" placeholder=" " name="quantidadePedido" id="quantidade">
                </div>

                <div class="form-group">
                  <label>Valor unitario</label>
                  <input type="text" placeholder=" " name="valorUnitario" id="valorUnitario">
                </div><br><br>

                <div class="radio">
                  <input type="radio" name="statusCliente" value="Aberto"><br> Aberto
                  <input class="" type="radio" name="statusCliente" value="Pago"><br> Pago <br>
                  <input type="radio" name="statusCliente" value="Cancelado"><br> Cancelado
                </div><br><br>

                <input type="hidden" name="id" value="id">
                <div class="form-group full-width">
                  <button type="submit" value="Cadastrar">Cadastrar</button>
                </div>

              </fieldset>
            </div>
          </div>
      </form>
  </section>
  </div>
  </section>

  <?php
require_once "includes/footer.php";
  ?>