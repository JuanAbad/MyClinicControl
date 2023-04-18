<?php

if($_SERVER['REQUEST_METHOD']== 'POST'){
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  
  echo $nombre;
  echo $apellidos;
  
}
?>