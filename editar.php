<?php

require_once 'includes/header.php';
require_once "config.php";






if (!empty($_GET["id"])) {

  $id = $_GET['id'];

  $sqlSelect = "SELECT * FROM pedido where id = '$id'";
  $res = $pdo->query($sqlSelect);

  while ($user_dado = mysqli_fetch_assoc($res)) {


    $nomeCliente = $user_dado['nomeCliente'];
    $cpf = $user_dado['cpfCliente'];
    $email = $user_dado['emailCliente'];
    $dtPedido = $user_dado['dtPedido'];
    $codBarras = $user_dado['codBarras'];
    $nomeProduto = $user_dado['nomeProduto'];
    $quantidade = $user_dado['valorUnitario'];
    $valorU = $user_dado['quantidadePedido'];
    $status = $user_dado['statusCliente'];
  }
}



?>

<h2>EDITAR PEDIDO</h2>
<a href="index.php"><button>Voltar</button></a>
<form method="POST"  class="form-group">

  <label >Nome</label><br>
  <input type="text" placeholder=" " name="nomeCliente" value="<?php echo $nomeCliente ?>" id="nomeCliente"><br><br>
  <label >Email</label>
<br>
  <input type="email" placeholder="" name="emailCliente" id="email" value="<?php echo $email ?>"><br><br>
  <label >CPF</label>
<br>
  <input type="text" placeholder="" name="cpfCliente" id="cpf" value="<?php echo $cpf ?>"><br><br>
  <label >Data da compra</label>
<br>
  <input type="date" name="dtPedido" id="dtPedido" value="<?php echo $dtPedido ?>"><br><br>
  <label >Codigo de barra</label>
<br>
  <input type="text" placeholder="" name="codBarras" id="codBarras" value="<?php echo  $codBarras ?>"><br><br>
  <label >Nome do produto</label>
<br>
  <input type="text" placeholder=" " name="nomeProduto" id="nomeProduto" value="<?php echo $nomeProduto ?>"><br><br>
  <label >Quantidade</label>
<br>
  <input type="text" placeholder=" " name="quantidadePedido" id="quantidade" value="<?php echo $quantidade ?>"><br><br>
  <label >Valor unitario</label>
<br><br>
  <input type="text" placeholder=" " name="valorUnitario" id="valorUnitario" value="<?php echo $valorU ?>"><br><br>
  <label >Status</label>
<br>
  <input type="radio" name="statusCliente" value="Aberto" <?php echo ($status == 'Aberto') ?  'checked' : '' ?>> Aberto

  <input class="" type="radio" name="statusCliente" value="Pago" <?php echo ($status == 'Pago') ? 'checked' : '' ?>> Pago

  <input type="radio" name="statusCliente" value="Cancelado" <?php echo $status  == 'Cancelado' ? 'checked' : '' ?>> Cancelado<br><br>

  <input type="hidden" name="id" value="id">

  <input type="submit" name="update" value="update">

</form>

<?php


if (isset($_POST["update"])) {
    
  $id = $_GET['id'];

 
  $nomeCliente = $_POST['nomeCliente'];
  $cpf = $_POST['cpfCliente'];
  $email = $_POST['emailCliente'];
  $dtPedido = $_POST['dtPedido'];
  $codBarras = $_POST['codBarras'];
  $nomeProduto = $_POST['nomeProduto'];
  $quantidade = $_POST['quantidadePedido'];
  $valorU = $_POST['valorUnitario'];
  $status = $_POST['statusCliente'];


  $sqlUpdate = "UPDATE pedido SET dtPedido ='$dtPedido',codBarras='$codBarras',nomeProduto='$nomeProduto',quantidadePedido='$quantidade',
  nomeCliente ='$nomeCliente',emailCliente ='$email',statusCliente ='$status',cpfCliente='$cpf',valorUnitario='$valorU' where id ='$id'";
  $res = $pdo->query($sqlUpdate);
header('location:index.php');
}




include 'includes/footer.php';
?>