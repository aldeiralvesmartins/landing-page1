<?php
require_once "config.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
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
      <h1><a href="#intro">HOME</a></h1>
      <nav>
        <ul>
          <li><a href="#intro">Listagem de pedidos</a></li>
          <li><a href="#cadastrar">Cadastrar pedido</a></li>
          <li><a href="#gallery">Usuarios</a></li>
          <li><a href="#status-pedido">Status pedido</a></li>
          <li><a href="login.php">Login</a></li>

        </ul>
      </nav>
    </div>
  </aside>

  <section id="intro" class="grid-one white-bg section">

    <div class="main-content">
      <h2>LISTA DE PEDIDOS </h2>
    </div>
    <div class=" ">
      <div class="main-d"><input type="search" name="pesquisar" placeholder="Pesquisar" id="pesquisar"><button onclick="searchData()" id="pesquisar">pesquisar</button></div>

      <?php
      $sql = "SELECT * FROM pedido order by id";
      $res = $pdo->query($sql);



      if (!empty($_GET['search'])) {
        $data = $_GET['search'];
        $sql = "SELECT * FROM pedido WHERE id LIKE '%$data%' or nomeCliente LIKE '%$data%' or emailCliente  LIKE '%$data%'or cpfCliente  LIKE '%$data%'or dtPedido  LIKE '%$data%' or statusCliente  LIKE '%$data%' ORDER BY id DESC";
      } else {
        $sql = "SELECT * FROM pedido ORDER BY id DESC";
      }
      $res = $pdo->query($sql);
      ?>
      <script>
        var search = document.getElementById('pesquisar');
        search.addEventListener("keydown", function(event) {
          if (event.key === "Enter") {
            searchData();
          }
        });

        function searchData() {
          window.location = 'index.php?search=' + search.value;
        }
      </script>
      <table>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th>
            <select name="" id="">
              <option onclick="searchData()" value="Aberto">Aberto</option>
              <option onclick="searchData()" value="Pago">Pago</option>
              <option onclick="searchData()" value="Cancelado">Cancelado</option>
            </select>
          </th>
          <th></th>
        </tr>
        <tr>
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
        $registros = 10;
        $numPaginas = ceil($total / $registros);

        $inicio = ($registros * $pagina) - $registros;

        $cmd = "select * from pedido limit $inicio,$registros";
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
          echo "<td>" . $user_dado['nomeCliente'] . "</td>";
          echo "<td>" . $user_dado['cpfCliente'] . "</td>";
          echo "<td>" . $user_dado['emailCliente'] . "</td>";
          echo "<td>" . $user_dado['dtPedido'] . "</td>";
          echo "<td>" . $user_dado['codBarras'] . "</td>";
          echo "<td>" . $user_dado['nomeProduto'] . "</td>";
          echo "<td>$ " . number_format($user_dado['valorUnitario'], 2, ',', ' ') . "</td>";
          echo "<td>" . $user_dado['quantidadePedido'] . "</td>";
          echo "<td>" . $user_dado['statusCliente'] . "</td>";
          echo "<td><a id='editar' href='editar.php?id=" . $user_dado['id'] . "'><button id='azul'>Editar</button></a>
        <a id='editar'href='excluir.php?id=" . $user_dado['id'] . "'><button id='vermelho'>Excluir</button></a>";
          echo "</td>";
          echo "</tr> ";
        }
        for ($i = 1; $i < $numPaginas + 1; $i++) {
          echo "<a href='index.php?pagina=$i'><button id='selecion'>" . $i . "</button></a> ";
        }
        ?>

      </table>
    </div>
  </section>
  <section id="grid-one" class="grid-one main-bg section">
    <div class="main-content grid-one-content">
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
        <section id="cadastrar" class="grid-one main-bg section">
          <div class="main-content grid-one-content">
            <div class="contact-form">
              <h2>Cadastro de Pedido</h2>
              <fieldset class="form-grid">

                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" placeholder=" " name="nomeCliente" v id="nomeCliente">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" placeholder="" name="emailCliente" id="email">
                </div>

                <div class="form-group">
                  <label>Data da compra</label>
                  <input type="date" name="dtPedido" id="dtPedido">
                </div>

                <div class="form-group">
                  <label>CPF</label>
                  <input type="text" placeholder="" name="cpfCliente" id="cpf">
                </div>

                <div class="form-group ">
                  <label>Codigo de barra</label>
                  <input type="text" placeholder="" name="codBarras" id="codBarras">
                </div>

                <div class="form-group">
                  <label>Nome do produto</label>
                  <input type="text" placeholder=" " name="nomeProduto" id="nomeProduto">
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
  <section id="gallery" class="grid-one white-bg section">
    <div class="main-content grid-one-content">
      <?php
      $sql = "SELECT * FROM `pedido`";
      $res = $pdo->query($sql);
      ?>
      <table>
        <h2>Usuarios</h2>
        <tr>
          <th>Cliente</th>
          <th>Email</th>
          <th></th>
        </tr>
        <?php

        while ($user_dado = mysqli_fetch_assoc($res)) {
          echo "<tr>";
          echo "<td>" . $user_dado['nomeCliente'] . "</td>";
          echo "<td>" . $user_dado['emailCliente'] . "</td>";
          echo "<td><a  href='detalhe.php?id=" . $user_dado['id'] . "'><button>Detalhes</button></a>";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>
  </section>
  <section id="status-pedido" class="white-bg section">
    <div class="main-content top3-content">


      <div class="responsive-table">
        <?php
        $cmd = "SELECT * FROM pedido WHERE statusCliente LIKE '%Aberto%'";
        $status = $pdo->query($cmd);

        $totalA = mysqli_num_rows($status);

        $cmd = "SELECT * FROM pedido WHERE statusCliente LIKE '%Pago%'";
        $status = $pdo->query($cmd);

        $totalP = mysqli_num_rows($status);

        $cmd = "SELECT * FROM pedido WHERE statusCliente LIKE '%Cancelado%'";
        $status = $pdo->query($cmd);

        $totalC = mysqli_num_rows($status);
        ?>
        <table>
          <h4>Status pedido</h4><br>
          <tr>
            <th>Total Aberto</th>
            <th>Total Pago</th>
            <th>Total Cancelado</th>
          </tr>
          <?php
          echo "<tr>";
          echo "<td>" . $totalA . "</td>";
          echo "<td>" . $totalP . "</td>";
          echo "<td>" . $totalC . "</td>";
          echo "</tr>";
          ?>
        </table>
        <br>
        <table>
          <h4>Total de ganho</h4><br>
          <tr>
            <th>Total Bruto</th>
            <th>Total Aberto</th>
            <th>Total Pago</th>
            <th>Total Cancelado</th>

          </tr>
          <?php
          $cmd = "SELECT sum(valorUnitario * quantidadePedido) FROM pedido WHERE statusCliente LIKE '%Aberto%'";
          $status = $pdo->query($cmd);
          $totalh = mysqli_fetch_assoc($status);
          $totalAberto = array_sum($totalh);

          $cmd = "SELECT sum(valorUnitario * quantidadePedido) FROM pedido";
          $status = $pdo->query($cmd);
          $totalh = mysqli_fetch_assoc($status);
          $totalBruto = array_sum($totalh);

          $cmd = "SELECT sum(valorUnitario * quantidadePedido) FROM pedido WHERE statusCliente LIKE '%Pago%'";
          $status = $pdo->query($cmd);
          $totalh = mysqli_fetch_assoc($status);
          $totalPago = array_sum($totalh);

          $cmd = "SELECT sum(valorUnitario * quantidadePedido) FROM pedido WHERE statusCliente LIKE '%Cancelado%'";
          $status = $pdo->query($cmd);
          $totalh = mysqli_fetch_assoc($status);
          $totalCancelado = array_sum($totalh);

          echo "<tr>";
          echo "<td>$ " . number_format($totalBruto, 2, ',', ' ,') . "</td>";
          echo "<td>$ " . number_format($totalAberto, 2, ',', ', ') . "</td>";
          echo "<td>$ " . number_format($totalPago, 2, ',', ', ') . "</td>";
          echo "<td>$ " . number_format($totalCancelado, 2, ',', ', ') . "</td>";
          echo "</tr>";


          ?>
        </table>

      </div>

    </div>
  </section>



</body>

</html>