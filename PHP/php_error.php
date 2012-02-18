<?php
$_SERVER['PHP_ENV'] = 'jsRDC-DEV';

require 'jsRDC.php';

$rand = (rand() % 10);
switch ($rand) {
  case 0:
    echo $a;
    break;
  case 1:
    jsRDC::info('ez egy egyedi tesztuzenet ^_^');
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
    jsRDC::dump(array('tomb elso elem', 'tomb masodik elem', 'harmadik elem'));
    break;
  case 9:
    $c = 10;
    $c = $c/0;
    break;
  default:
    echo "no error";
    break;
}
