<? session_start();
//Configuracion de DB
$ht="localhost";
$us='devolada_voy';
$ps='dvv3102';
$db='devolada_mailer';
mysql_connect($ht,$us,$ps) or die("No se puede conectar a la DB");
mysql_select_db($db) or die("No se puede seleccionar la DB");

//Configuración de Cuenta de Correo para envío
$ms="devoladavoy.com";
$mc="ventas@devoladavoy.com.mx";
$mp="1234156";

//Configuración para  Carpeta de Imagenes
$pathimg=$_SERVER['DOCUMENT_ROOT']."/mailer/images";
?>