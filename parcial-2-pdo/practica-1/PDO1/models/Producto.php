<?php
class Producto {
    private $id;
    private $existencia;
    private $nombre;
    private $precio;
    private $descripcion;
    public function __construct($id = null, $existencia = 0, $nombre = "", $precio = 0.00, $descripcion = ""){
        $this->id = $id;
        $this->existencia = $existencia;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
    }

    public function getid(){
        return $this->id;
    }

    public function getexistencia(){
        return $this->existencia;
    }

    public function getnombre(){
        return $this->nombre;
    }

    public function getprecio(){
        return $this->precio;
    }

    public function getdescripcion(){
        return $this->descripcion;
    }

    public function setid($id){
        $this->id = $id;
    }

    public function setexistencia($existencia){
        $this->existencia = $existencia;
    }

    public function setnombre($nombre){
        $this->nombre = $nombre;
    }

    public function setprecio($precio){
        $this->precio = $precio;
    }

    public function setdescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
}
?>