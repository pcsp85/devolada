<? include("config.php");
if($_SESSION["mailer"]!="activo") header("Location: ./");
if($_POST["act"]=="actual"){
	mysql_query("update destinatarios set $_POST[cam]='$_POST[val]' where id = $_POST[id]");
	mysql_query("update listas set modif = UNIX_TIMESTAMP() where id = $_POST[id_ld]");
}
if($_POST["act"]=="add"){
	for($i=1;$i<=$_POST["nd"];$i++) if($_POST["correo$i"]!="") mysql_query("insert into destinatarios (id, nombre, apellidos, cargo, empresa, correo, fecha, usr, id_ld) values ('', '".$_POST["nombre$i"]."', '".$_POST["apellidos$i"]."', '".$_POST["cargo$i"]."', '".$_POST["empresa$i"]."', '".$_POST["correo$i"]."', UNIX_TIMESTAMP(), '$_SESSION[usr]', '$_POST[id_ld]')");
	mysql_query("update listas set modif = UNIX_TIMESTAMP() where id = $_POST[id_ld]");
}
if($_POST["act"]=="del"){
	mysql_query("delete from destinatarios where id =  $_POST[id]");
	mysql_query("update listas set modif = UNIX_TIMESTAMP() where id = $_POST[id_ld]");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>.: Mailer W3D :.</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;	background: #989898;
margin: 0;
	padding: 0;
	color: #000;
}
/* ~~ Selectores de elemento/etiqueta ~~ */
ul, ol, dl { /* Debido a las diferencias existentes entre los navegadores, es recomendable no añadir relleno ni márgenes en las listas. Para lograr coherencia, puede especificar las cantidades deseadas aquí o en los elementos de lista (LI, DT, DD) que contienen. Recuerde que lo que haga aquí se aplicará en cascada en la lista .nav, a no ser que escriba un selector más específico. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* la eliminación del margen superior resuelve un problema que origina que los márgenes escapen del bloque contenedor. El margen inferior restante lo mantendrá separado de los elementos de que le sigan.  */
	padding-right: 15px;
	padding-left: 15px; /* la adición de relleno a los lados del elemento dentro de los bloques, en lugar de en los elementos del bloque propiamente dicho, elimina todas las matemáticas de modelo de cuadro. Un bloque anidado con relleno lateral también puede usarse como método alternativo. */
}
a img { /* este selector elimina el borde azul predeterminado que se muestra en algunos navegadores alrededor de una imagen cuando está rodeada por un vínculo */
	border: none;
}
/* ~~ La aplicación de estilo a los vínculos del sitio debe permanecer en este orden (incluido el grupo de selectores que crea el efecto hover -paso por encima-). ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* a no ser que aplique estilos a los vínculos para que tengan un aspecto muy exclusivo, es recomendable proporcionar subrayados para facilitar una identificación visual rápida */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* este grupo de selectores proporcionará a un usuario que navegue mediante el teclado la misma experiencia de hover (paso por encima) que experimenta un usuario que emplea un ratón. */
	text-decoration: none;
}
/* ~~ Este contenedor de anchura fija rodea a todas las demás bloques ~~ */
.container {
	width: 960px;
	background: #FFFFFF;
	margin: 0 auto; /* el valor automático de los lados, unido a la anchura, centra el diseño  */
	border-radius: 0px 0px 10px 10px;
}
/* ~~ No se asigna una anchura al encabezado. Se extenderá por toda la anchura del diseño. ~~ */
header {
	background:#0073AB;
}
/* ~~ Estas son las columnas para el diseño. ~~ 

1) El relleno sólo se sitúa en la parte superior y/o inferior de los elementos del bloque. Los elementos situados dentro de estos bloques tienen relleno a los lados. Esto le ahorra las "matemáticas de modelo de cuadro". Recuerde que si añade relleno o borde lateral al bloque propiamente dicho, éste se añadirá a la anchura que defina para crear la anchura *total*. También puede optar por eliminar el relleno del elemento en el  bloque y colocar un segundo bloque dentro de éste sin anchura y el relleno necesario para el diseño deseado.

2) No se asigna margen a las columnas, ya que todas ellas son flotantes. Si es preciso añadir un margen, evite colocarlo en el lado hacia el que se produce la flotación (por ejemplo: un margen derecho en un bloque configurado para flotar hacia la derecha). En muchas ocasiones, puede usarse relleno como alternativa. En el caso de bloques para los que deba incumplirse esta regla, deberá añadir una declaración "display:inline" a la regla del elemento del bloque para evitar un error que provoca que algunas versiones de Internet Explorer dupliquen el margen.

3) Dado que las clases se pueden usar varias veces en un documento (y que también se pueden aplicar varias clases a un elemento), se ha asignado a las columnas nombres de clases en lugar de ID. Por ejemplo, dos bloques de barra lateral podrían apilarse si fuera necesario. Si lo prefiere, éstas pueden cambiarse a ID fácilmente, siempre y cuando las utilice una sola vez por documento.

4) Si prefiere que la navegación esté a la izquierda en lugar de a la derecha, simplemente haga que estas columnas floten en dirección opuesta (todas a la izquierda en lugar de todas a la derecha) y éstas se representarán en orden inverso. No es necesario mover los bloques por el código fuente HTML.

*/
.sidebar1 {
	float: right;
	width: 180px;
	background: #E8E8E8;
	padding-bottom: 10px;
	min-height: 300px;
}
.content {
	padding: 10px 0;
	width: 780px;
	float: right;
	font-size: 12px;
}

/* ~~ Este selector agrupado da espacio a las listas del área de .content ~~ */
.content ul, .content ol {
	padding: 0 15px 15px 40px; /* este relleno reproduce en espejo el relleno derecho de la regla de encabezados y de párrafo incluida más arriba. El relleno se ha colocado en la parte inferior para que el espacio existente entre otros elementos de la lista y a la izquierda cree la sangría. Estos pueden ajustarse como se desee. */
}

/* ~~ Los estilos de lista de navegación (pueden eliminarse si opta por usar un menú desplegable predefinido como el de Spry) ~~ */
nav ul {
	list-style: none; /* esto elimina el marcador de lista */
	border-top: 1px solid #666; /* esto crea el borde superior de los vínculos (los demás se sitúan usando un borde inferior en el LI) */
	margin-bottom: 15px; /* esto crea el espacio entre la navegación en el contenido situado debajo */
}
nav ul li {
	border-bottom: 1px solid #666; /* esto crea la separación de los botones  */
}
nav ul a, nav ul a:visited { /* al agrupar estos selectores, se asegurará de que los vínculos mantengan el aspecto de botón incluso después de haber sido visitados  */
	padding: 5px 5px 5px 15px;
	display: block; /* esto asigna propiedades de bloque al vínculo, lo que provoca que llene todo el LI que lo contiene. Esto provoca que toda el área reaccione a un clic de ratón. */
	width: 160px;  /*esta anchura hace que se pueda hacer clic en todo el botón para IE6. Puede eliminarse si no es necesario proporcionar compatibilidad con IE6. Calcule la anchura adecuada restando el relleno de este vínculo de la anchura del contenedor de barra lateral. */
	text-decoration: none;
	background: #55BFFF;
}
nav ul a:hover, nav ul a:active, nav ul a:focus { /* esto cambia el color de fondo y del texto tanto para usuarios que naveguen con ratón como para los que lo hagan con teclado */
	background: #0073AB;
	color: #FFF;
}

/* ~~ El pie de página ~~ */
footer {
	padding: 10px 0;
	background: #E8E8E8;
	position: relative;/* esto da a IE6 el parámetro hasLayout para borrar correctamente */
	clear: both; /* esta propiedad de borrado fuerza a .container a conocer dónde terminan las columnas y a contenerlas */
	border-radius: 0px 0px 10px 10px;
}

/*Compatibilidad con HTML 5: define nuevas etiquetas HTML 5 como display:block para que los navegadores sepan cómo procesar las etiquetas correctamente. */
header, section, footer, aside, nav, article, figure {
	display: block;
}
-->
</style><!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script>
var hay=0;
function chi(i,c,v){
	if(hay==0){
		document.dest.act.value="actual";
		document.dest.id.value=i;
		document.dest.cam.value=c;
		document.getElementById(c+i).innerHTML='<input type="text" name="val" value="'+v+'" onBlur="document.dest.submit();">';
		hay=1;
	}else{
		hay=0;
		document.dest.submit();
	}
}
function del_des(i,n){
	if(confirm('¿Estas seguro de eliminar a '+n+' de la Lista de Distribución?')){
		document.dest.act.value="del";
		document.dest.id.value=i;
		document.dest.submit();
	}
}
function cd(c){
	document.getElementById('ndes').innerHTML="";
	for(i=1;i<=c;i++) document.getElementById('ndes').innerHTML+="<tr><td><input type='text' name='nombre"+i+"'></td><td><input type='text' name='apellidos"+i+"'></td><td><input type='text' name='cargo"+i+"'></td><td><input type='text' name='empresa"+i+"'></td><td><input type='text' name='correo"+i+"'></td></tr>\n";
}
</script></head>

<body>

<div class="container">
  <header>
    <a href="#"><img src="image/logoW3D.jpg" alt="Insertar logotipo aquí" width="180" height="90" id="Insert_logo" style="background: #C6D580; display:block;" /></a>
  </header>
  <div class="sidebar1">
    <nav>
      <? if($_SESSION["mailer"]=="activo"){?>
      <ul>
        <li><a href="envio.php">Enviar Masivo</a></li>
        <li><a href="lista.php">Administrar Listas de Distribuci&oacute;n</a></li>        <li><a href="image.php">Gestor de Imagenes</a></li>
<li><a href="usuario.php">Administrar Usuarios</a></li>
        <li><a href="sess.php?act=end">Cerrar Sesi&oacute;n</a></li>
      </ul>
      <? } ?>
    </nav>
    <aside>
<p><br><br><br></p>
    </aside>
  <!-- end .sidebar1 --></div>
  <article class="content">
    <h1>Mailer W3D</h1>
    <section>
    <? $l=mysql_fetch_array(mysql_query("select * from listas where id = $_POST[id_ld]")); ?>
     <h2>Administrar Destinatarios de <?=$l["lista"]?></h2>
      <? $de=mysql_query("select * from destinatarios where id_ld = $_POST[id_ld] order by correo");
	  if(mysql_num_rows($de)==0 && !$_POST["nd"]){ ?>
      <p>No existen destinatarios para esta lista de Distribuci&oacute;n</p>
      <? }else { ?>
      <p>
      <form name="dest" method="post">
      <input type="hidden" name="act" value="">
      <input type="hidden" name="id_ld" value="<?=$_POST["id_ld"]?>">
      <input type="hidden" name="id">
      <input type="hidden" name="cam">
      <table width="100%">
      <tr><th>Nombre</th><th>Apellidos</th><th>Cargo</th><th>Empresa</th><th>Correo Electr&oacute;nico</th><th>Opciones</th></tr>
      <? while($d=mysql_fetch_array($de)){ ?>
      <tr style="cursor:hand; cursor:pointer;" title="Da click para Editar">
      <td id="nombre<?=$d["id"]?>"><span onClick="chi('<?=$d["id"]?>','nombre','<?=$d["nombre"]?>')"><?=$d["nombre"]?>&nbsp;</span></td>
      <td id="apellidos<?=$d["id"]?>"><span onClick="chi('<?=$d["id"]?>','apellidos','<?=$d["apellidos"]?>')"><?=$d["apellidos"]?>&nbsp;</span></td>
      <td id="cargo<?=$d["id"]?>"><span onClick="chi('<?=$d["id"]?>','cargo','<?=$d["cargo"]?>')"><?=$d["cargo"]?>&nbsp;</span></td>
      <td id="empresa<?=$d["id"]?>"><span onClick="chi('<?=$d["id"]?>','empresa','<?=$d["empresa"]?>')"><?=$d["empresa"]?>&nbsp;</span></td>
      <td id="correo<?=$d["id"]?>"><span onClick="chi('<?=$d["id"]?>','correo','<?=$d["correo"]?>')"><?=$d["correo"]?>&nbsp;</span></td>
      <td><input type="button" value="Eliminar" title="Eliminar destinatario" onClick="del_des('<?=$d["id"]?>','<?="$d[nombre] $d[apellidos]"?>')"></td></tr>
      <? } ?>
      </table>
      </form>
      </p>
      <? } ?>
    </section>
    <section>
    <h3>Agregar Destinatarios</h3>
    <p>
    <form name="add" method="post">
    <input type="hidden" name="act" value="add">
    <input type="hidden" name="id_ld" value="<?=$_POST["id_ld"]?>">
    <select name="nd" onChange="cd(this.value)">
    	<option value="">Selecciona la cantidad</option>
        <? for($i=1;$i<=(350-mysql_num_rows($de));$i++) echo "<option value='$i'>$i</option>"; ?>
    </select>
      <table width="100%">
      <tr><th>Nombre</th><th>Apellidos</th><th>Cargo</th><th>Empresa</th><th>Correo Electr&oacute;nico</th></tr>
      <table>
      <table width="100" id="ndes">
      </table>
      <table width="100">
      <tr><td colspan="6" align="center"><input type="submit" value="Agregar Destinatarios"></td></tr>
      </table>
    </form>
    <? if($_POST["nd"]) echo "<script> document.add.nd.value=\"$_POST[nd]\"; cd('$_POST[nd]'); </script>"; ?>
    </p>
    </section>
    <!-- end .content --></article>
  <footer>
    <p>Desarrollado por W3D</p>
    <address>
     
    </address>
  </footer>
<!-- end .container --></div>
</body>
</html>