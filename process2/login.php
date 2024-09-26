<?php 
   $nombre=MysqlQuery::RequestPost("nombre_login");
   $clave2=(MysqlQuery::RequestPost("contrasena_login"));
    $clave=md5($clave2);
    $radio=MysqlQuery::RequestPost('optionsRadios');
    if($nombre!="" && $clave!="" && $radio!=""){
        if($radio=="admin"){
            $sql=Mysql::consulta("SELECT * FROM admin_soporte WHERE email_admin= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_admin'];
                $_SESSION['id']=$reg['id'];
                $_SESSION['nombre_completo']=$reg['nombre'];
                $_SESSION['email']=$reg['email_admin'];
                $_SESSION['ubi']=$reg['ubicacion'];
                $_SESSION['clave']=$clave;
                $_SESSION['tipo']="admin";
				
            }else{
               echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRI UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        } 
		elseif($radio=="user"){
            $sql=Mysql::consulta("SELECT * FROM usuario_sop WHERE email_usuario= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['id']=$reg['id'];
                $_SESSION['nombre']=$reg['nombre_usuario'];
                $_SESSION['nombre_completo']=$reg['nombre_comp'];
                $_SESSION['email']=$reg['email_usuario'];
                $_SESSION['ar']=$reg['area'];
                $_SESSION['ubi']=$reg['ubicacion'];
				$_SESSION['tel']=$reg['telefono'];
                $_SESSION['clave']=$clave;
                //$_SESSION['id']=$reg['id_usuario'];
                $_SESSION['tipo']="user";
                $_SESSION['tipo_checador'] = $reg['tipo_chk'];
                
			header('Location: ./soporte.php?view=soporte');
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        }
		/////////////////////////////
		
		elseif($radio=="RH"){
            $sql=Mysql::consulta("SELECT * FROM usuario_rh WHERE email_usuario= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_usuario'];
                $_SESSION['id']=$reg['id'];
                $_SESSION['nombre_completo']=$reg['nombre_comp'];
                $_SESSION['email']=$reg['email_usuario'];
                $_SESSION['ar']=$reg['area'];
                $_SESSION['ubi']=$reg['ubicacion'];
				$_SESSION['tel']=$reg['telefono'];
                $_SESSION['clave']=$clave; 
                $_SESSION['tipo']="RH";
                $_SESSION['tipo_checador'] = $reg['tipo_chk'];
                
			header('Location: ./soporte.php?view=soporte');
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        }
        
		/////////////////////////////
		elseif($radio=="superoot"){
            $sql=Mysql::consulta("SELECT * FROM superoot WHERE email_root= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_root'];
                $_SESSION['id']=$reg['id'];
                $_SESSION['nombre_completo']=$reg['nombre'];
                $_SESSION['email']=$reg['email_root'];
                $_SESSION['ubi']=$reg['ubicacion'];
                $_SESSION['clave']=$clave;
                $_SESSION['tipo']="superoot";
				
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        }
		
		else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No has seleccionado un usuario valido
                    </p>
                </div>
            ';
        }	
		
    }else{
        echo '
            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                <p class="text-center">
                    No puedes dejar ningún campo vacío
                </p>
            </div>
        ';
    }
	