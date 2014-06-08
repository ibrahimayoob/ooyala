<?php

  require_once 'sdk/OoyalaApi.php';
  
  header('Content-type: text/plain');

  $results;  
  $response = array();
  
  $response[0]['op_result'] = 0;
  $response[0]['op_msg'] = "";
  $response[0]['op_videoname'] = "";

  try {
    $api = new OoyalaApi("ZzcTMyOuDOdGDu3v1-rBTsPtL2wW.LN1Ce", "t8Vq02Y6XuTHDIo68GXB0TfR7NlPo9XBKB0PfJ7k");
    $parameters = array("where" => "embed_code = '5meW03bjoqTol7A177tuKqZtvw7Sr5EB'",
                        "expires" => time());
    $results = $api->get("assets", $parameters);    
  } catch (Exception $e) {
    $response[0]['op_result'] = 1;
    $response[0]['op_msg'] = $e->getMessage(); 
  }

  
  $assets = $results->items;  
  // results might be empty even if there was no exception raised
  if(empty($assets)==true && $response[0]['op_result']==0) {
    $response[0]['op_result'] = 1;
    $response[0]['op_msg'] = "Nothing returned from Backlot API";  
  }  
  
  if($response[0]['op_result']==0) {
    foreach($assets as $asset) {
        $response[0]['op_videoname'] = $asset->name;
        print($response[0]['op_videoname']); 
    }  
  }
  else {
        print("");
  }
?>

