<?php
	include("../../security/security.php");

	//$_POST['name'] = 'canal1';
	//$_POST['description'] = 'teste';

	$data = array();
	$errors = array();

	if(connectDB()){
		
		$result = removeAllChannels();

		if(strcmp($result, 'success') == 0){//sucess
			$data['success'] = true;
			$data['message'] = 'Canais removidos com sucesso!';
		}else{
			$data['success'] = false;
			$errors['message'] = $errorQuery[$result];
			$data['errors'] = $errors;
		}
		disconnectDB();

	}else{
		$data['success'] = false;
		$errors['message'] = $errorQuery['errorConnectDB'];
		$data['errors'] = $errors;
	}

	echo json_encode($data);
?>