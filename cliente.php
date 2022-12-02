<?php
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

<body class="main-bg">
  <aside class="menu">
    <div class="main-content menu-content">
      <h1><a href="#home">HOME</a></h1>
      <nav>
        <ul>
          <li><a href="#intro">Meus pedidos</a></li>
          <li><a href="cadastroProduto.php">Cadastrar pedido</a></li>
          <li><a href="#gallery">Produtos</a></li>
  
        </ul>
      </nav>
    </div>
  </aside>

  <section id="intro" class="grid-one white-bg section">

    <div class="main-content">
      <h2>LISTA DE PEDIDOS</h2>
    </div>
    <div class="main-content ">
      <?php
      $sql = "SELECT * FROM pedido order by id";
      $res = $pdo->query($sql);
      ?>
      
      <table>
        <tr>
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

        $cmd = "select * from produto";
        $pedido = $pdo->query($cmd);

        $total = mysqli_num_rows($pedido);
        $registros = 4;
        $numPaginas = ceil($total / $registros);

        $inicio = ($registros * $pagina) - $registros;

        $cmd = "select * from produto where idCliente limit $inicio,$registros";
        $pedido = $pdo->query($cmd);
        $total = mysqli_num_rows($pedido);

        switch (@$sel) {
          case !isset($_GET['search']):
            $sel = $res;
            break;
          case isset($_GET['search']):
            $sel = $pedido;
            break;
        }

        while ($user_dado = mysqli_fetch_array($sel)) {
          echo "<tr>";
        
          echo "<td>" . $user_dado['dtPedido'] . "</td>";
          echo "<td>" . $user_dado['codBarras'] . "</td>";
          echo "<td>" . $user_dado['nomeProduto'] . "</td>";
          echo "<td>$ " . number_format($user_dado['valorUnitario'], 2, ',', ' ') . "</td>";
          echo "<td>" . $user_dado['quantidadePedido'] . "</td>";
          echo "<td>" . $user_dado['statusCliente'] . "</td>";
          echo "<td><a id='editar' href='editar.php?id=" . $user_dado['idProduto'] . "'><button id='azul'>Editar</button></a>
        <a id='editar'href='excluir.php?id=" . $user_dado['idProduto'] . "'><button id='vermelho'>Excluir</button></a>";
          echo "</td>";
          echo "</tr> ";
        }
     

        for ($i = 1; $i < $numPaginas + 1; $i++) {
          echo "<a href='cliente.php?pagina=$i'><button id='selecion'>" . $i . "</button></a> ";
        }
        ?>
        <?php


if (!empty($_GET['search'])) {
  $data = $_GET['search'];
  $sql = "SELECT * FROM pedido WHERE id LIKE '%$data%' or nomeProduto LIKE '%$data%' or emailCliente  LIKE '%$data%'or cpfCliente  LIKE '%$data%'or dtPedido  LIKE '%$data%' ORDER BY id DESC";
} else {
  $sql = "SELECT * FROM pedido ORDER BY id DESC";
}
$res = $pdo->query($sql);
?>
<div class="main-d"><input type="search" name="pesquisar" placeholder="Pesquisar" id="pesquisar"><button onclick="searchData()" id="pesquisar">pesquisar</button></div>
<script>
  var search = document.getElementById('pesquisar');
  search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
      searchData();
    }
  });

  function searchData() {
    window.location = 'cliente.php?search=' + search.value;
  }
</script>

      </table>
    </div>
  </section>
 




</body>

</html>