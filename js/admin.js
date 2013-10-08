// JavaScript Document
//www.devolada.com.mx
//Desarrollado por Pablo César Sánchez Porta pcsp85@gmail.com

function ses(act,us,ps){
	$.post("cont.php",{act:act,user:us,pass:ps},cont_rec);
	setTimeout('get_menu()',500);
	setTimeout('get_perf()',600);
}

function get_perf(){
	$.post("cont.php",{act:"perfil"},car_perf);
}

function car_perf(resultado){
	$('#perfil').html(resultado);
}

function mnu_adm(m,n,id){
	for(i=1;i<=n;i++){
		if(i==m) document.getElementById('mnu'+i).className='mn_activo';
		else document.getElementById('mnu'+i).className='';
	}
	if(id!='no') mnu_env(id);
}

function not(t){
	$('#not').html(t);
	$('#not').fadeIn();	
	setTimeout('$(\'#not\').fadeOut();',5000);
}

function f_cms(id_cont){
	$.post("cont.php",{act:"f_cms",id_cont:id_cont},cont_rec);
}
function p_cms(id){
	var	err='';
	cont=eval('CKEDITOR.instances.ed_cont'+id+'.getData()');
	if(!cont) err+='&nbsp;-No hay contenido para la sección<br>';
	if(!$('#mnu').html()) err+='&nbsp;-Debes asignar el nombre de la sección<br>';
	
	if(err=='') $.post("cont.php",{act:"p_cms",id_cont:id,mnu:$('#mnu').html(),cont:cont},not);
	else not('<img src="../images/error.png" style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px;"> <strong>Error:</strong><br>'+err+'</div>');
}

function f_usr(id_usr){
	$.post("cont.php",{act:"form_usr",id_usr:id_usr},cont_rec);
}
function p_usr(f){
	var err='', sp=''; 
	f=eval('document.'+f);
	if(f.img.value!='' && f.img.value.indexOf('.jpg')==-1 && f.img.value.indexOf('.jpeg')==-1 && f.img.value.indexOf('.JPG')==-1) err+='&nbsp;&nbsp;-El formato de la fotrografia debe se jpg<br>';
	if(f.nom.value=='') err+='&nbsp;&nbsp;-El campo de nombre no debe estar vacio<br>';
	if(f.user && f.user.value=='') err+='&nbsp;&nbsp;-Debes ingresar el nombre de usuario<br>';
	if(f.pass && f.pass.value=='') err+='&nbsp;&nbsp;-Debes asignar una contraseña<br>';
	if(f.c_pass && f.pass.value!=f.c_pass.value) err+='&nbsp;&nbsp;-La contraseña no coincide<br>';
	if(f.np){
		for(i=0;i<f.np.value;i++) if(eval('f.perm'+i+'.checked')==true) sp='si';
		if(sp=='') err+='&nbsp;&nbsp;-Debes asignar permiso almenos a una sección';
	}
	if(err=='') f.submit();
	else not('<img src="../images/error.png" style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px;"> <strong>Error:</strong><br>'+err+'</div>');
	 return false;
}
function f_contra(id_usr,user,adm){
	$.post("cont.php",{act:"form_contra",id_usr:id_usr,user:user,adm:adm},cont_rec);
}
function p_contra(f){
	f=eval('document.'+f);
	var err="", pass='', n_pass=f.n_pass.value, id_usr=f.id_usr.value;
	if(f.pass){
		pass=f.pass.value;
		if( f.pass.value=='') err+="&nbsp;&nbsp;-Debes ingresar la contraseña actual<br>";
	}
	if(f.n_pass.value=="") err+="&nbsp;&nbsp;-Debes asignar la nueva contraseña<br>";
	if(f.n_pass.value!=f.c_pass.value) err+="&nbsp;&nbsp;-La contrasela no coincide<br>";
	
	if(err==''){
		$.post("cont.php",{act:"p_contra",id_usr:id_usr,pass:pass,n_pass:n_pass},not);
		not('<img src="../images/cargando.gif" style="float:left; margin:5px 10px;"> Enviando datos.');
		f.reset();
	}else not('<img src="../images/error.png" style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px;"> <strong>Error:</strong><br>'+err+'</div>');
}

function b_a(i,u,a){
	ac=''; if(a=='B') ac='bloquear'; else ac='permitir';
	if(confirm('¿Deseas '+ac+' el acceso al usuario '+u+'?')){
		$.post("cont.php",{act:"b_usr",id_usr:i,user:u,a:a},not);
		setTimeout('mnu_env(1)',1000);
	}
}

function ogp(o){
	if(o=="otro") $('#gp').html('<input type="text" name="grupo" id="grupo">');
}

function f_tar(n_t,a){
	$.post("cont.php",{act:"f_tar",n_t:n_t,a:a},cont_rec);
}

function p_tar(){
	var err='';
	if(!$('#grupo').val()) err+='&nbsp;-El grupo es obligatorio<br>';
	
	if(err=='') $.post("cont.php",$('#tarifas').serializeArray(),not);
	else not('<img src="../images/error.png" style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px;"> <strong>Error:</strong><br>'+err+'</div>');
}

function b_cli(f){
	var datos=$('#b_cl').serializeArray();
	$.post("cont.php",datos,r_cli);
}
function r_cli(resultado){
	$('#clientes').html(resultado);
}

function f_cli(n_c,a){
	$.post("cont.php",{act:"f_cli",n_c:n_c,a:a}, cont_rec);
}

function p_cli(){
	var err='';
	if(!$('#p_fiscal').val()) err+='&nbsp;-Debes seleccionar el régimen fiscal<br>';
	if(($('#p_fiscal').val()==1 || $('#p_fiscal').val()==2) && !$('#rfc').val()) err+='&nbsp;-Debes ingresar el RFC<br>';
	if($('#p_fiscal').val()==2 && !$('#r_social').val()) err+='&nbsp;-Debes proporcionar la razon social<br>';
	if(!$('#nom').val()) err+='&nbsp;-El campo nombre no puede estar vacio<br>';
	if(!$('#ap_pat').val()) err+='&nbsp;-El apellido paterno es obligatorio<br>';
	if(!$('#tel').val()) err+='&nbsp;-Debes ingresar el teléfono<br>';
	if(!$('#correo').val()) err+='&nbsp;-El correo electrónico es obligatorio<br>';
	else if($('#correo').val().indexOf('@')==-1) err='&nbsp;-El formato del correo electrónico no es válido<br>';
	if(!$('#dom_fiscal').val()) err+='&nbsp;-El campo domicilio no puede estar vacio<br>';
	if(!$('#cp').val()) err+='&nbsp;-Debes proporcionar el código postal<br>';

	
	if(err=='') $.post("cont.php",$('#f_cl').serializeArray(),not);
	else not('<img src="../images/error.png" style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px;"> <strong>Error:</strong><br>'+err+'</div>');
}

function b_env(f){
	var datos=$('#b_en').serializeArray();
	$.post("cont.php",datos,r_env);
}
function r_env(resultado){
	$('#envios').html(resultado);
}

function f_env(id_e,a){
	$.post("cont.php",{act:"f_env",id_e:id_e,a:a}, cont_rec);
}

function p_env(){
	var err='';
	if(!$('#n_c').val() || !$('#nor').val()) err+='&nbsp;-Debes seleccionar el cliente<br>';
	if(!$('#costo').val()) err+='&nbsp;-Debes seleccionar la tarifa<br>';
	if(!$('#t_pago').val()) err+='&nbsp;-el tipo de pago es obligatorio<br>';
	if(!$('#dom_rec').val() || !$('#nom_rec').val() || !$('#fech_rec').val()) err+='&nbsp;-Todos los datos para la recolección son abligatorios<br>';
	if(!$('#dom_ent').val() || !$('#nom_ent').val() || !$('#fech_ent').val()) err+='&nbsp;-Todos los datos para la entrega son abligatorios<br>';
	
	if(err=='') $.post("cont.php",$('#f_en').serializeArray(),not);
	else not('<img src="../images/error.png" style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px;"> <strong>Error:</strong><br>'+err+'</div>');
}

function a_env(id_e,e){
	$.post("cont.php",{act:"a_env",id_e:id_e,estado:e},not);
}

function get_info(info,a,r){
	$.post("cont.php",{act:"get_info",info:info,a:a,r:r},r_info);
}
function r_info(resultado){
	$('#get_inf').html(resultado);
}