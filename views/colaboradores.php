<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] == false){
  header('Location:../');
}

?>
<!doctype html>
<html lang="es">

<head>
  <title>Colaboradores</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- ÍCONOS FONTAWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
</head>
<body>
  <!-- Modal trigger button -->
  <button type="button" class="btn btn-primary  btn-lg mt-3 ms-3" data-bs-toggle="modal" data-bs-target="#modal-colaborador">
    Registro Colaboradores
  </button>
  <div class="container">
  <table class="table table-sm table-striped" id="tabla-colaboradores">
          <thead>
            <tr>
              <th>#</th>
              <th>Apellidos</th>
              <th>Nombres</th>
              <th>Cargo</th>
              <th>Sede</th>
              <th>Telefono</th>
              <th>Dirección</th>
              <th>Tipo contrato</th>
              <th>Operaciones</th>
            </tr>
          </thead>
       
          <tbody>

          </tbody>
        </table> 
      </div> 
  
  <!-- Modal Body -->
  <div class="modal fade" id="modal-colaborador" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modalTitleId">Colaboradores</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="formulario-colaboradores" autocomplete="off" enctype="multipart/form-data">
          <div class="row">

              <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label"><strong>Apellidos</strong></label>
                <input type="text" class="form-control form-control-sm" id="apellidos">
              </div>

              <div class="mb-3 col-md-6">
                <label for="nombres" class="form-label"><strong>Nombres</strong></label>
                <input type="text" class="form-control form-control-sm" id="nombres">
              </div>
            </div>
 
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="cargo" class="form-label"><strong>Cargo: </strong></label>
                <select id="cargo" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>

              <div class="mb-3 col-md-6">
                <label for="sede" class="form-label"><strong>Sede: </strong></label>
                <select id="sede" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="telefono" class="form-label"><strong>Teléfono</strong></label>
                <input type="text" class="form-control form-control-sm" id="telefono" inputmode="numeric" pattern="\d+">
              </div>

              <div class="mb-3 col-md-6">
                <label for="direccion" class="form-label"><strong>Dirección</strong></label>
                <input type="text" class="form-control form-control-sm" id="direccion">
              </div>
            </div>

            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="tipocontrato" class="form-label"><strong>Tipo Contrato: </strong></label>
                <select id="tipocontrato" class="form-select form-select-sm">
                  <option value="C">Completo</option>
                  <option value="P">Parcial</option>
                </select>
              </div>
              
              <div class="mb-3 col-md-6">
                <label for="cv" class="form-label"><strong>CV</strong></label>
                <input type="file" accept=".pdf" class="form-control form-control-sm" id="cv" name="cv">
              </div>
            </div>
          </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cerrar</button>
          <button type="button" class="btn btn-outline-success btn-sm" id="guardar-colaborador"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
  
  
  
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  <!-- jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
  <script>
    $(document).ready(function (){
      function obtenerCargos(){
    
        $.ajax({
          url : '../controllers/cargo.controller.php',
          type : 'POST',
          data : { operacion : 'listar'},
          dataType : 'text',
          success : function(result){
            $("#cargo").html(result);
          }
        });
      }
      function obtenerSedes(){
 
        $.ajax({
          url : '../controllers/sede.controller.php',
          type : 'POST',
          data : { operacion : 'listar'},
          dataType : 'text',
          success : function(result){
            $("#sede").html(result);
          }
        });
      }
      function mostrarColaboradores(){
        $.ajax({
          url: '../controllers/colaborador.controller.php',
          type: 'POST',
          data: { operacion : 'listar'},
          dataType: 'text',
          success: function(result){
            $("#tabla-colaboradores tbody").html(result);
          }
        });
      }
      mostrarColaboradores();
      function registrarColaborador(){
        var formData = new FormData();
        formData.append("operacion", "registrar");
        formData.append("apellidos", $("#apellidos").val());
        formData.append("nombres", $("#nombres").val());
        formData.append("idcargo", $("#cargo").val());
        formData.append("idsede", $("#sede").val());
        formData.append("telefono", $("#telefono").val());        
        formData.append("direccion", $("#direccion").val());
        formData.append("tipocontrato", $("#tipocontrato").val());
        formData.append("cv", $("#cv")[0].files[0]);
        $.ajax({
          url: '../controllers/colaborador.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function(){
            $("#formulario-colaboradores")[0].reset();
            $("#modal-colaborador").modal("hide");
            alert("Guardado correctamente");
            mostrarColaboradores();
          }
        });
      }
      function preguntarRegistro(){
        Swal.fire({
          icon: 'warning',
          title: 'Colaboradores',
          text: '¿Está seguro de registrar al colaborador?',
          footer: 'Desarrollado con PHP',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#66C744',
          showCancelButton: true,
          cancelButtonText: 'Cancelar',
          cancelButtonColor: '#EA4947'
        }).then((result) => {
          // Identificando la acción del usuario
          if (result.isConfirmed){
            //console.log("Guardando datos...");
            registrarColaborador();
          }
        });
      }
      $("#guardar-colaborador").click(preguntarRegistro);
      // Al pulsar sobre el botón rojo, se elimine el registro
      $("#tabla-colaboradores tbody").on("click", ".eliminar", function(){
        const idcolaboradorEliminar = $(this).data("idcolaborador");
        if (confirm("¿Está seguro de proceder?")){
          $.ajax({
            url: '../controllers/colaborador.controller.php',
            type: 'POST',
            data: {
              operacion : 'eliminar',
              idcolaborador: idcolaboradorEliminar
            },
            success: function(result){
              if(result == ""){
                mostrarColaboradores();
              }
            }
          });
        }
      });
      // Predeterminamos un control dentro del modal
      $("#modal-colaborador").on("shown.bs.modal", event =>{
        $("#apellidos").focus();
        obtenerCargos();
        obtenerSedes();
      });
    });
  </script>
</body>
</html>