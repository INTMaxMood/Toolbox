<?php
/*
 * Simple PHP obfuscator/encoder v1.0
 * - Recons
 * 
 * First arg is file to encode
 * Second arg is output file
 */
if($argc < 3) die("Usage: {$argv[0]} input output");
$data = file_get_contents($argv[1]);
$data = "?>".$data;
$data = str_rot13($data);
$data = base64_encode($data);
$data = "<?php eval(str_rot13(base64_decode('$data'))); ?>";
file_put_contents($argv[2], $data);
echo "Done.";
?>