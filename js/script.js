// JavaScript Document
//www.devolada.com.mx
//Desarrollado por Pablo César Sánchez Porta pcsp85@gmail.com

function dnd_env(g){
	$('#donde').html('<br><br><p><img src="/images/cargando.gif"> Cargando ...</p><br><br>');
	$.post("guia.php",{guia:g},dnd_rec);
}
function dnd_rec(resultado){
	$('#donde').html(resultado);
}

function mnu_env(i){
	$('#cont').html('<center><img src="/images/cargando.gif"> Cargando ...</center>');
	$.post("cont.php",{id:i},cont_rec);
}
function cont_rec(resultado){
	$('#cont').html(resultado);
}

function mnu(m,n){
	for(i=1;i<=n;i++){
		if(i==m) document.getElementById('mnu'+i).className='mn_activo';
		else document.getElementById('mnu'+i).className='';
	}
	mnu_env(m);
}

function get_menu(){
	$.post("cont.php",{act:"menu"},car_mnu);
}

function car_mnu(resultado){
	$('#menu').html(resultado);
}

function contact(){
	var err='';
	if(!$('#nom').val() || !$('#ap').val() || !$('#correo').val() || !$('#tel').val() ) err+='&nbsp;-Todos los campos son obligatorios<br>';
	if($('#correo').val().indexOf('@')==-1) err+='&nbsp;-El formato del correo electrónico no es válido<br>';
	
	if(err==''){
		$('#nota').html('<p><img src="/images/cargando.gif"> Enviando...</p>');
		$.post("cont.php",$('#contacto').serializeArray(),cont_rec);
	}else $('#nota').html('<img src="/images/error.png" style="float:left; margin:5px 10px;"><div style="float:left; matgin-top:5px;"> <strong>Error:</strong><br>'+err+'</div>');
}

function numeros(e){
        key = e.keyCode || e.which;
		tecla = String.fromCharCode(key).toLowerCase();
		letras = "1234567890";
		especiales = [8,37,39,46];
		tecla_especial = false;
	 for(var i in especiales){
				if(key == especiales[i]){
					tecla_especial = true;
					break;
				} 
		}
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
			return false;
}