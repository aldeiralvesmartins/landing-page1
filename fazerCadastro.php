<?php
include 'includes/header.php';
require_once "config.php";



if (isset($_POST["nomeCliente"])) {

  $nomeCliente = $_POST['nomeCliente'];
  $cpf = $_POST['cpfCliente'];
  $email = $_POST['emailCliente'];
  $dtPedido = $_POST['dtPedido'];
  $codBarras = $_POST['codBarras'];
  $nomeProduto = $_POST['nomeProduto'];
  $quantidade = $_POST['quantidadePedido'];
  $valorU = $_POST['valorUnitario'];
  $status = $_POST['statusCliente'];


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
      header('location:listar.php');
    }
  }
}

?>
<h2>CADASTRAR PEDIDO</h2>


<form method="POST" class="form-group">


  <input type="text" placeholder="Nome " name="nomeCliente" id="nomeCliente"><br><br>

  <input type="email" placeholder="Email" name="emailCliente" id="email"><br><br>

  <input type="text" placeholder="cpf" name="cpfCliente" id="cpf"><br><br>

  <input type="date" name="dtPedido" id="dtPedido"><br><br>

  <input type="text" placeholder="codigo de barra" name="codBarras" id="codBarras"><br><br>

  <input type="text" placeholder="Nome do produto " name="nomeProduto" id="nomeProduto"><br><br>

  <input type="text" placeholder="Quantidade " name="quantidadePedido" id="quantidade"><br><br>

  <input type="text" placeholder="Valor unitario " name="valorUnitario" id="valorUnitario"><br><br>

  <input type="radio" name="statusCliente" value="Aberto" checked> Aberto

  <input class="" type="radio" name="statusCliente" value="Pago"> Pago

  <input type="radio" name="statusCliente" value="Cancelado"> Cancelado<br><br>

  <input type="hidden" name="id" value="id">

  <input type="submit" value=" Cadastrar">



</form>

<?php
include 'includes/footer.php';
?>