<?php
class jsRDC {
  const SERVER = 'http://localhost:3000';
  
  public static function send($message, $type = 'log') {
    $data = array(
      'cmd'   => $type,
      'data'  => urlencode($message)
    );
    
    $ch = curl_init();
    $options = array(
      CURLOPT_URL             => self::SERVER."/msg",
      CURLOPT_HEADER          => true,
      CURLOPT_NOBODY          => true,
      CURLOPT_RETURNTRANSFER  => true,
      CURLOPT_POSTFIELDS      => $data
    );
    curl_setopt_array($ch, $options);
    curl_exec($ch);
    curl_close($ch);
  }
}

function jsRDC_error_handler($number, $message, $file, $line, $vars) {
  $color = 'red';
  $type = 'error';
  if (($number === E_NOTICE) || ($number >= 2048)) {
    $color = 'yellow';
    $type = 'notice';
  }

  $message = <<<EOF
An error (<span class='cyan'>errno:</span><span class='cyan bold'>{$number}</span>) occured in the file
<span class='{$color} bold'>{$file}</span>
on line
<span class='{$color} bold'>{$line}</span>
=> <span class='{$color} bold'>{$message}</span>
EOF;

  jsRDC::send($message, $type);
}

function jsRDC_exception_handler($e) {
  $color  = 'magenta';
  $type   = 'exception';
  $msg    = $e->getMessage();

  $message = <<<EOF
Uncaught exception: <span class='{$color}'>{$msg}</span>
EOF;

  jsRDC::send($message, $type);
}

set_error_handler('jsRDC_error_handler');
set_exception_handler('jsRDC_exception_handler');

echo "Random error generator<br />\n";

$rand = (rand() % 10);
switch ($rand) {
  case 0:
    echo $a;
    break;
  case 1:
    $c = NICE_CONST;
    break;
  case 2:
    $c = $_POST['apple']['pear'];
    break;
  case 3:
    $c = array_merge(1, 2);
    break;
  case 4:
    $c = join();
    break;
  case 5:
    $c = array();
    $c->myVariable;
    break;
  case 6:
    throw new Exception("Error Processing Request", 1);
    break;
  case 7:
    $b = null;
    foreach($b as $c) {
      echo "ok";
    }
    break;
  case 8:
    $a = array();
    $b = $a['omg'];
    break;
  case 9:
    $c = 10;
    $c = $c/0;
    break;
  default:
    echo "no error";
    break;
}
die('error generated');