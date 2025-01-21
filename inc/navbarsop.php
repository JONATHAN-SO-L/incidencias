<?php
if(isset($_POST['nombre_login']) && isset($_POST['contrasena_login'])){
    include "./process2/login.php";
}
?>
<style>
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: -150%;
}

/* Estilo de barra de navegación Soporte */
.navbar-sop {
    background-color: #137098;
    border-color: #1fe61c;
}

/* Botones de barra de navegación */
a.navbar-brand {
    color: white;
}

.navbar{
    position: fixed;
}
</style>
<nav class="navbar navbar-sop navbar-fixed-top" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand" href="soporte.php"><i class="fa fa-laptop"></i>&nbsp;&nbsp;Soporte Devinsa</a>
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<?php if(isset($_SESSION['tipo']) && isset($_SESSION['nombre'])): ?>
    <ul class="nav navbar-nav navbar-rightii">
    <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <span class="glyphicon glyphicon-user"></span> &nbsp; <?php echo $_SESSION['nombre']; ?><b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
    <!-- usuarios -->
    <?php if($_SESSION['tipo']=="user"): ?>
        <li>
        <a href="soporte.php?view=ticket"><span class="glyphicon glyphicon-envelope"></span> &nbsp; Nuevo Ticket</a>
        </li>
        <li>
        <a href="./soporte.php?view=myticket"><span class="glyphicon glyphicon-envelope"></span> &nbsp; Mis Ticket</a>
        </li>
        <li>
        <a href="soporte.php?view=configuracion"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
        </li> 
        <li>
        <a href="./soporte.php?view=checador"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Checador</a>
        </li>
        <?php endif; ?>
        
        
        <!-- admins -->
        <?php if($_SESSION['tipo']=="admin"): ?>
            <li>
            <a href="admin.php?view=ticketadmin"><span class="glyphicon glyphicon-envelope"></span> &nbsp; Administrar Tickets</a>
            <!--a href="ticket_admin_view.php"><span class="glyphicon glyphicon-envelope"></span> &nbsp; Administrar Tickets</a-->
            </li>
            <li>
            <!--a href="ticketpre_view.php"><span class="glyphicon glyphicon-wrench"></span> &nbsp; Administrar Mantenimientos</a-->
            <a href="admin.php?view=ticketpre"><span class="glyphicon glyphicon-wrench"></span> &nbsp; Administrar Mantenimientos</a>
            </li>
            <li>
            <a href="admin.php?view=pass"><i class="fa fa-users"></i>&nbsp;&nbsp;Cambiar contraseña de Usuarios</a>
            </li>
            <li>
            <a href="admin.php?view=config"><i class="fa fa-cogs"></i> &nbsp; Configuracion</a>
            </li>
            <li>
            <a href="admin.php?view=equipo"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Equipos</a>
            <!--a href="admin.php?view=equipo"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Equipos</a-->
            </li>
            <li>
            <a href="./soporte.php?view=registro"><i class="fa fa-users"></i>&nbsp;&nbsp;Registrar Usuario</a>
            </li>
            <li>
            <a href="admin.php?view=preventivo"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Soporte Preventivo</a>
            <!--a href="preventivo_view.php"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Soporte Preventivo</a-->
            </li>
            <li>
            <a href="admin.php?view=users"><span class="fa fa-users"></span> &nbsp;Usuarios</a>
            </li>
            <!--li>
            <a href="admin.php?view=admin"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar Administradores</a>
            </li-->
            <li>
            <a href="admin.php?view=checador"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Checador</a>
            </li>
            <li>
            <a href="./user/permisos_lista.php"><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Listado de Permisos de Ausentismo</a>
            </li>
            <li>
            <a href="./user/permisos_rh.php"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Permisos</a>
            </li>
            <li>
            <a href="./checador/views/advanced_conf.php"><i class="fa fa-cog"></i>&nbsp;&nbsp;Configuracion Avanzada de Permisos</a>
            </li>
            <?php endif; ?>
            
            <!-- RH -->
            <?php if($_SESSION['tipo']=="RH"): ?>
                <li>
                <a href="soporte.php?view=confrh"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                </li> 
                <li>
                <a href="./soporte.php?view=checadas"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Checadas</a>
                </li>
                <li>
                    <a href="./user/permisos_lista.php"><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Listado de Permisos de Ausentismo</a>
                </li>
                <li>
                <a href="./user/permisos_rh.php"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Permisos</a>
                </li>
                <li>
                <a href="./checador/views/advanced_conf.php"><i class="fa fa-cog"></i>&nbsp;&nbsp;Configuracion Avanzada de Permisos</a>
                </li>
                <?php endif; ?>
                
                <!-- Root -->
                <?php if($_SESSION['tipo']=="superoot"): ?>
                    <li>
                    <a href="inicio_root.php"><span class="fa fa-home"></span> &nbsp; Inicio</a>
                    </li>
                    <li>
                    <a href="root.php?view=pass"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Cambiar Contraseña</a>
                    </li>
                    <li>
                    <a href="./root.php?view=rhchecadas"><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Checadas</a>
                    </li>
                    <li>
                    <a href="root.php?view=equipo"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Asignacion de Equipos</a>
                    </li>
                    <li>
                    <a href="root.php?view=listaequipo"><i class="fa fa-list-ol"></i>&nbsp;&nbsp;Lista de Equipos</a>
                    </li>
                    <li>
                    <a href="./root.php?view=rhregistro"><i class="fa fa-users"></i>&nbsp;&nbsp;Registrar Usuario</a>
                    </li>
                    <li>
                    <a href="root.php?view=ticketroot"><span class="glyphicon glyphicon-envelope"></span> &nbsp;Tickets</a>
                    </li>
                    <li>
                    <a href="root.php?view=users"><span class="fa fa-user"></span> &nbsp;Todos los Usuarios</a>
                    </li>
                    <?php endif; ?> 
                    <li class="divider"></li>
                    <li ><a href="./process/logouti.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                    </ul>
                    </li>
                    </ul>
                    <?php endif; ?>
                    <ul class=" nav navbar-nav navbar-rightii">
                    <li>
                    <!-- Estilo botón de tickets en batta de navegación -->
                    <a style="color: white;" href="soporte.php?view=soporte"><span class="fa fa-cogs"></span> &nbsp; Tickets</a>
                    </li>
                    
                    
                    <?php if(!isset($_SESSION['tipo']) && !isset($_SESSION['nombre'])): ?>
                        
                        <li>
                        <!-- Estilo botón de usuario en batta de navegación -->
                        <a style="color: white;" href="#" data-toggle="modal" data-target="#modalLog"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Login</a>
                        </li>
                        <?php endif; ?>
                        
                        </ul>
                        
                        </div>
                        </div>
                        </nav>
                        
                        <div class="modal fade" tabindex="-1" role="dialog" id="modalLog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-center text-primary" id="myModalLabel">Bienvenido</h4>
                        </div>
                        <form action="" method="POST" style="margin: 20px;">
                        <div class="form-group">
                        <label><span class="glyphicon glyphicon-user"></span>&nbsp;Correo</label>
                        <input type="text" class="form-control" name="nombre_login" placeholder="Escribe tu Correo" required=""/>
                        </div>
                        <div class="form-group">
                        <label><span class="glyphicon glyphicon-lock"></span>&nbsp;Contraseña</label>
                        <input type="password" class="form-control" name="contrasena_login" placeholder="Escribe tu contraseña" required=""/>
                        </div>
                        
                        <p>¿Cómo iniciaras sesión?</p>
                        
                        <select class="form-control" name="optionsRadios">
                        <option value="user">Usuario</option>
                        <option value="admin">Soporte Técnico</option>
                        <option value="RH">RH</option>
                        <!-- <option value="capacitacion">Centro de Capacitaciones</option> -->
                        <option value="superoot">VECO</option>
                        </select>
                        
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Iniciar sesión</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                        </div>
                        </form>
                        </div>
                        </div>
                        </div>