<?php

require_once 'Conexion.php';

class Cargo extends Conexion{

  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  public function listarCargos(){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_cargos_listar();");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

}