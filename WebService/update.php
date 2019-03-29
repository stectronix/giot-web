<?php 
	require_once("connection.php");

    $data = $_GET;
        
    $nombre = strtoupper(limpiar($data['nombre']));
    $apellido = strtoupper(limpiar($data['apellido']));
    $foto = $data['foto'];
    $edad = limpiar($data['edad']);
    $altura = limpiar($data['altura']);
    $peso = limpiar($data['peso']);
    $genero = limpiar($data['genero']);;
    $username = limpiar($data['username']);

    $update = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', foto = '$foto', edad = '$edad', altura = '$altura', peso = '$peso', genero = '$genero' WHERE id_usuario = '$username'";
    $resultado_update = mysqli_query($con,$update);

    if($resultado_update){
        $consulta = "SELECT * FROM usuarios WHERE id_usuario = '$username'";
        $resultado = mysqli_query($con,$consulta);
    
        if($row = mysqli_fetch_assoc($resultado)){
            $response['id_usuario'] = $row['id_usuario'];
            $response['nombre'] = $row['nombre'];
            $response['apellido'] = $row['apellido'];
            $response['email'] = $row['email'];
            $response['foto'] = $row['foto'];
            $response['edad'] = $row['edad'];
            $response['altura'] = $row['altura'];
            $response['peso'] = $row['peso'];
            $response['genero'] = $row['genero'];
        }
        echo json_encode($response);
        mysqli_close($con);
        
    }else{
        $response["error"] = true;
        $response["message"] = "Ocurrió un problema, intente de nuevo";
        echo json_encode($response);
    }

    function limpiar($datos){
        $datos = trim($datos);  
        $datos = stripslashes($datos);  
        $datos = htmlspecialchars($datos);  
        return $datos;
    }

?>