<?php
include '../checador/functions/links2.php';
?>
<style>
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: -150%;
}

/* Estilo de barra de navegación del Checador Virtual */
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
<title>Checador Virtual</title>
<nav class="navbar navbar-sop navbar-fixed-top" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand" href="../soporte.php?view=ticket"><i class="fa fa-laptop"></i>&nbsp;&nbsp;Checador Virtual
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<?php if(isset($_SESSION['tipo']) && isset($_SESSION['nombre'])): ?>
    <ul class="nav navbar-nav navbar-rightii">
    <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown">
    <span class="glyphicon glyphicon-user"></span> &nbsp; <?php echo $_SESSION['nombre_completo']; ?>
    </a>
<?php endif; ?>
</div>
</div>
</nav>