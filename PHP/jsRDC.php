<?php
if (!array_key_exists('PHP_ENV', $_SERVER))
  $_SERVER['PHP_ENV'] = 'unknown';

class jsRDC {
  const SERVER = 'http://jsrdc.herokuapp.com';

  public static function send($message, $type = 'log') {
    $data = array(
      'cmd'   => $type,
      'data'  => urlencode("<span class='magenta'>{$_SERVER['PHP_ENV']}:</span> {$message}")
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

  public static function info($message) {
    self::send($message, 'info');
  }

  public static function warn($message) {
    self::send($message, 'warn');
  }

  public static function dump($obj) {
    self::send(json_encode($obj), 'dump');
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
