<?php

/**
* 
*/
class Demo
{
   
}

function __autoload($className) {
    echo 222222;
  $filepath = './' . strtolower($className) . '.class.php';
  if (file_exists($filepath)) {
    include $filepath;
  } else {
    echo 'Class(' .$className. ') Not Found';
  }
  //include "./".strtolower($className).".class.php";
}
  
new Demo(); 

echo 1;