<?php

require_once 'includes/header.php';
require_once "config.php";






if (!empty($_GET["id"])) {

  $id = $_GET['id'];

  $sqlSelect = "SELECT * FROM `produto` WHERE idCliente = '$id'";
  $res = $pdo->query($sqlSelect);

  while ($user_dado = mysqli_fetch_assoc($res)) {



    $cpf = $user_dado['cpfCliente'];
    $dtPedido = $user_dado['dtPedido'];
    $codBarras = $user_dado['codBarras'];
    $nomeProduto = $user_dado['nomeProduto'];
    $valorU = $user_dado['quantidadePedido'];
    $quantidade = $user_dado['valorUnitario'];
    $status = $user_dado['statusCliente'];
  }
}



?>

<h2>EDITAR PEDIDO</h2>
<a href="cliente.php"><button>Voltar</button></a>
<form method="POST" class="form-group">


  <label>CPF</label>
  <br>
  <input type="text" placeholder="" name="cpfCliente" id="cpf" value="<?php echo $cpf ?>"><br><br>
  <label>Data da compra</label>
  <br>
  <input type="date" name="dtPedido" id="dtPedido" value="<?php echo $dtPedido ?>"><br><br>
  <label>Codigo de barra</label>
  <br>
  <input type="text" placeholder="" name="codBarras" id="codBarras" value="<?php echo  $codBarras ?>"><br><br>
  <label>Nome do produto</label>
  <br>
  <input type="text" placeholder=" " name="quantidadePedido" id="quantidade" value="<?php echo $nomeProduto  ?>"><br><br>
  <label>Valor unitario</label>
  <br>
  <input type="text" placeholder=" " name="nomeProduto" id="nomeProduto" value="<?php echo $valorU ?>"><br><br>
  <label>Quantidade</label>
  <br>
  <input type="text" placeholder=" " name="valorUnitario" id="valorUnitario" value="<?php echo $quantidade ?>"><br><br>
  <label>Status</label>
  <br>
  <input type="radio" name="statusCliente" value="Aberto" <?php echo ($status == 'Aberto') ?  'checked' : '' ?>> Aberto

  <input class="" type="radio" name="statusCliente" value="Pago" <?php echo ($status == 'Pago') ? 'checked' : '' ?>> Pago

  <input type="radio" name="statusCliente" value="Cancelado" <?php echo $status  == 'Cancelado' ? 'checked' : '' ?>> Cancelado<br><br>

  <input type="hidden" name="id" value="id">

  <input type="submit" name="update" value="update">

</form>

<?php


if (isset($_POST["update"])) {

  $id1 = $_POST['idCliente'];



  $cpf = $_POST['cpfCliente'];
  $dtPedido = $_POST['dtPedido'];
  $codBarras = $_POST['codBarras'];
  $nomeProduto = $_POST['nomeProduto'];
  $quantidade = $_POST['quantidadePedido'];
  $valorU = $_POST['valorUnitario'];
  $status = $_POST['statusCliente'];

  if (
    !empty($cpf) && !empty($dtPedido)
    && !empty($codBarras) && !empty($nomeProduto) && !empty($quantidade) && !empty($valorU) && !empty($status)
  ) {
    $sqlUpdate = "UPDATE produto SET dtPedido ='$dtPedido',codBarras='$codBarras',nomeProduto='$nomeProduto',quantidadePedido='$quantidade',
  statusCliente ='$status',cpfCliente='$cpf',valorUnitario='$valorU' where idProduto ='$id1'";
    $res = $pdo->query($sqlUpdate);
    header('location:cliente.php');
  } else {
    echo 'preencha todos campos';
  }
}




include 'includes/footer.php';
?>