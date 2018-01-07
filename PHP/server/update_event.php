<?php

 
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

session_start();
require ('DBconector.php');

if ($_SESSION['isLogin']) {
	
	$con = new ConectorBD('localhost', 'nextu', 'abc1234*');
	$response['conexion'] = $con -> initConexion('BDAgendaNextU');
	if ($response['conexion'] == 'OK') {
		if(validateDate($_POST['start_date'], 'Y-m-d'))
			$datos['fecha_ini'] = $_POST['start_date'];
		if(validateDate($_POST['start_hour'], 'H:i:s'))
			$datos['hora_ini'] = $_POST['start_hour'];
		if(validateDate($_POST['end_date'], 'Y-m-d'))
			$datos['fecha_fin'] = $_POST['end_date'];
		if(validateDate($_POST['end_hour'], 'H:i:s'))
			$datos['hora_fin'] = $_POST['end_hour'];
		
		if ($con -> actualizarRegistro('Eventos', $datos, 'id = ' . $_POST['id']))
			$response['msg'] = 'OK';
		else
			$response['msg'] = 'Se ha producido un error al guardar el evento'. $_POST['id'];
	} else
		$response['msg'] = 'Problemas con la conexión a la base de datos';
} else
	$response['msg'] = 'Debe iniciar sesión';

echo json_encode($response);


 ?>
