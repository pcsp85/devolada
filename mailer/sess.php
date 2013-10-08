<? include("config.php");
if($_POST){
	$se=mysql_query("select * from usuarios where user = '$_POST[user]' and pass = md5('$_POST[pass]')");
	if(mysql_num_rows($se)==1){
		$s=mysql_fetch_array($se);
		$_SESSION["mailer"]="activo";
		$_SESSION["usr"]=$s["id"];
		mysql_query("update usuarios set uis = UNIX_TIMESTAMP() where id = $s[id]");
	}else $_SESSION["mailer"]="Fallo Inicio de Sessión verifica usuario y contraseña";
}elseif($_GET["act"]=="end") session_destroy();
header("Location: ./");
?>