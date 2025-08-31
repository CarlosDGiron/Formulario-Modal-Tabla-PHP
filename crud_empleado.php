<?php
if (!empty($_POST)){
    include("db_conection_data.php");

    $id_empleado= utf8_decode($_POST["txt_id_empleado"]);
    $codigo= utf8_decode($_POST["txt_codigo"]);
    $nombres= utf8_decode($_POST["txt_nombres"]);
    $apellidos= utf8_decode($_POST["txt_apellidos"]);
    $direccion= utf8_decode($_POST["txt_direccion"]);
    $telefono= utf8_decode($_POST["txt_telefono"]);
    $fecha_nacimiento= utf8_decode($_POST["txt_fecha_nacimiento"]);
    $id_puesto= utf8_decode($_POST["drop_puesto"]);
    
    $db= mysqli_connect($db_host, $db_user, $db_password, $db_schema);
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }else {
        if(isset($_POST["btn_crear"])){         
            $query= "INSERT INTO db_empresa.empleados(codigo, nombres, apellidos, direccion, telefono, fecha_nacimiento, id_puesto) VALUES ('" . $codigo . "', '" . $nombres . "', '" . $apellidos . "', '". $direccion . "', " . $telefono . ", '" . $fecha_nacimiento . "', " . $id_puesto . ");";
        } elseif(isset($_POST["btn_modificar"])){
            $query= "UPDATE db_empresa.empleados  SET codigo='". $codigo ."', nombres='". $nombres ."', apellidos='". $apellidos ."', direccion='". $direccion ."', fecha_nacimiento='". $fecha_nacimiento ."', telefono=". $telefono .", id_puesto='". $id_puesto ."'  WHERE id_empleado=". $id_empleado ." ;";
        } elseif(isset($_POST["btn_eliminar"])){
            $query= "DELETE FROM db_empresa.empleados WHERE id_empleado=". $id_empleado ." ;";
        }
            if ($db ->query($query)===true){                
                $db -> close();
                error_log("Exito: ". $query);
            }else{
                error_log(("Error" . $db->error . "<br>" . $query));
                $db -> close();
            }
        }
    }    
        header('Location: /php_empresa');
?>