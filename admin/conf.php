<? session_start();
error_reporting(0);
/** Información para conexión a base de datos **/
$ht='localhost';
$us='devolada_voy';
$ps='dvv3102';
$db='devolada_voy';
$path='';

/** coneixion a la base de datos **/
mysql_connect($ht,$us,$ps) or die('Imposible realizar la conexion a la base de datos.');
mysql_query("SET time_zone = '-05:00'");
mysql_select_db($db) or die('No se puede seleccionar el esquema.');

/** Módulos existentes **/
$_perm[]='CMS';
$_desc[]='Content Management System, puedes adminitrar el contenido de cada una de las secciones de la página web.';
$_perm[]='Usuarios';
$_desc[]='Administrar usuarios y sus respectivos privilegios dentro de esta aplicación.';
$_perm[]='Tarifas';
$_desc[]='Administrar configuración tarifas.';
$_perm[]='Clientes';
$_desc[]='Administrar la información de los clientes.';
$_perm[]='Envios';
$_desc[]='Administración de envios:<ul><li>Generar guias</li><li>Actualizar estado</li><li>Descargar reportes</li></ul>';
$_perm[]='Prepagos';
$_desc[]='Administración de guias prepagadas.';
$_perm[]='Facturación';
$_desc[]='Control administrativo de facturación de servicios.';
$_perm[]='Repartir';
$_desc[]='Como repartidor puedes verificar los paquetes que te fueron asignados así como actualizar su estado (recolectado, en tránsito, entregado).';

/** Variables que pueden usarse en cualquier parte del sistema **/
$p_fiscal=array(1=>'Persona física', 2=>'Persona moral', 3=>'Ninguno');
$t_pago=array(1=>'Efectivo',2=>'Cargo a factura', 3=>'Prepago');
$edos=array(0=>'Inactiva',1=>'En recolección',2=>'En tránsito', 3=>'Entregado', 4=>'En tránsito regreso', 5=>'Acuse Entregado');

/** Función para envio de correo electrónico **/

function s_mail($para,$asunto,$mensaje,$adjunto){
	require("../js/mail/class.phpmailer.php");
	$mail= new PHPMailer();
	$mail->IsHTML(true);
	$mail->SetFrom('ventas@devoladavoy.com.mx','Mensajería devolada voy');
	$mail->AddAddress($para);
	$mail->Subject=$asunto;
	$mail->Body='<table><tr><td><img src="'."$_SERVER[DOCUMENT_ROOT]$path".'/images/mail_head.png"></td></tr><tr><td>'.$mensaje.'</td></tr><tr><td><img src="'."$_SERVER[DOCUMENT_ROOT]$path".'/images/mail_foot.png"></td></tr></table>';
	if($adjunto!='') $mail->AddAttachment($adjunto);
	$mail->Send();

}
?>