<?php 
	require_once("connection.php");

    $data = $_GET;
        
    $name = limpiar($data['name']);
    $last_name = limpiar($data['last_name']);
    $username = limpiar($data['username']);
    $email = limpiar($data['email']);
    $password = limpiar($data['password']);

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";

    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    $row = $result -> fetch_assoc();

    if ($rows > 0) {
        if ($username == $row['username']) {
            
            $response['error'] = true;
            $response['message'] = "USUARIO ocupado";
            echo json_encode($response);

        }elseif ($email == $row['email']) {

            $response['error'] = true;
            $response['message'] = "EMAIL ocupado";
            echo json_encode($response);

        }

    }else{

        $insert = "INSERT INTO users(username, user_name, last_name, email, password,id_profile) VALUES ('$username','$name','$last_name','$email','$hashedPwd',4)";

        $resultado_insert = mysqli_query($con,$insert);

        if($resultado_insert){

            $response['error'] = false; 
            $response['message'] = "Registro satisfactorio"; 

            echo json_encode($response);
            mysqli_close($con);
        }
    }  

    function limpiar($datos){
        $datos = trim($datos);  
        $datos = stripslashes($datos);  
        $datos = htmlspecialchars($datos);  
        return $datos;
    }




?>