<? include('admin/conf.php');

if(is_numeric($_POST[id])){
	
	$ch=mysql_query("select cont,fua from contenido where id_cont=$_POST[id]");
	if(mysql_num_rows($ch)==1){
		$cont=mysql_fetch_array($ch);
		echo $cont[0].'<br><div class="fua">Última actualización: '.substr($cont[1],0,-3).' horas.</div>';
	}else echo '<h1 class="error">Error: no se puede obterner el contenido.</h1>';
	
}elseif($_POST[act]=="menu"){

	echo '<ul>';
	$mnu=mysql_query("select id_cont, mnu from contenido order by id_cont");
	$nm=mysql_num_rows($mnu);
  	while($m=mysql_fetch_array($mnu)){
		echo '<li ';
		if($m[0]==1) echo'class="mn_activo" ';
		echo 'id="mnu'.$m[0].'" onClick="mnu('.$m[0].','.$nm.');">'.$m[1].'</li>';
	}
    echo '<li onClick="$(\'#donde\').slideToggle(300);">¿Por dónde va?</li>
  </ul>
  	<a href="#" target="_blank"><img src="images/mn_in.jpg"></a>
    <a href="http://www.facebook.com/devoladavoy" target="_blank"><img src="images/mn_fb.jpg"></a>
    <a href="https://twitter.com/devoladavoy" target="_blank"><img src="images/mn_tw.jpg"></a><script> mnu(1);</script>';

}elseif($_POST[act]=="contacto"){
	require("js/mail/class.phpmailer.php");
	$mail= new PHPMailer();
	$mail->IsHTML(true);
	$mail->SetFrom('ventas@devoladavoy.com.mx',utf8_decode('Mensajería devolada voy'));
	$mail->Body=utf8_decode('<table><tr><td><img src="http://'."$_SERVER[HTTP_HOST]$path".'/images/mail_head.png"></td></tr><tr><td><p>Enviaron el formulario de contacto con los siguientes datos: <table><tr><td>Nombre:</td><td>'."$_POST[nom] $_POST[ap]".'</td></tr><tr><td>correo electrónico:</td><td>'.$_POST[correo].'</td></tr><tr><td>Teléfono:</td><td>'.$_POST[tel].'</td></tr><tr><td>Mensaje:</td><td>'.$_POST[mensaje].'</td></tr></table></td></tr><tr><td><img src="http://'."$_SERVER[HTTP_HOST]$path".'/images/mail_foot.png"></td></tr></table>');
	$mail->AddReplyTo($_POST[correo],"$_POST[nom] $_POST[ap]");
	$mail->AddAddress('ventas@devoladavoy.com.mx');
	$mail->Subject="Contacto desde www.devolada.com.mx";
	if($mail->Send()) echo '<br><br><br><p><img src="/images/hecho.png" style="float:left; margin: 0 10px;"> Listo, el mesaje se envió con éxito, muy pronto nos pondremos en contacto.</p><br><br><br>';
	else '<br><br><br><p class="error"><img src="/images/error.png" style="float:left; margin: 0 10px;"> Error al enviar el mensaje, por favor intentalo de nuevo más tarde.</p><br><br><br>';

}else echo '<br><br><h1 class="error">¡Acceso denegado!</h1>';
?>