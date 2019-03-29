<?php
    session_start();
    require_once('functions/functions.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ficha']) && validar_ficha($_POST['ficha'])){
        if (!empty($_POST['miel'])) {
            return header('Location: index.php');
        }
        $campos = [
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'usuario' => 'Usuario',
            'email' => 'E-mail',
            'clave' => 'Contraseña',
            'clave2' => 'Confirmación de contraseña',
            'terminos' => 'Términos y Condiciones',
        ];
        $errores = validar($campos);
        $errores = array_merge($errores, comparadorClaves($_POST['clave'], $_POST['clave2']));
        if(empty($errores)){
            $errores = registro();
        }
    }
    
    $titulo = "GIOT WEB | Sing Up";
    require_once('partial/up.php');
    require_once('partial/nav.php');
    require_once('data/conexion.php');
?>
      
<!-- Contenedor principal -->
<div class="container" id="pagina-registro">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <h1 class="titulo-pagina">Registro</h1>

            <hr>

            <!--Llamando a funcion para mostrar errores -->
            <?php 
                if(!empty($errores)){echo mostrarError($errores);}  
            ?>
            <!--Llamando a funcion para mostrar errores -->

            <!-- Formulario de registro -->
            <form method="POST" id="formulario-registro">
                <input type="hidden" name="ficha" value="<?php echo ficha_csrf(); ?>">
                <!-- input para proteccion de spambot -->
                <input type="hidden" name="miel" value="">
                <!-- input para proteccion de spambot -->
                <h2>Registrate <small>para acceder a los beneficios de GIOT</small></h2>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input title="Nombre requerido, solo letras" pattern="[a-zA-ZñÑ]{2,20}" type="text" value="<?php campo('nombre') ?>" class="form-control input-lg" name="nombre" placeholder="Nombre" tabindex="1" autofocus required/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <input title="Apellido requerido, solo letras" pattern="[a-zA-ZñÑ]{2,20}" type="text" value="<?php campo('apellido') ?>" class="form-control input-lg" name="apellido" placeholder="Apellido" tabindex="2" required/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input title="Usuario requerido" type="text" value="<?php campo('usuario') ?>" pattern="[a-zA-ZñÑ0-9.!#$%&'*+/=?^_`{|}~-]{2,20}" class="form-control input-lg" name="usuario" placeholder="Nombre de usuario" tabindex="3" required/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-at"></i></span>
                            <input title="mail@example.com" type="email" class="form-control input-lg" value="<?php campo('email')?>" name="email" placeholder="E-mail" tabindex="4" required/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-key"></i></span>
                            <input type="password" class="form-control input-lg" name="clave" placeholder="Contraseña" tabindex="5" required/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-key"></i></span>
                            <input type="password" class="form-control input-lg" name="clave2" placeholder="Confirmar contraseña" tabindex="6" required/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <label class="btn btn-primary btn-lg btn-block">
                            <input type="checkbox" name="terminos" tabindex="7" <?php if(isset($_POST['terminos'])){echo "checked='checked'";} ?> required/>
                            Acepto
                        </label>
                    </div>
                    <div class="col-sm-9">
                        Al registrarme acepto los terminos y condiciones para que mis datos sean utilizados por GIOT
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="8">Registrar</button>
                        <!-- esto es para que los botones en dispositivos moviles no queden juntos -->
                        <br>
                        <!-- esto es para que los botones en dispositivos moviles no queden juntos -->
                    </div>
                    <div class="col-sm-6">
                        <a href="index.php" class="btn btn-danger btn-lg btn-block" tabindex="9">Cancelar</a>
                    </div>
                </div>

            </form>
            <!-- Formulario de registro -->
        </div>
    </div>
</div>
<!-- Contenedor principal -->

<?php
    // require_once('partial/footer.php');
    require_once('partial/down.php');
?>