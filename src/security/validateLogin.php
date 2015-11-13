<?php

	include("security.php");


	//$_POST['username'] = 'thomas2';
	//$_POST['email'] = 'thomas@hotmail.com';
	//$_POST['password'] = 'thomasty';
	//$_POST['confirmPassword'] = 'thomasty';

	$errors = array(); // array to hold validation errors
	$data = array(); // array to pass back data

	// validate the variables ======================================================
	if (empty($_POST['username']))
		$errors['username'] = 'Name is required.';
	if (empty($_POST['password']))
		$errors['password'] = 'Password is required.';

	// return a response ===========================================================
	// response if there are errors
	if (!empty($errors)) {//ERROR Step1
	  // if there are items in our errors array, return those errors
			$data['success'] = false;
			$data['errors'] = $errors;
		  	$data['messageError'] = 'Por favor, preencha todos os campos';
	}elseif (connectDB()){//SUCCESS Step1

		$result = validateUser($_POST['username'], $_POST['password']);
		if(strcmp($result, 'success') != 0){//ERROR step2
			$data['success'] = false;
			$data['errors'] = $errors;
	 		$data['messageError'] = $GLOBALS['errorQuery'][$result];
		}else{//SUCCESS step 2
			$data['success'] = true;
			$data['messageSuccess'] = 'Login efetuado com sucesso!';
		}

	}else{//error connectDB
		$data['success'] = false;
		$data['errors'] = $errors;
	 	$data['messageError'] = $GLOBALS['errorQuery']['errorConnectDB'];
	}
	

	echo json_encode($data);
?>