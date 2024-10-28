<?php

session_start();

if ($_SESSION['nombre']!="" && $_SESSION['tipo']=="RH") { ?>

    <img src="../../../img/spin_carga.gif" alt="Pantalla de carga" style="heigth: 100%; width: 100%;">

    <?php

    if (isset($_POST['Registrar'])) {

            require '../../config.php';

    

            $registra_permiso = $_SESSION['nombre_completo'];

            $registra_data = $_SESSION['nombre_completo'];

    

            $hora_permiso = $_POST['hora_permiso'];

            $fecha_permiso = $_POST['fecha_permiso'];

            $colaborador = $_POST['colaborador'];

    

            // Búsqueda de colaborador de acuerdo al número de empleado

            $q_collab = $con->prepare("SELECT * FROM empleados WHERE no_empleado = '$colaborador'");

            $q_collab->setFetchMode(PDO::FETCH_OBJ);

            $q_collab->execute();

    

            $show_collab = $q_collab->fetchAll();

    

            if ($q_collab -> rowCount() > 0) {

                foreach ($show_collab as $employee) {

                    $empleado = $employee -> nombre_colaborador;

                    $puesto = $employee -> puesto;

                    $departamento = $employee -> linea;

                    $area = $employee -> area;

                    $jefe_gerente = $employee -> gerente_jefe;

                    $sede = $employee -> sede;

                }

            } else {

                echo '<script>alert("Ocurrió un problema al cargar los datos del empleado, por favor, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';

                echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

            }



            $motivo_ausencia = $_POST['motivo_ausencia'];

    

            //Definición de GOCE DE SUELDO en base al tipo de MOTIVO DE AUSENCIA

            switch ($motivo_ausencia) {

                // Con goce de sueldo

                case 'Retardo Justificado':

                    $goce_sueldo = 'Si';

                break;

    

                case 'Paternidad':

                    $goce_sueldo = 'Si';

                break;

    

                case 'Personal: Trabajo desde casa':

                    $goce_sueldo = 'Si';

                break;

    

                case 'Vacaciones':

                    $goce_sueldo = 'Si';

                break;

    

                case 'Labor de campo':

                    $goce_sueldo = 'Si';

                break;

    

                //Sin goce de sueldo

                case 'Personal: Falta Injustificada':

                    $goce_sueldo = 'No';

                break;

    

                case 'Incapacidades: Enfermedad General':

                    $goce_sueldo = 'No';

                break;

    

                case 'Incapacidades: Riesgo de trabajo':

                    $goce_sueldo = 'No';

                break;

    

                case 'Incapacidades: Maternidad':

                    $goce_sueldo = 'No';

                break;

                case 'Incapacidades: Interna':
                    $goce_sueldo = 'Si';
                    break;

                

                default:

                $goce_sueldo = $_POST['goce_sueldo'];

                break;

            }

    

            $fecha_ausencia = $_POST['fecha_ausencia'];

            $dias_solicitados = $_POST['dias_solicitados'];

            $hora_salida = $_POST['hora_salida'];

            $hora_regreso = $_POST['hora_regreso'];

            $fecha_regreso = $_POST['fecha_regreso'];

            $observaciones_permiso = $_POST['observaciones_permiso'];

            $ip = $_SERVER['REMOTE_ADDR']; // Dirección IP de donde se registra el evento

            

            //Obtención de archivos

            $size_max = 8388608; // Definición de tamaño máximo (8 MB)

            $carpeta_save = '../../evidence_perm'; // Se define directorio donde se guarda la evidencia en el servidor

            $evidencia = $_FILES['evidencia_permiso']['name']; // Nombre del archivo a guardar

            $tipo_evidencia = $_FILES['evidencia_permiso']['type']; // Tipo de archivo

            $tamano_evidencia = $_FILES['evidencia_permiso']['size']; // Tamaño del archivo

            $temp_file = $_FILES['evidencia_permiso']['tmp_name']; // Asignación de memoria para procesamiento

            $nombre_save = $carpeta_save.'/'.$evidencia; // Nombre del archivo para guardar

            $evidencia_consulta = '../checador/evidence_perm/'.$evidencia;

    

            // Validar que se haya ingresado algún dato en la variable de evidencia

            if ($evidencia != NULL) {

                if ($tamano_evidencia <= $size_max) { // Valida que el tamaño del archivo sea el permitido

                    //Valida que el tipo de archivo sea el permitido

                   if ($tipo_evidencia == 'application/pdf' || $tipo_evidencia == 'image/png' || $tipo_evidencia == 'image/jpg' || $tipo_evidencia == 'image/jpeg') {

                        /************************************

                        ALMACENAMIENTO DE DATOS CON EVIDENCIA

                        ************************************/

                        move_uploaded_file($temp_file, $nombre_save);

                        $save_per_w_evidence = $con->prepare("INSERT INTO permisos

                        (hora_creacion, fecha_creacion, registra_permiso, nombre_colaborador,

                        no_empleado, puesto, linea, area,

                        sede, gerente_jefe, motivo_ausencia, goce_sueldo,

                        fecha_ausencia, dias_solicitados, hora_salida, hora_regreso,

                        fecha_regreso, observaciones, evidencia, ip_registro, registra_data)

                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

    

                        $val_save_per_w_evidence = $save_per_w_evidence->execute([$hora_permiso, $fecha_permiso, $registra_permiso, $empleado,

                        $colaborador, $puesto, $departamento, $area,

                        $sede, $jefe_gerente, $motivo_ausencia, $goce_sueldo,

                        $fecha_ausencia, $dias_solicitados, $hora_salida, $hora_regreso,

                        $fecha_regreso, $observaciones_permiso, $evidencia_consulta, $ip,

                        $registra_data]);

    

                        if ($val_save_per_w_evidence) {

                            echo '<script>alert("¡Se registró con éxito el permiso de ausentismo!")</script>';

                            echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

                        } else {

                            echo '<script>alert("Ocurrió un error al intentar guardar los datos, contacta con el Soporte Técnico")</script>';

                            echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

                        }

                    } else {

                        echo '<script>alert("Ocurrió un error al intentar guardar los datos, el archivo cargado no cumple con los formatos permitidos, inténtalo de nuevo por favor")</script>';

                        echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

                    }

                } else {

                    echo '<script>alert("Ocurrió un error al intentar guardar los datos, el archivo cargado supera el tamaño permitido, inténtalo de nuevo por favor")</script>';

                    echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

                }

            } else {

                /************************************

                ALMACENAMIENTO DE DATOS SIN EVIDENCIA

                ************************************/

                $save_permission = $con->prepare("INSERT INTO permisos 

                (hora_creacion, fecha_creacion, registra_permiso, nombre_colaborador,

                no_empleado, puesto, linea, area,

                sede, gerente_jefe, motivo_ausencia, goce_sueldo,

                fecha_ausencia, dias_solicitados, hora_salida, hora_regreso,

                fecha_regreso, observaciones, ip_registro, registra_data)

                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

    

                $val_save_permission = $save_permission->execute([$hora_permiso, $fecha_permiso, $registra_permiso, $empleado,

                $colaborador, $puesto, $departamento, $area,

                $sede, $jefe_gerente, $motivo_ausencia, $goce_sueldo,

                $fecha_ausencia, $dias_solicitados, $hora_salida, $hora_regreso,

                $fecha_regreso, $observaciones_permiso, $ip, $registra_data]);

    

                if ($val_save_permission) {

                echo '<script>alert("¡Se registró con éxito el permiso de ausentismo!")</script>';

                echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

                } else {

                echo '<script>alert("Ocurrió un error al intentar guardar los datos, contacta con el Soporte Técnico")</script>';

                echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

                }

            }

    

        } else {

            echo '<script>alert("Ocurrió un error al intentar guardar los datos, contacta con el Soporte Técnico")</script>';

            echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

        }

} else {

    echo '<script>alert("Ocurrió un error al intentar guardar los datos, contacta con el Soporte Técnico")</script>';

    echo '<meta http-equiv="refresh" content="0; url=../../../user/permisos_rh.php">';

}



?>