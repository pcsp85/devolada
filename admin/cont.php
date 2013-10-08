<? include('conf.php');


if($_SESSION[dvv]!="activo"){
	
	if($_POST[act]=="menu" || $_POST[act]=="perfil") ;
	elseif($_POST[act]=="i_s"){
		
		$ch=mysql_query("select * from usuarios where user='$_POST[user]' and pass=md5('$_POST[pass]')");
		if(mysql_num_rows($ch)==1){
			$dis=mysql_fetch_array($ch);
			if($dis[lock]==''){
				$_SESSION[dvv]='activo';
				
				foreach($dis as $c=>$v) if(!is_numeric($c) && $c!='pass') $_SESSION[$c]=$v;
				mysql_query("insert into log values(null, '$_SESSION[id_usr]', '$_SERVER[REMOTE_ADDR]', '$_SERVER[HTTP_USER_AGENT]',UNIX_TIMESTAMP())");
				echo '<p style="padding: 0 10%"><img src="../images/hecho.png" style="float:left; margin: 0 10px;">La sesión incio exitosamente y cuentas con los siguentes privilegios: </p><ul style="padding: 0 15%">';
				for($i=0;$i<count($_perm);$i++) if(substr($_SESSION[perm],$i,1)==1) echo '<li><h3>'.$_perm["$i"].'</h3>'.$_desc["$i"].'</li>';
				echo '</ul>';
			}else{
				echo '<h1 style="text-align:center;">Autenticación</h1><p style="padding: 5px 20%;"><img src="../images/error.png" style="float:left; margin: 0 10px;">No fue posible inicar la sesión, los datos son correctos, pero existe un bloqueo sobre el usuario, comunicate con el administrador del sitio.</p><center><img src="../images/consultar.png" onclick="ses(false,false,false);" style="cursor:pointer;"><br>Aceptar</center>';
			}
			
		}else{
			echo '<h1 style="text-align:center;">Autenticación</h1><p style="padding: 5px 20%;"><img src="../images/error.png" style="float:left; margin: 0 10px;">No fue posible inicar la sesión, verifica la información, por favor ingresa tu usuario y contraseña:</p><form name="don" method="post" onSubmit="return false"><table align="center" width="500" cellpadding="5" cellspacing="5"><tr><td>Usuario</td><td><input type="text" size="25" name="user" ></td></tr><tr><td>Contraseña</td><td><input type="password" size="25" name="pass" ></td></tr><tr><td colspan="2" align="center"><input type="image" src="../images/consultar.png" onClick="if(this.form.user.value!=\'\' && this.form.pass.value!=\'\') ses(\'i_s\', this.form.user.value, this.form.pass.value); else alert(\'Debes ingresar usuario y contraseña.\');" style="vertical-align:middle;"></td></tr></table></form>';
		}
		
	}else{

		echo '<h1 style="text-align:center;">Autenticación</h1><p style="padding: 5px 20%;">El acceso a este desarrollo es exclusivo para usuarios con cuenta, por favor ingresa tu Usuario y Contraseña:</p><form name="don" method="post" onSubmit="return false"><table align="center" width="500" cellpadding="5" cellspacing="5"><tr><td>Usuario</td><td><input type="text" size="25" name="user" ></td></tr><tr><td>Contraseña</td><td><input type="password" size="25" name="pass" ></td></tr><tr><td colspan="2" align="center"><input type="image" src="../images/consultar.png" onClick="if(this.form.user.value!=\'\' && this.form.pass.value!=\'\') ses(\'i_s\', this.form.user.value, this.form.pass.value); else alert(\'Debes ingresar usuario y contraseña.\');" style="vertical-align:middle;"></td></tr></table></form>';
		
	}

}else{
	if($_POST[act]=="menu"){
		$nmnu=0;
		for($i=0;$i<count($_perm);$i++) if(substr($_SESSION[perm],$i,1)==1){ $nmnu++; $_mnu.='<li id="mnu'.($nmnu+1).'" onclick="mnu_adm('.($nmnu+1).',*nmnu*,'.$i.');">'.$_perm["$i"].'</li>'; }
		$nmnu++;
		echo '<ul><li id="mnu1" class="mn_activo" onclick="ses(false,false,false); mnu_adm(1,'.$nmnu.',false);">Inicio</li>';
		echo str_replace('*nmnu*',"$nmnu",$_mnu);
		echo '</ul>';
		$_SESSION[nmnu]=$nmnu;

	}elseif($_POST[act]=="perfil"){
		if(!is_file('../images/usuarios/'.$_SESSION[id_usr].'.jpg')) $img='no_img_'.$_SESSION[sexo].'.jpg';
		echo '<img src="../images/usuarios/'.$img.'"> <strong>'."$_SESSION[nom] $_SESSION[ap_pat] $_SESSION[ap_mat] ($_SESSION[user])".'</strong><br><span onclick="mnu_adm(0,'.$_SESSION[nmnu].',\'no\');f_usr(\''.$_SESSION[id_usr].'\');">Editar perfil</span><br><span onclick="ses(\'t_s\', false, false);">Cerrar sesión</span>';
		
	}elseif($_POST[act]=="t_s"){
		
		foreach($_SESSION as $c=>$v) $_SESSION[$c]='';	
		echo '<h1 style="text-align:center;">Autenticación</h1><p style="padding: 5px 20%;"><img src="../images/hecho.png" style="float:left; margin: 0 10px;">La sesión se cerro con éxito, para entrar de nuevo debes ingresar tu Usuario y Contraseña:</p><form name="don" method="post" onSubmit="return false"><table align="center" width="500" cellpadding="5" cellspacing="5"><tr><td>Usuario</td><td><input type="text" size="25" name="user" ></td></tr><tr><td>Contraseña</td><td><input type="password" size="25" name="pass" ></td></tr><tr><td colspan="2" align="center"><input type="image" src="../images/consultar.png" onClick="if(this.form.user.value!=\'\' && this.form.pass.value!=\'\') ses(\'i_s\', this.form.user.value, this.form.pass.value); else alert(\'Debes ingresar usuario y contraseña.\');" style="vertical-align:middle;"></td></tr></table></form>';
	
	}elseif($_POST[id]=='0'){
		
		echo '<h1>Content Management System</h1><p>En este administrador puedes editar el contenido de la página web, da clic sobre el nombre de la sección que deseas editar:</p>';
		$mnu=mysql_query("select id_cont, mnu from contenido order by id_cont");
		echo '<ul>';
		while($m=mysql_fetch_array($mnu)) if($m[0]!=5) echo '<li onClick="f_cms(\''.$m[0].'\')" style="cursor:pointer; padding: 5px 0;"><strong>'.$m[1].'</strong></li>';
		echo '</ul>';
		
	}elseif($_POST[act]=='f_cms'){
		
		$cn=mysql_fetch_array(mysql_query("select * from contenido where id_cont=$_POST[id_cont]"));
		$quien=mysql_fetch_array(mysql_query("select user from usuarios where id_usr=$cn[uua]")); $quien=$quien[0];
		echo '<img src="../images/regresar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Regresar" onclick="mnu_env(0);">';
		echo '<img src="../images/guardar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Guardar" onclick="p_cms('.$cn[0].');">';
		echo '<img src="../images/galeria.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Galeria de imagenes" onclick="$(\'#gal\').slideToggle();">';
		echo '<iframe id="gal" frameborder="0" src="galeria.php" style="width:100%; clear:both; max-height:250px; display:none;"></iframe><h2 style="margin-bottom:5px;">Editar contenido de "<span id="mnu" contenteditable="true" title="Puedes cambiar el nobre de la sección">'.$cn[mnu].'</span>"</h2><div id="ed_cont'.$cn[0].'" style="clear: both;" contenteditable="true">'.$cn[cont].'</div><br><br><div class="fua">Última actualización: '.substr($cn[fua],0,-3).' horas por '.$quien.'.</div><script>CKEDITOR.disableAutoInline = true; CKEDITOR.inline( \'ed_cont'.$cn[0].'\' );</script>';
		
	}elseif($_POST[act]=='p_cms'){
		
		mysql_query("update contenido set mnu='$_POST[mnu]', cont='$_POST[cont]', uua=$_SESSION[id_usr] where id_cont=$_POST[id_cont]");
		echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;"><br>Los cambios se guardarón con éxito.</div>';
		
	}elseif($_POST[id]=='1'){
		
		$lu=mysql_query("select * from usuarios order by id_usr");
		$nu=mysql_num_rows($lu);
		if($nu>1){$n='n'; $s='s';}
		echo '<img src="../images/agregar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Agregar usuario" onclick="f_usr(false);"><p>Existe'.$n.' <strong>'.$nu.'</strong> usuario'.$s.' registrado'.$s.'.<p><table align="center" cellpadding="5" cellspacing="0" class="usuarios"><tr><th colspan="2">&nbsp;</th><th>Usuario</th><th>Nombre</th><th>N° movil</th><th>Fecha de alta</th><th>Fecha último acceso</th></tr>';
		while($l=mysql_fetch_array($lu)){
			if(!$bg || $bg=='') $bg='#DFDFD0'; else $bg=''; 
			$fua=mysql_query("select fech_log from log where id_usr=$l[id_usr] order by fech_log desc limit 1");
			if(mysql_num_rows($fua)==0) $fua='Nunca';
			else{
				$fu=mysql_fetch_array($fua);
				$fua=date("d/m/Y H:i",$fu[0]);
			}
			if(!is_file('../images/usuarios/'.$l[id_usr].'.jpg')) $img='no_img_'.$l[sexo].'.jpg'; else $img=$l[id_usr].'.jpg';
			if(!$l[lock]){
				$avl='';
				$acl='<img src="../images/lock.png" title="Bloquear acceso" onclick="b_a(\''.$l[id_usr].'\',\''.$l[user].'\',\'B\')">';
			}else{
				$lo=explode('-',$l[lock]);
				$quien=mysql_fetch_array(mysql_query("select user from usuarios where id_usr=".$lo[0]));
				$cuando=date("d/m/Y H:i",$lo[1]);
				$avl='<img src="../images/lock.png" style="position:absolute; margin-left:-20px; margin-top:10px;" title="Acceso bloqueado por '.$quien[0].' el '.$cuando.'">';
				$acl='<img src="../images/unlock.png" title="Permitir acceso"  onclick="b_a(\''.$l[id_usr].'\',\''.$l[user].'\',\'P\')">';				
			}
			echo '<tr bgcolor="'.$bg.'"><td><img src="../images/usuarios/'.$img.'">'.$avl.'</td><td width="125">'.$acl.' <img src="../images/edit.png" title="Editar perfil del usuario" onclick="f_usr(\''.$l[id_usr].'\');"> <img src="../images/cam_pass.png" title="Cambiar contraseña" onclick="f_contra(\''.$l[id_usr].'\',\''.$l[user].'\', \'yes\');"></td><td>'.$l[user].'</td><td>'."$l[nom] $l[ap_pat] $l[ap_mat]".'</td><td>'.$l[cel].'</td><td>'.date("d/m/Y H:i", $l[fech_reg]).'</td><td>'.$fua.' <img src="../images/ver.png" title="Ver detalle de accesos"><td></tr>';
		}
		echo '</table>';
		
	}elseif($_POST[act]=='form_usr'){
		
		if(is_numeric($_POST[id_usr])){
			$l=mysql_fetch_array(mysql_query("select * from usuarios where id_usr=$_POST[id_usr]"));
			$ro='readOnly';
			$titulo='<h1>Editar perfil del usuario '.$l[user].'</h1>';
			$dis='<img src="../images/cam_pass_g.png" style="cursor:pointer; margin-left:20%;" title="Cambiar contraseña" onclick="f_contra(\''.$l[id_usr].'\',\''.$l[user].'\',\'no\')">';
		}else{
			$titulo='<h1>Agregar usuario</h1>';
			$dis='<div><label><input type="text" name="user"><br>Usuario</label><label><input type="password" name="pass"><br>Contraseña</label><label><input type="password" name="c_pass"><br>Confirmar contraseña</label></div>';
		}
		if(!is_file('../images/usuarios/'.$l[id_usr].'.jpg')){
			$img='no_img_'.$l[sexo].'.jpg';
			$timg='Agregar fotografía para el perfil';
		}else{
			$img=$l[id_usr].'.jpg';
			$timg='Cambiar fotografía para el perfil';
		}
		if(substr($_SESSION[perm],1,1)==1){
			$reg='<img src="../images/regresar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Regresar" onclick="mnu_env(1);">';
			$lperm='<div><strong>Permisos</strong><br>';
			foreach($_perm as $j=>$p){ $np++;
				$lperm.="<label title=\"$_desc[$j]\"><input type=\"checkbox\" name=\"perm$j\" value=\"1\" ";
				if(substr($l[perm],$j,1)==1) $lperm.='checked';
				$lperm.="> $p</label>";
			}
			$lperm.='<input type="hidden" name="np" value="'.$np.'"></div>';
		}
		echo $reg.'<iframe name="bck" frameborder="0" style="display:none;"></iframe><form id="f_usr" name="f_usr"  enctype="multipart/form-data" target="bck" method="post" action="cont.php" onsubmit="return p_usr(this.name);" class="f_usr">'.$titulo.'<input type="hidden" name="act" value="p_usr"><input type="hidden" name="id_usr" value="'.$l[id_usr].'"><div><label style="vertical-align:middle; max-width: 510px;"><img src="../images/usuarios/'.$img.'" style="float:left; vertical-align:middle;"><input type="file" name="img"><br>'.$timg.'<br><small>Se recomienda utilizar una fotografía de 60 x 75 px o proporcional; el sistema hará una extracción de la imagen cargada en caso de que no corresponda al tamaño indicado.</small></label></div><div><label><input type="text" name="nom" value="'.$l[nom].'"><br>Nombre</label><label><input type="text" name="ap_pat" value="'.$l[ap_pat].'"><br>Apellido paterno</label><label><input type="text" name="ap_mat" value="'.$l[ap_mat].'"><br>Apellido materno</label></div><div><label><select name="sexo"><option value=""></option><option value="1" ';
		if($l[sexo]==1) echo 'selected';
		echo '>Hombre</option><option value="2" ';
		if($l[sexo]==2) echo 'selected';
		echo '>Mujer</option></select><br>Sexo</label><label><input type="text" name="cel" value="'.$l[cel].'"><br>Móvil</label><label><textareaz name="dom">'.$l[dom].'</textarea><br>Domicilio</label></div>'.$dis.$lperm.'<input type="image" src="../images/guardar_g.png" name="submit" title="Guardar" style="float:right; margin-right:10%; margin-top:-200px;"></form>';
		
	}elseif($_POST[act]=='p_usr'){
		
		for($i=0;$i<$_POST[np];$i++) if($_POST["perm$i"]==1) $perm_u.='1'; else $perm_u.='0';
		if(!$_POST[id_usr]){
			$chk1=mysql_num_rows(mysql_query("select id_usr from usuarios where user='$_POST[user]'"));
			$chk2=mysql_query("select user from usuarios where nom='$_POST[nom]' and ap_pat='$_POST[ap_pat]'");
			if($chk1==1){
				$err='1';
				$msj='<strong>Error:</strong><br>&nbsp;-El nombre de usuario ya se encuentra registrado en la Base de Datos.';
				$icono='error';
			}elseif(mysql_num_rows($chk2)!=0){
				$nm_usr=mysql_fetch_array($chk2); $nm_usr=$nm_usr[0];
				$err='1';
				$msj='<strong>Error:</strong><br>&nbsp;-Al parecer ya existe esta persona en la base de datos y utiliza el usuario: '.$nm_usr.'.';
				$icono='error';
			}else{
				mysql_query("insert into usuarios (user, pass, perm, nom, ap_pat, ap_mat, sexo, cel, dom, fech_reg) values ('$_POST[user]', md5('$_POST[pass]'), '$perm_u', '$_POST[nom]', '$_POST[ap_pat]', '$_POST[ap_mat]', '$_POST[sexo]', '$_POST[cel]', '$_POST[dom]', UNIX_TIMESTAMP())");
				$n_id_usr=mysql_insert_id();
				$msj='<strong>Listo:</strong><br>&nbsp;-El usuario se creó con éxito<br>';
				$icono='hecho';
			}
		}else{
			$datos="perm='$perm_u',";
			foreach($_POST as $c=>$v) if($c!="id_usr" && $c!="act" && $c!="np" && strrpos($c,'perm')===false && strrpos($c,'submit')===false) $datos.=" $c='$v',";
			$n_id_usr=$_POST[id_usr];
			mysql_query("update usuarios set ".substr($datos,0,-1)." where id_usr=$n_id_usr");
			$msj='<strong>Listo:</strong><br>&nbsp;-La información se actualizó con éxito<br>';
			$icono='hecho';
		}
		
		if($_FILES[img][tmp_name] && !$err ){
			
			$msj.='&nbsp;-No se puede cargar la imagen, esta función aún no esta disponible.';
			
		}
		$resp='<img src="../images/'.$icono.'.png" style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">'.$msj.'</div>';
		echo '<script> window.parent.document.f_usr.id_usr=\''.$n_id_usr.'\'; window.parent.not(\''.$resp.'\');</script>';
		
	}elseif($_POST[act]=='form_contra'){
		
		if($_POST[adm]=='no') $sca='<div><label><input type="password" name="pass"><br>Contraseña actual</label></div>';
		echo '<form name="contra" method="post" onsubmit="return false" class="f_usr"><input type="hidden" name="id_usr" value="'.$_POST[id_usr].'"><h1>Cambiar contraseña del usuario '.$_POST[user].'</h1>'.$sca.'<div><label><input type="password" name="n_pass"><br>Nueva contraseña</label><label><input type="password" name="c_pass"></label></div><div><label><input type="image" src="../images/cam_pass_g.png" onclick="p_contra(this.form.name);" title="Cambiar contraseña"></label></div></form>';
		
	}elseif($_POST[act]=='p_contra'){
		
		$chk=mysql_num_rows(mysql_query("select id_usr from usuarios where id_usr=$_SESSION[id_usr] and pass=md5('$_POST[pass]')"));
		if($chk==1 || !$_POST[pass]){
			mysql_query("update usuarios set pass=md5('$_POST[n_pass]') where id_usr=$_POST[id_usr]");
			echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">La contraseña se cambio con éxito, y tendra efecto la próxima vez que inicie sesión.</div>';
		}else{
			echo '<img src="../images/error.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">La contraseña actual no es correcta, por favor verifica la información y vuelve a intentarlo.</div>';
		}

	}elseif($_POST[act]=='b_usr'){
		
		if($_POST[a]=="B"){
			mysql_query("update usuarios set `lock`=concat_ws('-',$_SESSION[id_usr],UNIX_TIMESTAMP()) where id_usr=$_POST[id_usr]");
			echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">Se bloqueo el acceso al usuario <strong>'.$_POST[user].'</strong>.</div>';
		}elseif($_POST[a]=="P"){
			mysql_query("update usuarios set `lock`='' where id_usr=$_POST[id_usr]");
			echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">Se permite el acceso al usuario <strong>'.$_POST[user].'</strong>.</div>';
		}else echo '<img src="../images/error.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">esta opcion no es válida, verifica la información.</div>';
		
	}elseif($_POST[id]=='2'){
		
		echo '<img src="../images/agregar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Agregar tarifa" onclick="f_tar(\'\',\'agregar tarifa\');"><h1>Tarifas</h1><p>Aquí puedes actualiazar los costos de las tarifas actuales o dar de alta nuevas tarifas.</p>';
		$gpo=mysql_query("select distinct(grupo) from tarifas");
		while($gp=mysql_fetch_array($gpo)){
			echo "<table class='usuarios' style='float:left; margin-left: 40px;'><tr><td colspan='4'><h2>$gp[0]</h2></td></tr>";
			$tar=mysql_query("select * from tarifas where grupo = '$gp[0]' order by n_t");
			while($ta=mysql_fetch_array($tar)){
				echo '<tr title="'.$ta[desc_tarifa].'"><td><img src="../images/edit.png" title="Modificar tarifa" onclick="f_tar(\''.$ta[0].'\',\'modificar tarifa\')"></td><td>'.$ta[tarifa].'</td><td>&nbsp;<strong>$'.number_format($ta[costo],2).'</strong>&nbsp;</td><td>'.substr($ta[fua],0,-3).'</td></tr>';
			}
			echo "</table>";
		}
		
	}elseif($_POST[act]=='f_tar'){
		
		if(is_numeric($_POST[n_t])) $ta=mysql_fetch_array(mysql_query("select * from tarifas where n_t='$_POST[n_t]'"));
		echo '<img src="../images/regresar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Regresar" onclick="mnu_env(2);"><h2>'.ucwords($_POST[a]).'</h2><form name="tarifas" id="tarifas" onsubmit="return false" class="f_usr"><input type="hidden" name="act" value="p_tar"><input type="hidden" name="n_t" id="n_t" value="'.$ta[0].'"><div><label id="gp"><select name="grupo" id="grupo" onChange="ogp(this.value)"><option value=""></option>';
		$opgp=mysql_query("select distinct(grupo) from tarifas");
		while($og=mysql_fetch_array($opgp)){
			echo '<option value="'.$og[0].'" ';
			if($ta[grupo]==$og[0]) echo 'selected';
			echo '>'.$og[0].'</option>';
		}
		echo '<option value="otro">Agregar grupo</option></select><br>Grupo</label><label><input type="text" name="tarifa" id="tarifa" value="'.$ta[tarifa].'"><br>Tarifa</label><label>$<input type="text" name="costo" id="costo" value="'.number_format($ta[costo],2).'" size="8" style="text-align:right;"><br>&nbsp;Costo</label></div><div><textarea name="desc_tarifa" id="desc_tarifa" style="width:400px;">'.$ta[desc_tarifa].'</textarea><br>Descripción</div><input type="image" src="../images/guardar_g.png" onclick="p_tar();" class="image" style="float:right; margin-top:-90px;" title="Guardar"></form>';
		
	}elseif($_POST[act]=='p_tar'){
		
		if(!$_POST[n_t]){
			$chk=mysql_num_rows(mysql_query("select n_t from tarifas where grupo='$_POST[grupo]' and tarifa='$_POST[tarifa]'"));
			if($chk==0){
				mysql_query("insert into tarifas (n_t, grupo, tarifa, desc_tarifa, costo) values (null, '$_POST[grupo]', '$_POST[tarifa]', '$_POST[desc_tarifa]', '$_POST[costo]')");
				$n_t=mysql_insert_id();
				echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">La información de la tarifa se agregó con éxito.</div><script> $(\'#n_t\').val(\''.$n_t.'\');</script>';
			}else echo '<img src="../images/error.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">No se puede agregar la tarifa, ya existe en la base de datos.</div>';
		}else{
			mysql_query("update tarifas set grupo='$_POST[grupo]', tarifa='$_POST[tarifa]', desc_tarifa='$_POST[desc_tarifa]', costo='$_POST[costo]' where n_t=$_POST[n_t]");
			echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">La información de la tarifa se actualizó con éxito.</div>';
		}
		
	}elseif($_POST[id]=='3'){
		
		echo '<img src="../images/agregar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Agregar cliente" onclick="f_cli(\'\',\'agregar cliente\');"><form id="b_cl" onsubmit="return false"><input type="hidden" name="act" value="b_cli"><input type="hidden" name="npag" id="npag">Buscar:<input type="text" name="buscar" onKeyUp="$(\'#npag\').val(\'\'); b_cli(this.form.id)">, mostrar <input type"text" name="max" onKeyPress="return numeros(event);" onKeyUp="$(\'#npag\').val(\'\'); b_cli(this.form.id)" value="10" size="2" style="text-align:center;"> clientes por página.</form><script>b_cli(\'b_cl\');</script><br><br><div id="clientes"></div>';
		
	}elseif($_POST[act]=='b_cli'){
		
		if(!$_POST[max]) $max=10; else $max=$_POST[max];
		$npag=$_POST[npag];
		if(!$npag){ $npag=1; $inicio=0; }
		else $inicio=($npag-1)*$max;
		$sql="select * from clientes";
		if($_POST[buscar]!='') $sql.=" where rfc like '%$_POST[buscar]%' or nom like '%$_POST[buscar]%' or ap_pat like '%$_POST[buscar]%' or ap_mat  like '%$_POST[buscar]%' or r_social like '%$_POST[buscar]%'";
		$treg=mysql_num_rows(mysql_query($sql));
		if($treg==0) echo "<h2>La busqueda no genero resultados</h2>";
		else{
			$tpag=ceil($treg/$max);
			$re=mysql_query($sql." order by n_c limit $inicio, $max");
			echo '<table align="center" cellpadding="5" cellspacing="0" class="usuarios"><tr><th>&nbsp;</th><th>N° de cliente</th><th>Régimen fiscal</th><th>RFC</th><th>Nombre<br>Razón&nbsp;social</th><th>Correo electrónico</th><th>Fecha de alta</th><th>Última actualización</th></tr>';
			while($r=mysql_fetch_array($re)){
				if(!$bg || $bg=='') $bg='#DFDFD0'; else $bg='';
				if($r[p_fiscal]==2) $nor="<strong>$r[r_social]</strong><br>($r[nom] $r[ap_pat] $r[ap_mat])";
				else $nor="<strong>$r[nom] $r[ap_pat] $r[ap_mat]</strong>";
				while(strlen($r[n_c])<6) $r[n_c]='0'.$r[n_c];
				echo '<tr bgcolor="'.$bg.'"><td width="80"><img src="../images/ver.png" title="Ver detalle" onClick="f_cli(\''.$r[n_c].'\',\'ver\');"> <img src="../images/edit.png" title="Editar" onClick="f_cli(\''.$r[n_c].'\',\'editar\');"></td><td>'.$r[n_c].'</td><td>'.$p_fiscal[$r[p_fiscal]].'</td><td>'.$r[rfc].'</td><td>'.$nor.'</td><td>'.$r[correo].'</td><td>'.date("d/m/Y H:i",$r[fech_reg]).'</td><td>'.$r[fua].'</td></tr>';
			}
			echo '</table>';
			//inicia paginador
			echo '<br><div class="paginas">';
			for($pa=1;$pa<=$tpag;$pa++){
				if($pa==$npag) echo " $pa ";
				else echo "<strong onclick=\"$('#npag').val($pa); b_cli('b_cl');\" title=\"Ir a página $pa\"> $pa </strong>";
			}
			echo '</div>';
			//termina paginador
		}
		
	}elseif($_POST[act]=='f_cli'){
		
		if($_POST[a]=='ver'){ $a='ver'; $ro='readOnly'; $di='disabled'; }else $a='';
		echo '<img src="../images/regresar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Regresar" onclick="mnu_env(3);">';
		if(is_numeric($_POST[n_c])){
			$c=mysql_fetch_array(mysql_query("select * from clientes where n_c=$_POST[n_c]"));
			$titulo=ucwords($_POST[a]).' información';
		}else $titulo=ucwords($_POST[a]);
		echo '<h2>'.$titulo.'</h2><form name="f_cl" id="f_cl" onsubmit="return false" class="f_usr'.$a.'"><input type="hidden" name="act" value="p_cli">
		<div><label><input type="text" name="n_c" id="n_c" value="'.$_POST[n_c].'" title="Este dato se asigna automáticamente" readOnly><br>N° de cliente</label><label><select name="p_fiscal" id="p_fiscal" '.$di.'><option value=""></option>';
		foreach($p_fiscal as $z=>$v){ 
			echo '<option value="'.$z.'" ';
			if($c[p_fiscal]==$z) echo 'selected';
			echo '>'.$v.'</option>';
		}
		echo '</select><br>Régimen físcal</label><label><input type="text" name="rfc" id="rfc" value="'.$c[rfc].'" onChange="this.value=this.value.toUpperCase();" '.$ro.'><br>RFC</label></div><div>';
		if($c[fiscal]==2 || $_POST[a]!='ver') echo '<label><input type="text" name="r_social" id="r_social" value="'.$c[r_social].'" '.$ro.'><br>Razón social</label>';
		echo '<label><input type="text" name="nom" id="nom" value="'.$c[nom].'" '.$ro.'><br>Nombre</label><label><input type="text" name="ap_pat" id="ap_pat" value="'.$c[ap_pat].'" '.$ro.'><br>Apellido paterno</label><label><input type="text" name="ap_mat" id="ap_mat" value="'.$c[ap_mat].'" '.$ro.'><br>Apellido materno</label></div><div><label><input type="text" name="tel" id="tel" value="'.$c[tel].'" '.$ro.'><br>Teléfono</label><label><input type="email" name="correo" id="correo" value="'.$c[correo].'" '.$ro.'><br>Correo electónico</label><label><input type="text" name="fech_nac" id="fech_nac" value="'.$c[fech_nac].'" '.$ro.'><br>Fecha de nacimeinto<br>(aaaa-mm-dd)</label></div><div><label><textarea name="dom_fiscal" id="dom_fiscal" cols="25" '.$ro.'>'.$c[dom_fiscal].'</textarea><br>Domicilio</label><label><input type="text" name="cp" id="cp" value="'.$c[cp].'" '.$ro.'><br>Código postal</label></div><input type="image" src="../images/guardar_g.png" onclick="p_cli();" class="image" style="float:right; margin-top:-90px;" title="Guardar"></form>';
		
	}elseif($_POST[act]=='p_cli'){
		
		if(!$_POST[n_c]){
			$chk=mysql_fetch_array(mysql_query("select n_c from clientes where rfc='$_POST[rfc]' or r_social='$_POST[r_social]' or (nom='$_POST[nom]' and ap_pat='$_POST[ap_pat]' and ap_mat='$_POST[ap_mat]' and p_fiscal='$_POST[p_fiscal]')"));
			if(!$chk){
				$ca=' fech_reg,'; $va=' UNIX_TIMESTAMP(),';
				foreach($_POST as $c=>$v) if($c!="n_c" && $c!="act"){ $ca.=" $c,"; $va.=" '$v',"; }
				mysql_query("insert into clientes (".substr($ca,0,-1).") values (".substr($va,0,-1).")");
				$n_c=mysql_insert_id();
				while(strlen($n_c)<6) $n_c='0'.$n_c;
				echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">La información del cliente se guardo con éxito.</div><script> $(\'#n_c\').val(\''.$n_c.'\');</script>';
			}else{
				while(strlen($chk[0])<6) $chk[0]='0'.$chk[0];
				echo '<img src="../images/error.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">La información ya se encuentra en la base de datos y coincide con los datos del ciente <strong>'.$chk[0].'</strong>.</div>';
			}
		}else{
			foreach($_POST as $c=>$v) if($c!="n_c" && $c!="act") $datos.=" $c='$v',";
			mysql_query("update clientes set ".substr($datos,0,-1)." where n_c=$_POST[n_c]");
			echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">La información del cliente se actualizó con éxito.</div>';
		}
		
	}elseif($_POST[id]=='4'){
		
		echo '<img src="../images/agregar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Agregar cliente" onclick="f_env(\'\',\'Generar envio\');"><form id="b_en" onsubmit="return false"><input type="hidden" name="act" value="b_env"><input type="hidden" name="npag" id="npag">Buscar:<input type="text" name="buscar" onKeyUp="$(\'#npag\').val(\'\'); b_env(this.form.id)">, mostrar <input type"text" name="max" onKeyPress="return numeros(event);" onKeyUp="$(\'#npag\').val(\'\'); b_env(this.form.id)" value="10" size="2" style="text-align:center;"> envios por página.</form><script>b_env(\'b_en\');</script><br><br><div id="envios"></div>';
		
	}elseif($_POST[act]=='b_env'){
		
		if(!$_POST[max]) $max=10; else $max=$_POST[max];
		$npag=$_POST[npag];
		if(!$npag){ $npag=1; $inicio=0; }
		else $inicio=($npag-1)*$max;
		$sql="select envios.*, nom, ap_pat, ap_mat, r_social from envios, clientes where envios.n_c=clientes.n_c";
		if($_POST[buscar]!='') $sql.=" and ( guia like '%$_POST[buscar]%' or rfc like '%$_POST[buscar]%' or nom like '%$_POST[buscar]%' or ap_pat like '%$_POST[buscar]%' or ap_mat  like '%$_POST[buscar]%' or r_social like '%$_POST[buscar]%' )";
		$treg=mysql_num_rows(mysql_query($sql));
		if($treg==0) echo "<h2>La busqueda no genero resultados</h2>";
		else{
			$tpag=ceil($treg/$max);
			$re=mysql_query($sql." order by id_e limit $inicio, $max");
			echo '<table align="center" cellpadding="5" cellspacing="0" class="usuarios"><tr><th>&nbsp;</th><th>N° de guia</th><th>Cliente</th><th>Alta</th><th>Recolección</th><th>Entrega</th><th>Estado</th><th>Última actualización</th></tr>';
			while($r=mysql_fetch_array($re)){
				if(!$bg || $bg=='') $bg='#DFDFD0'; else $bg='';
				if($r[r_social]!='') $nor="<strong>$r[r_social]</strong><br>($r[nom] $r[ap_pat] $r[ap_mat])";
				else $nor="<strong>$r[nom] $r[ap_pat] $r[ap_mat]</strong>";
				echo '<tr bgcolor="'.$bg.'"><td width="80"><img src="../images/ver.png" title="Ver detalle" onClick="f_env(\''.$r[id_e].'\',\'ver\');"> <img src="../images/edit.png" title="Editar" onClick="f_env(\''.$r[id_e].'\',\'editar\');"></td><td>'.$r[guia].'</td><td title="'.substr($r[desc_paq],0,150).'...">'.$nor.'</td><td>'.date("d/m/Y H:i",$r[fech_reg]).'</td><td tile="'.$r[dom_rec].' con '.$r[nom_rec].'">'.$r[fech_rec].'</td><td tile="'.$r[dom_ent].' con '.$r[nom_ent].'">'.$r[fech_ent].'</td><td><select onchange="a_env('.$r[id_e].',this.value);">';
				foreach($edos as $z=>$y){
					echo '<option value="'.$z.'"';
					if($z==$r[estado]) echo 'selected';
					echo '>'.$y.'</option>';
				}
				echo '</td><td>'.$r[fua].'</td></tr>';
			}
			echo '</table>';
			//inicia paginador
			echo '<br><div class="paginas">';
			for($pa=1;$pa<=$tpag;$pa++){
				if($pa==$npag) echo " $pa ";
				else echo "<strong onclick=\"$('#npag').val($pa); b_env('b_en');\" title=\"Ir a página $pa\"> $pa </strong>";
			}
			echo '</div>';
			//termina paginador
		}
		
	}elseif($_POST[act]=='f_env'){
		
		if($_POST[a]=='ver'){ $a='ver'; $ro='readOnly'; $di='disabled'; }else $a='';
		echo '<img src="../images/regresar.png" style="float:right; margin-right: 5%; cursor:pointer;" title="Regresar" onclick="mnu_env(4);">';
		if(is_numeric($_POST[id_e])){
			$c=mysql_fetch_array(mysql_query("select envios.*, nom, ap_pat, ap_mat, r_social, grupo from envios, clientes, tarifas where envios.n_c=clientes.n_c and tarifas.n_t=envios.n_t and envios.id_e=$_POST[id_e]"));
				if($c[r_social]!='') $nor="$c[r_social] ($c[nom] $c[ap_pat] $c[ap_mat])";
				else $nor="$c[nom] $c[ap_pat] $c[ap_mat]";
			$titulo=ucwords($_POST[a]).' información';
			echo '<script> setTimeout("get_info(\''.$c[grupo].'\',\'tarifas\',false);",50); setTimeout("$(\'#n_t\').val(\''.$c[n_t].'\');",700);</script>';
		}else $titulo=ucwords($_POST[a]);
		if($c[n_c]) while(strlen($c[n_c])<6) $c[n_c]='0'.$c[n_c];
		echo '<h2>'.$titulo.'</h2><div id="get_inf"></div><form name="f_en" id="f_en" onsubmit="return false" class="f_usr'.$a.'"><input type="hidden" name="act" value="p_env"><input type="hidden" name="id_e" id="id_e" value="'.$c[id_e].'"><div><label><input type="text" id="guia" value="'.$c[guia].'" size="30" title="El número de guia se asigna automáticamente al generar el envío" readOnly><br>N° de guia</label><label><input type="text" name="n_c" id="n_c" value="'.$c[n_c].'" size="7" maxlength="6" onKeyPress="return numeros(event);" onKeyUp="if(this.value.length==6) get_info(this.value,\'cliente\',false);" '.$ro.'><br>N° de cliente</label><label><input type="text" id="nor" size="40" value="'.$nor.'" onKeyUp="get_info(this.value,\'clientes\',false);" '.$ro.'><br>Nombre o Razón social</label></div><div>'.$c[grupo].'<label><select id="servicio" onChange="$(\'#costo\').val(\'\'); get_info(this.value,\'tarifas\',false);" '.$di.'><option></option>';
		$ser=mysql_query("select distinct(grupo) from tarifas");
		while($s=mysql_fetch_array($ser)){
			echo '<option';
			if($c[grupo]==$s[0]) echo ' selected';
			echo '>'.$s[0].'</option>';
		}
		echo '</select><br>Servicio</label><label><select name="n_t" id="n_t" onChange="get_info(this.value,\'costo\',false);" '.$di.'><option></option></select><br>Tarifa</label><label>$<input type="text" name="costo" id="costo" size="7" style="text-align:right;" value="'.$c[costo].'" readOnly><br>&nbsp;Costo</label></div><div><label><select name="t_pago" id="t_pago" onChange="if(this.value==3) $(\'#c_gpp\').fadeIn(); else $(\'#c_gpp\').fadeOut();" '.$di.'><option value=""></option>';
		foreach($t_pago as $z=>$y){
			echo '<option value="'.$z.'"';
			if($z==$c[t_pago]) echo 'selected';
			echo '>'.$y.'</option>';
		}
		echo '</select><br>Tipo de pago</label><label id="c_gpp" ';
		if($c[t_pago]!=3) echo 'style="display:none"'; 
		echo '><input type="text" name="g_pp" id="g_pp" onKeyPress="return numeros(event);" '.$ro.'><br>Prepago</label><label><select name="usr_ent" id="usr_ent" '.$di.'><option value=""></option>';
		$krep=array_search('Repartir',$_perm); for($i=0;$i<count($_perm);$i++) if($i==$krep) $kr.='1'; else $kr.='_'; 
		$rep=mysql_query("select id_usr, user, nom, ap_pat from usuarios where perm like '$kr'");
		while($rp=mysql_fetch_array($rep)){
			echo '<option value="'.$rp[0].'" ';
			if($rp[0]==$c[usr_ent]) echo 'selected';
			echo '>'."$rp[1] ($rp[2] $rp[3])".'</option>';
		}
		echo '</select><br>Repartidor</label></div><div><label><textarea name="desc_paq" id="desc_paq" cols="60" '.$ro.'>'.$c[desc_paq].'</textarea><br>Descripción del paquete</label></div><h3 style="margin-bottom:5px;">Recolectar</h3><div><label class="image"><input type="checkbox" id="mdom_rec" value="" onclick="if(this.checked==true) $(\'#dom_rec\').val(this.value); else $(\'#dom_rec\').val(\'\'); "> En el mismo domicilio del cliente</label></div><div><label><textarea name="dom_rec" id="dom_rec" '.$ro.'>'.$c[dom_rec].'</textarea><br>Domicilio</label><label><input type="text" name="nom_rec" id="nom_rec" value="'.$c[nom_rec].'" '.$ro.'><br>Nombre</label><label><input type="text" name="fech_rec" id="fech_rec" value="'.substr($c[fech_rec],0,-3).'" '.$ro.'><br>Fecha (AAAA-mm-dd HH:mm)</label></div><h3 style="margin-bottom:5px;">Entregar</h3><div><label class="image"><input type="checkbox" id="mdom_ent" value="" onclick="if(this.checked==true) $(\'#dom_ent\').val(this.value); else $(\'#dom_ent\').val(\'\'); "> En el mismo domicilio del cliente</label></div><div><label><textarea name="dom_ent" id="dom_ent"  '.$ro.'>'.$c[dom_ent].'</textarea><br>Domicilio</label><label><input type="text" name="nom_ent" id="nom_ent" value="'.$c[nom_ent].'" '.$ro.'><br>Nombre</label><label><input type="text" name="fech_ent" id="fech_ent" value="'.substr($c[fech_ent],0,-3).'" '.$ro.'><br>Fecha (AAAA-mm-dd HH:mm)</label></div>';
		
		echo '<input type="image" src="../images/guardar_g.png" onclick="p_env();" class="image" style="float:right; margin-top:-90px;" title="Guardar"></form>';
		
	}elseif($_POST[act]=='p_env'){
		
		if(!$_POST[id_e]){
			$hoy=getdate();
			while(strlen($hoy[mday])<2) $hoy[mday]='0'.$hoy[mday]; 
			while(strlen($hoy[mon])<2) $hoy[mon]='0'.$hoy[mon]; 
			while(strlen($_POST[n_t])<3) $_POST[n_t]='0'.$_POST[n_t];
			while(strlen($_POST[t_pago])<2) $_POST[t_pago]='0'.$_POST[t_pago];
			$im=mktime(0,0,0,$hoy[mon],1,$hoy[year]);
			$con=mysql_num_rows(mysql_query("select id_e from envios where fech_reg>= $im"));
			$con++;
			while(strlen($con)<4) $con='0'.$con;
			$guia="$hoy[year]$hoy[mon]$hoy[mday]-$_POST[n_t]-$_POST[t_pago]-$_POST[n_c]-$con";

			$ca=' guia, usr_gen, fech_reg,'; $va=' \''.$guia.'\', '.$_SESSION[id_usr].', UNIX_TIMESTAMP(),';
			foreach($_POST as $c=>$v) if($c!="id_e" && $c!="act" && $c!="servicio"){ $ca.=" $c,"; $va.=" '$v',"; }
			mysql_query("insert into envios (".substr($ca,0,-1).") values (".substr($va,0,-1).")");
			$id_e=mysql_insert_id();
			
			echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;">La información del envio se guardo con éxito y se asigno número de guia.</div><script> $(\'#id_e\').val(\''.$id_e.'\'); $(\'#guia\').val(\''.$guia.'\'); </script>';
			$d_c=mysql_fetch_array(mysql_query("select nom, ap_pat, ap_mat, r_social, correo from clientes where n_c='$_POST[n_c]'"));
			if(!$d_c[r_social]) $nor="$d_c[nom] $d_c[ap_pat] $d_c[ap_mat]";
			else $nor="$d_c[nom] $d_c[ap_pat] $d_c[ap_mat]($d_c[r_social])";
			require("../js/mail/class.phpmailer.php");
			$mail=new PHPMailer();
			$mail->IsHTML(true);
			$mail->SetFrom('ventas@devoladavoy.com.mx',utf8_decode('Mensajería devolada voy'));
			$mail->Subject=utf8_decode("N° de guia ".$guia);
			$mail->AddAddress($d_c[correo]);
			$mail->Body=utf8_decode('<table><tr><td><img src="http://'."$_SERVER[HTTP_HOST]$path".'/images/mail_head.png"></td></tr><tr><td><p>Apreciable <strong>'.$nor.'</strong>:</p><p>Remitimos el número de guia de tu envio <strong>"'.$_POST[servicio].'"</strong>, con el podrás consultar el estado del envio a través de la página <a href="http://'.$_SERVER[HTTP_HOST].'">'.$_SERVER[HTTP_HOST].'</a>, debes dar clic en el menú "¿Por dónde va?" e ingresar el número que aparece a continuación.</p><p>N° de Guia: <strong>'.$guia.'</strong></p><p align="center">¡Gracias por tu preferencia!</p><p>Atentamente<br><strong>Mensajería devolada voy</strong></p><br></td></tr><tr><td><img src="http://'."$_SERVER[HTTP_HOST]$path".'/images/mail_foot.png"></td></tr></table>');
			$mail->Send();

		}else{
			
			foreach($_POST as $c=>$v) if($c!='id_e' && $c!='act') $datos.=" $c='$v',";
			echo ("update envios set ".substr($datos,0,-1)." where id_e=$_POST[id_e]");
			mysql_query("update envios set ".substr($datos,0,-1)." where id_e=$_POST[id_e]");
			echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;"><br>La información del envio se actualizó con éxito.</div>';
		}
		
		
	}elseif($_POST[act]=='a_env'){
		
		mysql_query("update envios set estado='$_POST[estado]' where id_e=$_POST[id_e]");
		echo '<img src="../images/hecho.png"style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px; max-width:280px;"><br>La información del envio se actualizó con éxito.</div>';
		
	}elseif($_POST[act]=='get_info'){
		
		if($_POST[a]=="cliente"){
			$cl=mysql_fetch_array(mysql_query("select n_c, r_social, nom, ap_pat, ap_mat, dom_fiscal from clientes where n_c=$_POST[info]"));
			if(!$cl[0]){
				echo '<div style="float:left; matgin-top:5px; cursor:pointer;" onclick="$(\'#get_inf\').html(\'\'); $(\'#n_c\').val(\'\');"><img src="../images/error.png"style="float:left; margin:5px 10px;" ><strong>Error:</strong><br>&nbsp;-El número de cliente proporcionado no existe.</div>';
			}else{
				if(!$cl[r_social]) $nor="$cl[nom] $cl[ap_pat] $cl[ap_mat]";
				else $nor="$cl[r_social] ($cl[nom] $cl[ap_pat] $cl[ap_mat])";
				echo '<script> $(\'#nor\').val(\''.$nor.'\'); $(\'#mdom_rec\').val(\''.$cl[dom_fiscal].'\'); $(\'#mdom_ent\').val(\''.$cl[dom_fiscal].'\');</script>';
			}
		}elseif($_POST[a]=="clientes"){
			$cl=mysql_query("select n_c, r_social, nom, ap_pat, ap_mat, dom_fiscal from clientes where rfc like '%$_POST[info]%' or nom like '%$_POST[info]%' or ap_pat like '%$_POST[info]%' or ap_mat  like '%$_POST[info]%' or r_social like '%$_POST[info]%'");
			if(mysql_num_rows($cl)!=0){
			echo '<table align="left" cellpadding="5" class="usuarios"><tr><td>Da doble clic sobre el cliente que deseas seleccionar</td></tr>';
			 while($c=mysql_fetch_array($cl)){
				if(!$bg || $bg=='') $bg='#DFDFD0'; else $bg='';
				if(!$c[r_social]) $nor="$c[nom] $c[ap_pat] $c[ap_mat]";
				else $nor="$c[r_social] ($c[nom] $c[ap_pat] $c[ap_mat])";
				while(strlen($c[n_c])<6) $c[n_c]='0'.$c[n_c];
				echo '<tr bgcolor="'.$bg.'"><td ondblclick="$(\'#n_c\').val(\''.$c[n_c].'\'); $(\'#nor\').val(\''.$nor.'\'); $(\'#mdom_rec\').val(\''.$c[dom_fiscal].'\'); $(\'#mdom_ent\').val(\''.$c[dom_fiscal].'\'); $(\'#get_inf\').html(\'\');" style="cursor:pointer;">'.$nor.'</td></tr>';
			}
			}
			echo '</table>';
		}elseif($_POST[a]=="tarifas"){
			echo '<script>$(\'#n_t\').empty(); $(\'#n_t\').append(\'<option value=""></option>\');';
            $ts=mysql_query("select n_t, tarifa from tarifas where grupo='$_POST[info]'");
			while($t=mysql_fetch_array($ts)) echo ' $(\'#n_t\').append(\'<option value="'.$t[0].'">'.$t[1].'</option>\');';
            echo '</script>';
		}elseif($_POST[a]=="costo"){
			$co=mysql_fetch_array(mysql_query("select costo from tarifas where n_t=$_POST[info]"));
			echo '<script>$(\'#costo\').val(\''.number_format($co[0],2).'\');</script>';
		}
		
	}elseif($_POST[id]=='5'){
		
		echo '<h1>Prepagos</h1> <h2>esta sección esta en construcción</h2>';
		
	}elseif($_POST[id]=='6'){
		
		echo '<h1>Facturación</h1> <h2>esta sección esta en construcción</h2>';
		
	}elseif($_POST[id]=='7'){
		
		echo '<h1>Repartir</h1> <h2>esta sección esta en construcción</h2>';
		
	}else{
		
		echo '<p style="padding: 0 10%"><img src="../images/hecho.png" style="float:left; margin: 0 10px;">La sesión incio exitosamente y cuentas con los siguentes privilegios: </p><ul style="padding: 0 15%">';
		for($i=0;$i<count($_perm);$i++) if(substr($_SESSION[perm],$i,1)==1) echo '<li><h3>'.$_perm["$i"].'</h3>'.$_desc["$i"].'</li>';
		echo '</ul>';
		
	}

}
?>