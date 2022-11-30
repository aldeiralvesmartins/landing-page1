<?php
require_once "includes/header.php";
require_once "config.php";


$sql = "SELECT * FROM pedido order by id desc";
$res = $pdo->query($sql);

?><BR></BR>
<h2>LISTA DE PEDIDOS</h2>
<BR><BR></BR></BR><BR></BR><BR></BR>
<?php
if (!empty($_GET['search'])) {
  $data = $_GET['search'];
  $sql = "SELECT * FROM pedido WHERE id LIKE '%$data%' or nomeCliente LIKE '%$data%' or emailCliente  LIKE '%$data%'or cpfCliente  LIKE '%$data%' ORDER BY id DESC";
} else {
  $sql = "SELECT * FROM pedido ORDER BY id DESC";
}
$res = $pdo->query($sql);
?>

<div id="div"><input type="search"  name="pesquisar" placeholder="Pesquisar" id="pesquisar"><button onclick="searchData()"id="pesquisar">pesquisar</button></div>



<a href="fazerCadastro.php"><button>Cadastrar pedido</button></a>
<table>
    <tr id="titulo">
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
    while ($user_dado = mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>" . $user_dado['nomeCliente'] . "</td>";
        echo "<td>" . $user_dado['cpfCliente'] . "</td>";
        echo "<td>" . $user_dado['emailCliente'] . "</td>";
        echo "<td>" . $user_dado['dtPedido'] . "</td>";
        echo "<td>" . $user_dado['codBarras'] . "</td>";
        echo "<td>" . $user_dado['nomeProduto'] . "</td>";
        echo "<td>$" . $user_dado['valorUnitario'] . "</td>";
        echo "<td>" . $user_dado['quantidadePedido'] . "</td>";
        echo "<td>" . $user_dado['statusCliente'] . "</td>";
        echo "<td><a id='editar' href='editar.php?id=" . $user_dado['id'] . "'><button>Editar</button></a>
        <a id='editar'href='excluir.php?id=" . $user_dado['id'] . "'><button>Excluir</button></a>";
        echo "</td>";
        echo "</tr>";
    }

    ?>


</table>


<script>
  var search = document.getElementById('pesquisar');
  search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
      searchData();
    }
  });

  function searchData() {
    window.location = 'listar.php?search='+search.value;
  }
</script>
<?php
require_once "includes/footer.php";
