<?php
  session_start();
  require ('DBconector.php');

if($_SESSION['isLogin']){
	
	$con = new ConectorBD('localhost', 'nextu', 'abc1234*');
	$response['conexion'] = $con -> initConexion('BDAgendaNextU');
	
	if ($response['conexion'] == 'OK') {
		$datos['titulo'] = $_POST['titulo'];
		$datos['fecha_ini'] = $_POST['start_date'];
		if($_POST['allDay']=='true')
			$datos['dia_completo'] = 1;
		else {
			$datos['dia_completo'] = 0;
			$datos['hora_ini'] = $_POST['start_hour'];
			$datos['fecha_fin'] = $_POST['end_date'];
			$datos['hora_fin'] = $_POST['end_hour'];
		}
		$datos['Usuarios_id'] = $_SESSION['userLogin']['id'];
		
		if ($con -> insertData('Eventos', $datos))
			$response['msg'] = 'OK';
		else
			$response['msg'] = 'Se ha producido un error al guardar el evento';
	} else
		$response['msg'] = 'Problemas con la conexión a la base de datos';
} else
	$response['msg'] = 'Debe iniciar sesión';

echo json_encode($response);


?>
