<?php

	include("../../security/security.php");

	$data = array();	

	if (connectDB()){
		$channels = getChannelsTable();
		$data['channels'] = $channels;
	}
	header('Content-Type: application/json');
	echo json_encode($data);
	
?>