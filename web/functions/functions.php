<?php 
    function registro(){
        require_once('data/conexion.php');
        $errores = duplicado($con);

        if (!empty($errores)) {
            return $errores;
        }

        $nombre = strtoupper(limpiar($_POST['nombre']));
        $apellido = strtoupper(limpiar($_POST['apellido']));
        $usuario = strtolower(limpiar($_POST['usuario']));
        $email = limpiar($_POST['email']);
        $clave = limpiar($_POST['clave']);
        $clave2 = limpiar($_POST['clave2']);
        $perfil  = 4;
       
        $hashedPwd = password_hash($clave, PASSWORD_DEFAULT);
        
        // $dec = $con -> prepare("INSERT INTO usuarios(nombre,apellido,id_usuario,email,contraseña,id_perfil) VALUES (? ,?, ?, ?, ?, ?)");
        // $dec -> bind_param("sssssi", $nombre, $apellido, $usuario, $email, $hashedPwd, $perfil);
        // $dec -> execute();
        // $resultado = $dec -> affected_rows;
        // $dec -> free_result();
        // $dec -> close();
        // $con -> close();
        
        $sql = "INSERT INTO usuarios(nombre,apellido,id_usuario,email,contraseña,id_perfil) VALUES ('$nombre', '$apellido', '$usuario', '$email', '$hashedPwd', 4)";
        mysqli_query($con,$sql);
        $errores[] = "Registro realizado con éxito";
        
        return $errores;
        $errores = [];
    }

    function duplicado($con){
        $errores = [];

        $usuario = limpiar($_POST['usuario']);
        $email = limpiar($_POST['email']);

        // $dec -> prepare("SELECT * FROM usuarios WHERE id_usuario = ? OR email = ? ");
        
        // $dec -> bind_param("ss",$usuario,$email);
        // $dec -> execute();
        // $resultado = $dec->get_result();
        // $rows = mysqli_num_rows($resultado);
        // $row = $resultado -> fetch_assoc();
        // $dec -> free_result();
        // $dec -> close();
        
        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$usuario' OR email = '$email'";
        $result = mysqli_query($con,$sql);
        $rows = mysqli_num_rows($result);
        $row = $result -> fetch_assoc();

        if ($rows > 0) {
            if ($_POST['usuario'] == $row['id_usuario']) {
                $errores[] = 'USUARIO se encuentra ocupado';
            }if ($_POST['email'] == $row['email']) {
                $errores[] = 'E-MAIL se encuentra ocupado';
            }
        }

        return $errores;
    }

    function login() {
        require_once('data/conexion.php');
        $errores = [];

        $usuario = strtolower(limpiar($_POST['usuario']));
        $clave = limpiar($_POST['clave']);

        // $dec = $con->prepare("SELECT * FROM usuarios WHERE id_usuario = ? OR email = ? ");

        // $dec->bind_param("ss",$usuario,$usuario);
        // $dec->execute();
        // $resultado = $dec->get_result();
        // $rows = mysqli_num_rows($resultado);
        // $row = $resultado->fetch_assoc();
        // $dec->free_result();
        // $dec->close();
         
        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$usuario' OR email = '$usuario'";
        $result = mysqli_query($con,$sql);
        $rows = mysqli_num_rows($result);

        if($rows < 1){
            $errores[] = "Usuario no existe";
        }else{
            // if($row){
            if($row = mysqli_fetch_assoc($result)){
                //de-hashing the password
                $hashedPwdCheck = password_verify($clave,$row['contraseña']);
                if($hashedPwdCheck == false){
                    $errores = fuerzaBruta($con, $row['intento'], $row['id_usuario'], $row['tiempo']);
                    if (!empty($errores)) {
                        return $errores;
                    }
                    $errores[] = "Contraseña inválida, intente de nuevo";
                }elseif($hashedPwdCheck == true && $row['intento'] < 5){
                    $intento = 0;
                    $tiempo = NULL;
                    $id = $row['id_usuario'];
                    // $dec = $con -> prepare("UPDATE usuarios SET intento = ?, tiempo = ? WHERE id_usuario = ? ");
                    // $dec -> bind_param("iss",$intento,$tiempo,$id);
                    // $dec -> execute();
                    // $dec -> close();
                    // $con -> close();
                    
                    $sql = "UPDATE usuarios SET intento = '$intento', tiempo = '$tiempo' WHERE id_usuario = '$id' ";
			        mysqli_query($con,$sql);

                    //Log in the user here
                    $_SESSION['usuario'] = $row;
                    if($_SESSION['usuario']['id_perfil'] == 1){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['perfil'] = $row['id_perfil'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['apellido'] = $row['apellido'];
                        $_SESSION['foto'] = $row['foto'];
                        $_SESSION['edad'] = $row['edad'];
                        $_SESSION['altura'] = $row['altura'];
                        $_SESSION['peso'] = $row['peso'];
                        $_SESSION['genero'] = $row['genero'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: profile.php');
                        exit;
                    }elseif($_SESSION['usuario']['id_perfil'] == 2){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['perfil'] = $row['id_perfil'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['apellido'] = $row['apellido'];
                        $_SESSION['foto'] = $row['foto'];
                        $_SESSION['edad'] = $row['edad'];
                        $_SESSION['altura'] = $row['altura'];
                        $_SESSION['peso'] = $row['peso'];
                        $_SESSION['genero'] = $row['genero'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: profile.php');   
                        exit;
                    }elseif($_SESSION['usuario']['id_perfil'] == 3){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['perfil'] = $row['id_perfil'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['apellido'] = $row['apellido'];
                        $_SESSION['foto'] = $row['foto'];
                        $_SESSION['edad'] = $row['edad'];
                        $_SESSION['altura'] = $row['altura'];
                        $_SESSION['peso'] = $row['peso'];
                        $_SESSION['genero'] = $row['genero'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: profile.php');
                        exit;
                    }elseif($_SESSION['usuario']['id_perfil'] == 4){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['perfil'] = $row['id_perfil'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['apellido'] = $row['apellido'];
                        $_SESSION['foto'] = $row['foto'];
                        $_SESSION['edad'] = $row['edad'];
                        $_SESSION['altura'] = $row['altura'];
                        $_SESSION['peso'] = $row['peso'];
                        $_SESSION['genero'] = $row['genero'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: profile.php');
                        exit;
                    }
                }elseif($hashedPwdCheck == true && $row['intento'] >= 5){
                    $errores[] = 'Esta cuenta se mantiene bloqueada';
                }
            }

        }

        return $errores;
        $errores = [];

    }

    function actualizar($usuario){
        require_once('data/conexion.php');
        $errores = [];

        $nombre = limpiar($_POST['nombre']);
        $apellido = limpiar($_POST['apellido']);
        $edad = limpiar($_POST['edad']);
        $altura = limpiar($_POST['altura']);
        $peso = limpiar($_POST['peso']);
        if ($_POST['genero'] == 1) {
            $genero = 'F';
        }elseif ($_POST['genero'] == 2) {
            $genero = 'M';
        }

        $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', edad = '$edad', altura = '$altura', peso = '$peso', genero = '$genero' WHERE id_usuario = '$usuario'";
        mysqli_query($con,$sql);
        $errores[] = 'Datos actualzados correctamente';

        return $errores;
        $errores = [];
    }

    function fuerzaBruta($con, $intento, $id, $tiempo){
        /*$errores = [];
        $intento = $intento + 1;

        // $dec = $con -> prepare("UPDATE usuarios SET intento = ? WHERE id_usuario = ? ");
        // $dec -> bind_param("is",$intento,$id);
        // $dec -> execute();
        // $dec -> close();
         
		$sql = "UPDATE usuarios SET intento = '$intento' WHERE id_usuario = '$id'";
        mysqli_query($con,$sql);

        if ($intento == 5) {
            $bloqueo = date('Y-m-d H:i:s');
            // $dec = $con -> prepare("UPDATE usuarios SET tiempo = ? WHERE id_usuario = ? ");
            // $dec -> bind_param("ss",$bloqueo,$id);
            // $dec -> execute();
            // $dec -> close();
            // $con -> close();
            
            $sql = "UPDATE usuarios SET tiempo = '$bloqueo' WHERE id_usuario = '$id'";
	        mysqli_query($con,$sql);

            $errores[] = 'Esta cuenta ha sido bloqueada por los próximos 5 minutos';

        }elseif ($intento > 5) {
            $espera = strtotime(date('Y-m-d H:i:s')) - strtotime($tiempo);
            $minutos = ceil((300 - $espera) / 60); 
            $errores[] = 'Esta cuenta se desbloqueara en ' .$minutos. ' minutos';
            
            if($espera > 300){
                $intento = 1;
                $tiempo = NULL;
                // $dec = $con -> prepare("UPDATE usuarios SET intento = ?, tiempo = ? WHERE id_usuario = ? ");
                // $dec -> bind_param("iss",$intento,$tiempo,$id);
                // $dec -> execute();
                // $dec -> close();
                // $con -> close();
                
                $sql = "UPDATE usuarios SET intento = '$intento', tiempo = '$tiempo' WHERE id_usuario = '$id'";
		        mysqli_query($con,$sql);
            }

            
        }

        return $errores;*/
    }

    function limpiar($datos){
        $datos = trim($datos);  
        $datos = stripslashes($datos);  
        $datos = htmlspecialchars($datos);  
        return $datos;
    }

    function mostrarError($errores){
        $resultado = '
        <!-- contenedor de error -->
            <div class="alert alert-info errores">
                <ul>';
                foreach($errores as $error){
                    $resultado .= '<li>' .htmlspecialchars($error) . '</li>';
                }
                $resultado .= '</ul>
            </div>
        <!-- contenedor de error -->';
        return $resultado;
    }  

    function drawTable(){
        require('data/conexion.php');
        $sql = "SELECT u.nombre, u.apellido, u.id_usuario, p.id_perfil, p.nombre FROM usuarios AS u, perfil AS p WHERE u.id_perfil = p.id_perfil ORDER BY u.apellido ASC;";
        $result = mysqli_query($con,$sql);
        echo '
            <table class="table table-striped table-bordered">
                <thead class="bg-primary" text-align="center">
                    <tr>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">USUARIO</th>
                        <th scope="col">PERFIL</th>
                        <th scope="col">CAMBIAR PERFIL</th>
                    </tr>
                </thead>
                    <tbody>
        ';
                    
                    
        while ($row = mysqli_fetch_array($result)) {
            $sql2 = "SELECT * FROM perfil;";
            $result2 = mysqli_query($con,$sql2);
            
            echo '
                <tr>
                    <td>'.$row[0].' '.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>
                        <select name="perfil" class="custom-select">';
                        while($row2 = mysqli_fetch_array($result2)) {
                            $selected = '';
                            if ($row[3] == $row2[0]) {
                                $selected = 'selected';
                            }
                            echo '
                                <option '.$selected.' value="'.$row2[0].'">'.$row2[1].'</option>
                            ';   
                        }
                    echo ' 
                        </select>   
                    </td>
                    <td class="boton" align=center>
                        <button type="btn">
                            <i class="fas fa-user-edit"></i>
                        </button>
                    </td>
                </tr>
            ';
        }

        echo '
                </tbody>
            </table>
        ';
    }

    function actualizarPerfil(){
        echo "";
    }
    function cargarGenero(){
        require('data/conexion.php');
        $usuario = $_SESSION['usuario'];
        $sql = "SELECT genero FROM usuarios WHERE id_usuario = '$usuario' ";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $selected = '';
        $checked = '';
        if ($row[0] == 'M') {
            $selected = 'checked';
        }else{
            $checked = 'checked';
        }
        echo '
            <div class="custom-control custom-radio">
                <input '.$checked.' type="radio" id="customRadio1" name="genero" class="custom-control-input" value="1" tabindex="6">
                <label class="custom-control-label" for="customRadio1">Femenino</label>
            </div>
            <div class="custom-control custom-radio">
                <input <?php echo '.$selected.' type="radio" id="customRadio2" name="genero" class="custom-control-input" value="2" tabindex="7">
                <label class="custom-control-label" for="customRadio2">Masculino</label>
            </div>
        ';
    }


    function ficha_csrf(){
        $ficha = bin2hex(random_bytes(32));
        
        return $_SESSION['ficha'] = $ficha;
    }

    function validar_ficha($ficha){
        if(isset($_SESSION['ficha']) && hash_equals($_SESSION['ficha'], $ficha)){
            unset($_SESSION['ficha']);
            return true;
        }
        return false;
    }

    function validar($campos){
        $errores = [];
        foreach($campos as $nombre => $mostrar){
            if(!isset($_POST[$nombre]) || $_POST[$nombre] == NULL){
                $errores[] = $mostrar . ' es un campo requerido.';    
            }else {
                $valido = campos();
                foreach ($valido as $campo => $opcion) {
                    if ($nombre == $campo) {
                        if (!preg_match($opcion['patron'], $_POST[$nombre])){
                            $errores[] = $opcion['error'];
                        }
                    }
                }
            }
        }
        return $errores;
    }

    function campo($nombre){
        require('data/conexion.php');
        $usuario = $_SESSION['usuario'];
        if (isset($_SESSION['usuario'])) {
            $sql = "SELECT * FROM usuarios WHERE id_usuario = '$usuario' ";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['usuario'] = $row;
            $_SESSION['usuario'] = $row['id_usuario'];
            $_SESSION['perfil'] = $row['id_perfil'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['apellido'] = $row['apellido'];
            $_SESSION['foto'] = $row['foto'];
            $_SESSION['edad'] = $row['edad'];
            $_SESSION['altura'] = $row['altura'];
            $_SESSION['peso'] = $row['peso'];
            $_SESSION['genero'] = $row['genero'];

            echo $_SESSION[$nombre] ?? $_POST[$nombre] ?? '';
        }
    }

    function campos(){
        $validacion = [
            'nombre' => [
                'patron' => '/^[a-zA-ZñÑ\s]{2,20}+$/i',
                'error' => 'NOMBRE solo puede contener letras y espacios, de 2 a 20 caracteres'
            ],'apellido' => [
                'patron' => '/^[a-zA-ZñÑ\s]{2,20}+$/i',
                'error' => 'APELLIDO solo puede contener letras y espacios, de 2 a 20 caracteres'
            ],'usuario' => [
                'patron' => '/^[a-zA-ZñÑ][\w]{2,20}+$/i',
                'error' => 'USUARIO puede contener letras, números y guion bajos, de 2 a 20 caracteres'
            ],'email' => [
                'patron' => '/^[a-zñÑ]+[\w-\.]{2,}@([\w-]{2,}\.)+[\w-]{2,4}$/i',
                'error' => 'EMAIL debe tener un formato válido, con un maximo de 30 caracteres'
            ],'edad' => [
                'patron' => '/^\d{1,2}$/i',
                'error' => 'EDAD solo pueden ser números mayores de 0 y menores de 100'
            ],'altura' => [
                'patron' => '/^\d{1,3}$/i',
                'error' => 'ALTURA solo pueden ser números mayores de 0 y menores de 300'
            ],'peso' => [
                'patron' => '/^\d{1,3}$/i',
                'error' => 'PESO solo pueden ser números mayores de 0 y menores de 300'
            ]
            //'clave' => [
            //     'patron' => '/(?=^[\w\!@#\$%\^&\*\?]{6,30}$)(?=(.*[A-Z]){1,})^.*/',
            //     'error' => 'Ingrese contraseña válida. Debe tener un mínimo de 6 caracteres, con al menos una mayúscula y un máximo de 30 caracteres'
            // ]

        ];

        return $validacion;

    }

    function comparadorClaves($clave, $clave2){
        $errores = [];
        if ($clave !== $clave2) {
            $errores[] = 'Las contraseñas no coinciden';
        }

        return $errores;
    }

?>