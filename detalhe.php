<?php
require_once "includes/header2.php";
?>

<a href="index.php"><button>Voltar</button></a>

<table>
  <th>CPF</th>
  <th>Data</th>
  <th>Codigo de Barra</th>
  <th>Produto</th>
  <th>Valor</th>
  <th>Unidade</th>
  <th>Status</th>
  <th></th>
  </tr>
  <?php
if (!empty($_GET["id"])) {
  $id = $_GET["id"];


  $cmd = "SELECT * FROM `pedido` WHERE id = '$id'";
  $idc = $pdo->query($cmd);



  while ($user_dado = mysqli_fetch_array($idc)) {
    echo "<tr>";
    echo "<td>" . $user_dado['cpfCliente'] . "</td>";
    echo "<td>" . $user_dado['dtPedido'] . "</td>";
    echo "<td>" . $user_dado['codBarras'] . "</td>";
    echo "<td>" . $user_dado['nomeProduto'] . "</td>";
    echo "<td>$ " . number_format($user_dado['valorUnitario'], 2, ',', ' ') . "</td>";
    echo "<td>" . $user_dado['quantidadePedido'] . "</td>";
    echo "<td>" . $user_dado['statusCliente'] . "</td>";
    echo "<td><a id='editar' href='editar-detalhe.php?id=" . $user_dado['id'] . "'><button>Editar</button></a>
        <a id='editar'href='excluir.php?id=" . $user_dado['id'] . "'><button>Excluir</button></a>";
    echo "</td>";
    echo "</tr> ";
  }
}
  ?>

</table>
<?php

include 'includes/footer.php';
