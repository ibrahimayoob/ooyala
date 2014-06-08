<?php

  require_once 'sdk/OoyalaApi.php';

  //header('Content-type: application/json');
  header('Content-type: text/plain');

  //$op_result = 0;
  //$op_msg;
  //$op_videoname;
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
    //$op_result=1;
    $response[0]['op_result'] = 1;
    //$op_msg = $e->getMessage();
    $response[0]['op_msg'] = $e->getMessage(); 
  }

  
  $assets = $results->items;  
  // results might be empty even if there was no exception raised
  if(empty($assets)==true && $response[0]['op_result']==0) {
    //$op_result = 1;
    $response[0]['op_result'] = 1;
    //$op_msg = "Nothing returned from Backlot API";
    $response[0]['op_msg'] = "Nothing returned from Backlot API";  
  }  
  
  if($response[0]['op_result']==0) {
    foreach($assets as $asset) {       
        //$asset_array = get_object_vars($asset);
        //$asset_array['op_result'] = $op_result;
        //$asset_array['op_msg'] = $op_msg;
        $response[0]['op_videoname'] = $asset->name;        
        
        //echo (json_encode(array_values($asset_array)));                        
        //echo (json_encode($response));
        print($response[0]['op_videoname']); 
    }  
  }
  else {        
        /*
        $asset['op_result'] = $op_result;
        $asset['op_msg'] = $op_msg;        
        echo json_encode($asset,JSON_PRETTY_PRINT);
        */
        //echo (json_encode($response));
        print("");
  } 
    
  //var_dump($response);
  //echo (json_encode($results));

?>

