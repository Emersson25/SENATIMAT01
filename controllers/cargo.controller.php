<?php

require_once '../models/Cargo.php';

if (isset($_POST['operacion'])){

  $cargo = new Cargo();

  if ($_POST['operacion'] == 'listar'){
    $data = $cargo->listarCargos();
    
    //Enviar los datos a la vista
    //Si contiene información, si no está vacío...
    if ($data){
      echo "<option value='' selected>Seleccione</option>";
      foreach($data as $registro){
        echo "<option value='{$registro['idcargo']}'>{$registro['cargo']}</option>";
      }
    }else{
      echo "<option value=''>No encontramos nignun cargo</option>";
    }
  }

}