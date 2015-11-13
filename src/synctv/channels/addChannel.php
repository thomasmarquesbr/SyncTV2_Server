<?php
	include("../../security/security.php");

	//$_POST['name'] = 'canal1';
	//$_POST['description'] = 'teste';

	$channel = array();
	$channel['name'] = $_POST['name'];
	$channel['description'] = $_POST['description'];

	$data = array();
	$errors = array();

	if(connectDB()){
		if(isset($channel))
			$result = insertChannel($channel);

		if(strcmp($result, 'success') == 0){//sucess
			$data['success'] = true;
			$data['message'] = 'Cadastro efetuado com sucesso!';
		}else{
			$data['success'] = false;
			$errors['message'] = $errorQuery[$result];
			$data['errors'] = $errors;
		}

	}else{
		$data['success'] = false;
		$errors['message'] = $errorQuery['errorConnectDB'];
		$data['errors'] = $errors;
	}

	echo json_encode($data);

?>