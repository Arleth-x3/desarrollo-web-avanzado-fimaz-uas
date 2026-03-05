<?php

require_once "Usuario.php";

$usuario = new Usuario("Arleth", "arleth@gmail.com");

echo "Nombre: " . $usuario->getNombre() . "<br>";
echo "Correo: " . $usuario->getCorreo();

?>
