<?php 
	session_start();
	require_once('functions/functions.php');
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ficha']) && validar_ficha($_POST['ficha'])){
        $campos = [
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'edad' => 'Edad',
            'altura' => 'Altura',
            'peso' => 'Peso',
            'genero' => 'Género'
        ];
        $errores = validar($campos);


        if(empty($errores)){
            $errores = actualizar($_SESSION['usuario']);
        }
    }

	$titulo = 'GIOT WEB | Perfil de '.$_SESSION['nombre'].'';
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
<!----------------------- Datos de perfil-deportista, formulario de actalizacion--------------->
 			<form method="POST">
 				<input type="hidden" name="ficha" value="<?php echo ficha_csrf(); ?>">
 				<!-- input para proteccion de spambot -->
                <input type="hidden" name="miel" value="">
                <!-- input para proteccion de spambot -->
				<div class="row">
					<div class="col-sm-offset-5">
			 			<div class="avatar"></div>
			 			<br>
					</div>
			 		<div class="col-sm-offset-4">
			 			<input type="file">
			 		</div>
				</div>

 				<h2>Datos Personales</h2>
 				<br>
 				<div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="nombre" value="<?php campo('nombre') ?>" class="form-control input-lg" placeholder="Nombre" tabindex="1"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        	<input type="text" name="apellido" value="<?php campo('apellido') ?>" class="form-control input-lg" placeholder="Apellido" tabindex="2"/>
                        </div>
                    </div>
                </div>
                <div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<input type="number" name="edad" value="<?php campo('edad') ?>" class="form-control input-lg" placeholder="Edad" tabindex="3">
						</div>
					</div>
					<div class="col-sm-offset-9"></div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<input type="number" name="altura" value="<?php campo('altura') ?>" class="form-control input-lg" placeholder="Altura" tabindex="4">
						</div>
					</div>
					<div class="col-sm-offset-9"></div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<input type="number" name="peso" value="<?php campo('peso') ?>" class="form-control input-lg" placeholder="Peso" tabindex="5">
						</div>
					</div>
					<div class="col-sm-offset-9"></div>
				</div>
				<?php cargarGenero(); ?>
				<hr>
				<div class="row">	
					<div class="col-sm-6">
						<button type="submit" class="btn btn-success btn-lg btn-block" tabindex="8">Actualizar</button>
						<!-- esto es para que los botones en dispositivos moviles no queden juntos -->
                        <br>
                        <!-- esto es para que los botones en dispositivos moviles no queden juntos -->
					</div>
					<div class="col-sm-6">
						<a href="index.php" class="btn btn-danger btn-lg btn-block" tabindex="9">Cancelar</a>
					</div>
				</div>
			</form>
<!----------------------- Datos de perfil-deportista, formulario de actualizacion --------------->
 		</div>
 	</div>
</div>
<!-- Contenedor principal -->

<?php 
	// require_once('partial/footer.php');
	require_once('partial/down.php');
?>