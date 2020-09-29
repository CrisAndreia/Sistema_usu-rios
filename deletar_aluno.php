<?php

include("Exercicio_9.php");

$id_usuario = $_GET['id_usuario'];

$link = mysqli_connect("localhost", "root", "", "sistema_login");


$query = "DELETE FROM USUARIOS WHERE id_usuario='$id_usuario'";
echo "DELETAR: $query<br><hr>";
mysqli_query($link, $query);
mysqli_close($link);

?>
