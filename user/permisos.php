<?php 
session_start();
include "../inc/navbarchk.php";

if($_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="user"){
	date_default_timezone_set('America/Mexico_City');
	header('Content-Type: text/html; charset=UTF-8');

	$area = $_SESSION['ar'];

	require '../checador/config.php';
	
?>

<meta charset="UTF-8"><br><br><br>

<style>
	.permiso-top {
		padding: 10px;
		width: 70%;
		margin-left: 45px;
	}

	.permiso_portada {
		width: 60%;
		border: solid 5px;
		border-radius: 100px;
	}
</style>

<div class="container">
	<a href="../soporte.php?view=checador" class="btn btn-danger"><span><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></span> Regresar</a>
</div><br>

<div class="container">
	<div class="row well">
		<div class="col-sm-2">
			<img src="../img/permiso2.png" class="img-responsive permiso-top">
		</div>

		<div class="col-sm-9 lead">
			<h3 class="text-success">¿Cómo enviar un permiso?</h3>
			<p>Para registrar un permiso, deberás llenar todos los campos del siguiente formulario.</p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Permisos de Ausencia</strong></h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-4 text-center">
							<br><br><br>
							<p class="text-success text-justify">Por favor llena todos los datos de este formulario para regitrarlos datos necesarios.</p><br><br><br>	
							<img src="../img/permiso1.png" class="permiso_portada"><br><br>
						</div>

						<div class="col-sm-8">
							<form class="form-horizontal" action="../checador/functions/add/permisos.php" method="POST" enctype="multipart/form-data">
								<fieldset>
									<div class="form-group">
										<label class="col-sm-2 control-label">Hora Creación Permiso</label>
										<div class='col-sm-10'>
											<div class="input-group">
												<input class="form-control" type="text" name="hora_permiso" readonly value="<?php echo date("H:i");?>" placeholder="Ejemplo: 08:00">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Fecha Creación Permiso</label>
										<div class='col-sm-10'>
											<div class="input-group">
												<input class="form-control" type="text" name="fecha_permiso" readonly value="<?php echo date("d/m/Y");?>" placeholder="Ejemplo: 02/10/2024">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label  class="col-sm-2 control-label">Colaborador</label>
										<div class="col-sm-10">
											<div class='input-group'>
												<select class="form-control" name="colaborador" id="colaborador" required>
													<option value=""> - Selecciona el colaborador - </option>
														<?php
														// Buscar los tipos de permisos/motivos de ausencia en la base de datos correspondiente
														$colaboradores = $con->prepare("SELECT * FROM empleados WHERE area = '$area' ORDER BY nombre_colaborador ASC");
														$colaboradores->setFetchMode(PDO::FETCH_OBJ);
														$colaboradores->execute();

														$show_colaboradores = $colaboradores->fetchAll();

														// Si existe información registrada, se muestra
														if ($colaboradores -> rowCount() > 0) {
															foreach ($show_colaboradores as $colaborador) {
																$colaborador -> nombre_colaborador;
																echo '<option value="'.$colaborador -> no_empleado.'">'.$colaborador -> nombre_colaborador.'</option>';
															}
														}
														?>
												</select><span class="input-group-addon"><i class="fa fa-user"></i></span>
											</div>
										</div>
									</div>

									<input type="hidden" class="form-control" value="<?php echo $_SESSION['nombre_completo']; ?>" name="jefe_gerente" placeholder="Ejemplo: Jorge Martinez">

									<div class="form-group">
										<label  class="col-sm-2 control-label">Área</label>
										<div class="col-sm-10">
											<div class='input-group'>
												<input type="text" class="form-control" readonly value="<?php echo $_SESSION['ar']; ?>" name="area" placeholder="Ejemplo: Planta 1">
												<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label  class="col-sm-2 control-label">Motivo de Ausencia</label>
										<div class="col-sm-10">
											<div class='input-group'>
												<select class="form-control" name="motivo_ausencia" required>
													<option value=""> - Selecciona el permiso - </option>
													<?php
													// Buscar los tipos de permisos/motivos de ausencia en la base de datos correspondiente
													$m_ausencia = $con->prepare("SELECT motivo_ausencia FROM motivo_ausencia");
													$m_ausencia->setFetchMode(PDO::FETCH_OBJ);
													$m_ausencia->execute();

													$show_ausencia = $m_ausencia->fetchAll();

													// Si existe información registrada, se muestra
													if ($m_ausencia -> rowCount() > 0) {
														foreach ($show_ausencia as $ausencia) {
															$ausencia -> motivo_ausencia;
															echo '<option value="'.$ausencia -> motivo_ausencia.'">'.$ausencia -> motivo_ausencia.'</option>';
														}
													}
													?>
												</select><span class="input-group-addon"><i class="fa fa-user"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label  class="col-sm-2 control-label">Fecha de Ausencia</label>
										<div class="col-sm-10">
											<div class='input-group'>
												<input type="date" class="form-control" name="fecha_ausencia" min="2024-09-01" required>
												<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label  class="col-sm-2 control-label">Número de días solicitados</label>
										<div class="col-sm-10">
											<div class='input-group'>
												<input type="number" min="0" class="form-control" name="dias_solicitados" placeholder="Ejemplo: 1" required>
												<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											</div>
										</div>
									</div>

									<font size=2 color="red">(El horario de trabajo es de 07:00 AM - 06:00 PM)</font>

									<div class="form-group"><br>
										<label  class="col-sm-2 control-label">Hora de Salida</label>
										<div class="col-sm-10">
											<div class='input-group'>
												<input type="time" class="form-control" name="hora_salida" value="08:00">
												<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label  class="col-sm-2 control-label">Hora de Regreso</label>
										<div class="col-sm-10">
											<div class='input-group'>
												<input type="time" class="form-control" name="hora_regreso" value="17:00">
												<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label  class="col-sm-2 control-label">Fecha de Probable Regreso</label>
										<div class="col-sm-10">
											<div class='input-group'>
												<input type="date" class="form-control" name="fecha_regreso" min="2024-09-01" required>
												<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label  class="col-sm-2 control-label">Observaciones</label>
										<div class="col-sm-10">
											<textarea class="form-control" rows="3" placeholder="Anota tus observaciones aquí" name="observaciones_permiso"></textarea>
										</div>
									</div>
									<br>

									<font size=3 color="green" >Agregar Evidencia </font><font size=1.5 color="red">(Solo se aceptan PDF y el formato de imagen PNG, JPEG y JPG) </font><br>
									<label  class="control-label">Opcional - </label>
									<label  class="control-label">Máximo 5 MB* </label><br>
									<input accept="image/png, .jpeg, .jpg, .pdf" name="evidencia_permiso" id="imagen" type="file"><br>

									<br>

									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" name="Registrar" class="btn btn-success">Registrar</button>
										</div>
									</div>
								</fieldset> 
							</form>
	
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="class_ticket" id="class_ticket" style="display: none;">
<img class="img-responsive animated tada" src="../img/class_ticket.gif" style="position: absolute; left: 10%; float: right; top: 60%; width: 30%; border: 5px solid; border-radius: 10px;">
</div>

<script type="text/javascript">
	function showImg(){
		$("#class_ticket").css("display","block");
	}
</script>

<?php
}else{
	?>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
				
			</div><br><br><br><br><br>
			<div class="col-sm-7 text-center">
				<h1 class="text-danger">Lo sentimos esta página es solamente para Jefes registrados en el Sistema</h1>
				<h3 class="text-info">Inicia sesión con tu usuario para otras funciones</h3>
			</div>
			<div class="col-sm-1">&nbsp;</div>
		</div>
	</div>
	<?php
}

?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#fechainput").datepicker();
	});
</script>
<!--script type="text/javascript" src="../checador/functions/search/buscar_no_empleado.js"></script>
<script type="text/javascript" src="../checador/functions/search/buscar_puesto.js"></script>
<script type="text/javascript" src="../checador/functions/search/buscar_departamento.js"></script-->