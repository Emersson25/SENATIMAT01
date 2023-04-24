<?php

require_once 'Conexion.php';

class Estudiante extends Conexion{

  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  //Datos[] es un array asociativo, que contiene la información
  //a guardar proveniente del controlador
  public function registrarEstudiante($datos = []){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_estudiantes_registrar(?,?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['apellidos'], 
          $datos['nombres'], 
          $datos['tipodocumento'],
          $datos['nrodocumento'],
          $datos['fechanacimiento'],
          $datos['idcarrera'],
          $datos['idsede'],
          $datos['fotografia']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function listarEstudiantes(){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_estudiantes_listar()");
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function obtenerEstudiante($idestudiante = 0) {
    try {
        // Obtener el colaborador de la base de datos
        $consulta = $this->accesoBD->prepare("CALL spu_obtener_fotografias()");
        $consulta->execute(array($idestudiante));
        $registro = $consulta->fetch();

        return $registro;
    } catch (Exception $e) {
        die($e->getMessage());
    }
  }

  public function eliminarEstudiante($idestudiante = 0) {
    try {
        // Borramos el registro de la base de datos
        $consulta = $this->accesoBD->prepare("CALL spu_estudiantes_eliminar(?)");
        $consulta->execute(array($idestudiante));
        return true;
    } catch (Exception $e) {
        die($e->getMessage());
    }
  }



}