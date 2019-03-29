<?php 
	
	require_once('connection.php');

	$data = $_GET;

	$user = limpiar($data['username']);
	$password = limpiar($data['password']);

	$sql = "SELECT * FROM user WHERE username = '$user' OR email = '$user'";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);

    if ($rows < 1) {

    	$response['error'] = true;
    	$response['message'] = "USUARIO no existe";
    	echo json_encode($response);

    }else{

    	if($row = mysqli_fetch_assoc($result)){

    		$hashedPwdCheck = password_verify($password,$row['password']);

    		if($hashedPwdCheck == false){

    			$response['error'] = true;
    			$response['message'] = "CONTRASEÑA incorrecta";
    			echo json_encode($response);

    		}elseif ($hashedPwdCheck == true) {

    			$response['user_name'] = $row['user_name'];
    			$response['last_name'] = $row['last_name'];
    			$response['username'] = $row['username'];
                $response['email'] = $row['email'];
    			$response['user_photo'] = base64_encode($row['user_photo']);
    			$response['age'] = $row['age'];
    			$response['user_height'] = $row['user_height'];
    			$response['user_weight'] = $row['user_weight'];
    			$response['gender'] = $row['gender'];
    			$response['id_profile'] = $row['id_profile'];

    			echo json_encode($response);
    			mysqli_close($con);

    		}
    	}
    }

	function limpiar($datos){
        
        $datos = trim($datos);  
        $datos = stripslashes($datos);  
        $datos = htmlspecialchars($datos);  
        
        return $datos;

    }


?>