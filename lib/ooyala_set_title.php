<?php

  require_once 'sdk/OoyalaApi.php';

  header('Content-type: text/plain');

  $title = $_GET['videotitle'];
  if($title === "" || $title === false || $title === null || empty($title)) 
  {     
    echo "empty title given";
    exit();
  }
  
  
  
  $api = new OoyalaApi("ZzcTMyOuDOdGDu3v1-rBTsPtL2wW.LN1Ce", "t8Vq02Y6XuTHDIo68GXB0TfR7NlPo9XBKB0PfJ7k");
  
  $parameters = array("name" => $title);
  $results = $api->patch("assets/5meW03bjoqTol7A177tuKqZtvw7Sr5EB", $parameters);  
  //$assets = $results->items;
  $asset = get_object_vars($results); 
  
  
  echo "Dump video details: \n\n";
  //  foreach($assets as $asset) {
        //print_r("$results \n\n");                
        print_r("$asset \n\n");        
        var_dump($results);
  //}  

  echo (json_encode($results));

?>

