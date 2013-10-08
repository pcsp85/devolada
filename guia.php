<? include("admin/conf.php");
if($_POST[guia]=='clear'){
	echo '<form name="don" method="post" onSubmit="return false"><p>Para saber el estatus de tu envío, debes proporcionar el número de guía que recibiste por correo electrónico.</p><input type="text" size="25" name="guia" > <input type="image" src="images/consultar.png" onClick="if(this.form.guia.value!=\'\') dnd_env(this.form.guia.value); else alert(\'Debes proporcionar el número de guía.\');" style="vertical-align:middle;"></form>';
}elseif($_POST[guia]){
	$gu=mysql_query("select estado, envios.fua, nom, ap_pat, ap_mat, r_social, grupo from envios, clientes, tarifas where envios.n_c=clientes.n_c and tarifas.n_t=envios.n_t and envios.guia='$_POST[guia]'");
	if(mysql_num_rows($gu)==1){
		$g=mysql_fetch_array($gu);
		if(!$g[estado]) $g[estado]=0;
		
		if($g[estado]==2 || $g[estado]==4) $img='hecho.png';
		else $img='pendiente.png';
		
		if(!$g[r_social]) $nom="$g[nom] $g[ap_pat] $g[ap_mat]";
		else $nom="$g[nom] $g[ap_pat] $g[ap_mat] ($g[r_social])";
		
		echo '<div style="margin-top:15px;">Estimado <strong>'.$nom.'</strong> tu envio <strong>"'.$g[grupo].'"</strong> se encuentra en el siguiente estado: <br><img src="images/'.$img.'" title="'.$edos[$g[estado]].'"><br>'.$edos[$g[estado]].'<br>Fecha de actualización: '.substr($g[fua],0,-3).'</div>';
	}else echo '<div style="margin-top:5px;"><img src="images/error.png" style="margin:5px 10px;" ><strong>Error:</strong><br>&nbsp;-El número de guia proporcionado no existe.</div>';
	echo '<br> <img src="images/consultar.png" style="cursor:pointer; clear:both;" title="Consultar otro número de guia" onclick="dnd_env(\'clear\');"><br><br>';
}else echo '<br><br><h1 class="error">¡Acceso denegado!</h1>';

?>