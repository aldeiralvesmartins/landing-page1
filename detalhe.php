<?php
require_once 'includes/header.php';
require_once "config.php";


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Open+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/elementes.css">
  <link rel="stylesheet" href="assets/css/classes.css">
  <link rel="stylesheet" href="assets/css/variables.css">
  <link rel="stylesheet" href="assets/css/menu.css">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<a href="index.php"><button>Voltar</button></a>
<?php


$sql = "SELECT * FROM pedido ORDER BY id DESC";
$res = $pdo->query($sql);
?>

<table>
    <th>Cliente</th>
    <th>CPF</th>
    <th>Email</th>
    <th>Data</th>
    <th>Codigo de Barra</th>
    <th>Produto</th>
    <th>Valor</th>
    <th>Unidade</th>
    <th>Status</th>
    <th></th>
    </tr>
    <?php
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

    $cmd = "select * from pedido";
    $pedido = $pdo->query($cmd);

    $total = mysqli_num_rows($pedido);
    $registros = 5;
    $numPaginas = ceil($total / $registros);

    $inicio = ($registros * $pagina) - $registros;

    $cmd = "select * from pedido limit $inicio,$registros";
    $pedido = $pdo->query($cmd);
    $total = mysqli_num_rows($pedido);

    while ($user_dado = mysqli_fetch_array($pedido)) {
        echo "<tr>";
        echo "<td>" . $user_dado['nomeCliente'] . "</td>";
        echo "<td>" . $user_dado['cpfCliente'] . "</td>";
        echo "<td>" . $user_dado['emailCliente'] . "</td>";
        echo "<td>" . $user_dado['dtPedido'] . "</td>";
        echo "<td>" . $user_dado['codBarras'] . "</td>";
        echo "<td>" . $user_dado['nomeProduto'] . "</td>";
        echo "<td>$ " . number_format($user_dado['valorUnitario'], 2, ',', ' ') . "</td>";
        echo "<td>" . $user_dado['quantidadePedido'] . "</td>";
        echo "<td>" . $user_dado['statusCliente'] . "</td>";
        echo "<td><a id='editar' href='editar.php?id=" . $user_dado['id'] . "'><button>Editar</button></a>
        <a id='editar'href='excluir.php?id=" . $user_dado['id'] . "'><button>Excluir</button></a>";
        echo "</td>";
        echo "</tr> ";
    }
   
    ?>

</table>
<?php
 for ($i = 1; $i < $numPaginas + 1; $i++) {
        echo "<a href='detalhe.php?pagina=$i'><button id='selecion'>" . $i . "</button></a> ";
    }
include 'includes/footer.php';
