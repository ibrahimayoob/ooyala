<?php

  require_once 'sdk/OoyalaApi.php';

  header('Content-type: text/plain');
  
  //security - anyone can modify title once they know the url to this script
  //todo     - only allow authorised requests

  $title = $_GET['videotitle'];
  if($title === "" || $title === false || $title === null || empty($title)) 
  {     
    echo "empty title given";
    exit();
  }
  
  // dirty - keys should not be exposed  
  $api = new OoyalaApi("ZzcTMyOuDOdGDu3v1-rBTsPtL2wW.LN1Ce", "t8Vq02Y6XuTHDIo68GXB0TfR7NlPo9XBKB0PfJ7k");
  
  $parameters = array("name" => $title);
  $results = $api->patch("assets/5meW03bjoqTol7A177tuKqZtvw7Sr5EB", $parameters);
  $asset = get_object_vars($results); 
  
  print_r("$asset \n\n");        
  var_dump($results);  

  echo (json_encode($results));

?>

