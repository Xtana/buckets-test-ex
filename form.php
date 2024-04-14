<?php

	require_once __DIR__ . '\incs\functions.php';

	if(!empty($_POST)) {
		formProcessing($_POST);
		unset($_POST);
	}

?>