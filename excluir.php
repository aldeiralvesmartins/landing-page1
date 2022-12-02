<?php
require_once "config.php";



if (!empty($_GET["id"])) {

    $id = $_GET['id'];

    $sqlDelete = "DELETE FROM pedido where id = '$id'";
    $res = $pdo->query($sqlDelete);
    header('location:index.php');
}
