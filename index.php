<!doctype html>
<html lang="en">

<head>
    <title>Inicio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <h1 style="text-align:center;">Formulario Empleados</h1>
    <div>
        <div class="container">
            <div class="row">
                <div class="col">
                <!-- Button trigger modal -->
                <button
                    type="button"
                    class="btn btn-primary btn-lg"
                    data-bs-toggle="modal"
                    data-bs-target="#modalId"
                >
                    Nuevo
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-primary align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Codigo de Empleado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Puesto</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="tbl_empleados">
                    <?php
                    include("db_conection_data.php");
                    $db_conection = mysqli_connect($db_host, $db_user, $db_password, $db_schema);
                    $db_conection->real_query("select id_puesto, puesto from puestos;");
                    $puestos = [];
                    $result = $db_conection->use_result();
                    while ($row = $result->fetch_assoc()) {
                        $puestos[$row['id_puesto']] = $row['puesto'];
                    }
                    $db_conection->real_query("select id_empleado, codigo, nombres, apellidos, direccion, telefono, fecha_nacimiento,id_puesto from empleados;");
                    $result = $db_conection->use_result();
                    while ($row = $result->fetch_assoc()) {
                        echo ("<tr data-id=".$row['id_empleado']." data-idp=".$row['id_puesto'].">");
                        echo "<td>" . $row['codigo'] . "</td>";
                        echo "<td>" . $row['nombres'] . "</td>";
                        echo "<td>" . $row['apellidos'] . "</td>";
                        echo "<td>" . $row['direccion'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                        echo "<td>" . $row['fecha_nacimiento'] . "</td>";
                        echo "<td>" . $puestos[$row['id_puesto']] . "</td>";
                        echo ("</tr>");
                    }
                    $db_conection->close();
                    ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Formulario Empleados
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>                
                <form id="form" action="crud_empleado.php" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class=" col-1 mb-3">
                                    <label for="txt_id_empleado" class="form-label">ID</label>
                                    <input type="number" name="txt_id_empleado" id="txt_id_empleado" class="form-control"
                                        value="0" aria-describedby="helpId" readonly/>
                                </div>
                                <div class=" col-1 mb-3">
                                    <label for="txt_codigo" class="form-label">Código</label>
                                    <input type="text" name="txt_codigo" id="txt_codigo" class="form-control"
                                        placeholder="E###." aria-describedby="helpId" pattern="^E\d{3}$"  required/>
                                </div>
                                <div class=" col-5 mb-3">
                                    <label for="txt_nombres" class="form-label">Nombres</label>
                                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control"
                                        placeholder="Nombres..." aria-describedby="helpId"  required/>
                                </div>
                                <div class="col-5 mb-3">
                                    <label for="txt_apellidos" class="form-label">Apellidos</label>
                                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control"
                                        placeholder="Apellidos..." aria-describedby="helpId"  required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="txt_direccion" class="form-label">Dirección</label>
                                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control"
                                        placeholder="Calle/Avenida XX-XX, Zona X , Municipio, Departamente, Otros..." aria-describedby="helpId"  required/>
                                </div>
                                <div class="col-2 mb-3">
                                    <label for="txt_telefono" class="form-label">Teléfono</label>
                                    <input type="number" name="txt_telefono" id="txt_telefono" class="form-control"
                                        placeholder="########" aria-describedby="helpId"  required/>
                                </div>
                                <div class="col-2 mb-3">
                                    <label for="txt_fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" name="txt_fecha_nacimiento" id="txt_fecha_nacimiento"
                                        class="form-control" placeholder="dd/mm/yyyy" aria-describedby="helpId"  required/>
                                </div>
                                <div class="col-2 mb-3">
                                    <label for="drop_puesto" class="form-label">Puesto</label>
                                    <select class="form-select form-select-lg" name="drop_puesto" id="drop_puesto" required>
                                        <?php
                                        include("db_conection_data.php");
                                        $db_conection = mysqli_connect($db_host, $db_user, $db_password, $db_schema);
                                        $db_conection->real_query("select id_puesto, puesto from puestos;");
                                        $puestos = [];
                                        $result = $db_conection->use_result();
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='".$row['id_puesto']."'>".$row['puesto']."</option>";
                                            $puestos[$row['id_puesto']] = $row['puesto'];
                                        }
                                        $db_conection->close();
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <div class="row d-flex">
                            <div class="col-3 mb-3">
                                <input name="btn_limpiar" id="btn_limpiar" onclick="limpiar(); return false;" class="btn btn-secondary" type="button" value="Limpiar" />                        
                            </div>                    
                            <div class="col-3 mb-3">
                                <input name="btn_crear" id="btn_crear" class="btn btn-success" type="submit" value="Crear" />                        
                            </div>            
                            <div class="col-3 mb-3">
                                <input name="btn_modificar" id="btn_modificar" class="btn btn-primary" type="submit" value="Modificar" />                        
                            </div>            
                            <div class="col-3 mb-3">
                                <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" onclick="javascript:if(!confirm('¿Desea Eliminar?'))return false" value = "Eliminar">
                            </div>            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script>
        var modalId = document.getElementById('modalId');
    
        modalId.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                let button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                let recipient = button.getAttribute('data-bs-whatever');
    
            // Use above variables to manipulate the DOM
        });
    </script>
                
    <script type="text/javascript" >
        function limpiar(){
            $("#txt_id_empleado").val(0);
            $("#txt_codigo").val('');
            $("#txt_nombres").val('');
            $("#txt_apellidos").val('');
            $("#txt_direccion").val('');
            $("#txt_telefono").val('');
            $("#txt_fecha_nacimiento").val('');
            $("#drop_puesto").val(1);            
        };

        $('#tbl_empleados').on('click','tr td',function(evt){
            var target,id,idp,codigo,nombres,apellidos,direccion,telefono,nacimiento;
            target = $(event.target);
            id = target.parent().data('id');
            idp = target.parent().data('idp');
            codigo = target.parent("tr").find("td").eq(0).html();
            nombres = target.parent("tr").find("td").eq(1).html();
            apellidos =  target.parent("tr").find("td").eq(2).html();
            direccion = target.parent("tr").find("td").eq(3).html();
            telefono = target.parent("tr").find("td").eq(4).html();
            nacimiento  = target.parent("tr").find("td").eq(5).html();
            $("#txt_id_empleado").val(id);
            $("#txt_codigo").val(codigo);
            $("#txt_nombres").val(nombres);
            $("#txt_apellidos").val(apellidos);
            $("#txt_direccion").val(direccion);
            $("#txt_telefono").val(telefono);
            $("#txt_fecha_nacimiento").val(nacimiento);
            $("#drop_puesto").val(idp);
            var modal = new bootstrap.Modal(document.getElementById('modalId'));
            modal.show();
        });            
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>