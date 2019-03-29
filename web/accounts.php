<?php 
	session_start();
	require_once('functions/functions.php');

	$titulo = 'GIOT WEB | Cuentas';
	require_once('partial/up.php');
	require_once('partial/nav.php');
	require_once('data/conexion.php');
 ?>

<!-- Contenedor principal -->
<div class="container" id="perfil-deportista">
    <?php 
        if(isset($_SESSION['usuario'])){
            echo '
                <p>Bienvenido '.$_SESSION['nombre'].' '.$_SESSION['apellido'].' </p>
            ';
        }
    ?>
 	<div class="row">
 		<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
 			<hr>
 			<!--Llamando a funcion para mostrar errores -->
            <?php 
                if(!empty($errores)){echo mostrarError($errores);}  
            ?>
            <!--Llamando a funcion para mostrar errores -->
			<input type="hidden" name="ficha" value="<?php echo ficha_csrf(); ?>">
			<!-- input para proteccion de spambot -->
        	<input type="hidden" name="miel" value="">
	        <!-- input para proteccion de spambot -->
			<br>
			<h2>Lista de Cuentas</h2>
			<br>
			<hr>
			<div class="table-ressponsive">
				<?php drawTable(); ?>
			</div>
 		</div>
 	</div>
</div>
<!-- Contenedor principal -->

<?php 
	// require_once('partial/footer.php');
	require_once('partial/down.php');
?>