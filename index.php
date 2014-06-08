<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Ooyala code challenge">

    <title>Ooyala Code Challenge</title>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
    <link rel="stylesheet" href="//yui.yahooapis.com/pure/0.5.0/pure-min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--[if lte IE 8]> <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css"> <![endif]-->
    <!--[if gt IE 8]><!--> <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css"> <!--<![endif]-->
    <!--[if lte IE 8]> <link rel="stylesheet" href="style-old-ie.css"> <![endif]-->
    <!--[if gt IE 8]><!--> <link rel="stylesheet" href="css/style.css"> <!--<![endif]-->

</head>
<body>


<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <hgroup>
                <h1 class="brand-title">Ooyala</h1>
                <h2 class="brand-tagline">Code Challenge</h2>
            </hgroup>

            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="pure-button" href="http://ooyala.digitalinternals.com/index.php">Video 1</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <!-- A wrapper for all the blog posts -->
            <div class="posts">
                <h1 class="content-subhead">Video</h1>

                <!-- A single blog post -->
                <section class="post">
                  <header class="post-header">
                        <h2 class="post-title">Player API</h2>                        
                    
                  </header>                                                                
                        
                        <script src='//player.ooyala.com/v3/b8636d8161f242fc8e5edc17f8852da4'></script>
                        <div id='ooyalaplayer' style='width:300px;height:168px'></div>
<script>

  var oplayer = null;

//OO.ready(function() { OO.Player.create('ooyalaplayer', '1vbGs3bjpYwNSy0Tlib2O0PrUR3JQLKZ'); });
OO.ready(function() { 

    oplayer = OO.Player.create('ooyalaplayer', '5meW03bjoqTol7A177tuKqZtvw7Sr5EB', {      
      onCreate: function(player) {    
    
      player.mb.subscribe('*','myPage', function(eventName) {
        console.log("EVENT: "+eventName);
      });
      
      player.mb.subscribe("error", "test-plugin", function(eventName, payload) {
        console.log(eventName+": "+payload);
      });    
    
      player.mb.subscribe(OO.EVENTS.PLAYER_CREATED, 'keynote', function() 
      { $("#of_eventlog").append("PLAYER_CREATED\n"); });
      
      /*
      player.mb.subscribe(OO.EVENTS.PLAYBACK_READY, 'keynote', function() 
      { $("#of_eventlog").append("PLAYBACK_READY\n"); alert("event_playbackready - title:"+player.getTitle()); });
      */
      
      player.mb.subscribe(OO.EVENTS.BUFFERING, 'keynote', function() 
      { $("#of_eventlog").append("BUFFERING\n"); scrollEventLog(); });
      
      player.mb.subscribe(OO.EVENTS.BUFFERED, 'keynote', function() 
      { $("#of_eventlog").append("BUFFERED\n"); scrollEventLog(); });
      
      player.mb.subscribe(OO.EVENTS.PLAYING, 'keynote', function() 
      { $("#of_eventlog").append("PLAYING\n"); scrollEventLog(); });     
                                                        
      player.mb.subscribe(OO.EVENTS.PAUSED, 'keynote', function() 
      { $("#of_eventlog").append("PAUSED\n"); scrollEventLog(); }); 
      
      player.mb.subscribe(OO.EVENTS.VOLUME_CHANGED, 'keynote', function() 
      { $("#of_eventlog").append("VOLUME_CHANGED\n"); scrollEventLog(); });
      
      player.mb.subscribe(OO.EVENTS.VOLUME_CHANGED, 'keynote', function() 
      { $("#of_eventlog").append("VOLUME_CHANGED\n"); scrollEventLog(); });
      
      player.mb.subscribe('bitrateInfoAvailable', 'myPage', function(eventName) {
        var rates = player.getBitratesAvailable();
        var rstr = "";        
        rates.length == 1 ? rstr = rates[0] : rstr = "";
        
        if (rates.length > 1) {
          rstr = "[ ";
          for (var i=0; i < rates.length; i++) {
            rstr += rates[i] + ", "            
          }
          rstr += " ]";          
        }        
        
        $("#of_bitrate").val(rstr);
        
      });      

      // workaround: unable to catch playbackReady event
      player.mb.subscribe('contentTreeFetched', 'myPage', function(eventName) {
        $("#of_videoname").val(player.getTitle());
        $("#of_videodesc").val(player.getDescription());    
      });


/*
      player.mb.subscribe('playbackReady', 'myPage', function(eventName) {
        console.log("inside playbackReady()");
        $("#of_videoname").val(player.getTitle());
        $("#of_videodesc").val(player.getDescription());    
      });
*/      

    
    }
    });
});


function doPlay () {
  console.log("doPlay()"); 
  oplayer.play();
}

function doPause () {
  console.log("doPause()");
  oplayer.pause();  
  
}

function scrollEventLog () {
  var tb = $('#of_eventlog');
            tb.scrollTop(
            tb[0].scrollHeight - tb.height()
            );
}


  // backlot api
  new_videoname="";
  
  
  function success_get_videoname_response (data) {        
    console.log("AJAX get_videoname response:" + data);
    $("#of2_get_videoname").val(data);
  }
  
  function success_set_videoname_response (data) {        
    console.log("AJAX set_videoname response:" + data);
    alert("New video title has been set!")
    
  }
  
  function error_get_videoname_response (jqXHR, textStatus, errorThrown) {
    console.log("AJAX get_videoname: error while getting response");
    alert("Unknown error while retrieving video title");
  }
  
  function error_set_videoname_response (jqXHR, textStatus, errorThrown) {
    console.log("AJAX set_videoname: error while getting response");
    alert("Unknown error while setting video title");
  }  
  
  
  $(document).ready(function()
  {
    $('#button_o2_get_videoname').click(function() {
      // query video title
      url = '/lib/ooyala_query_video.php';
      //$.get(url, function (data) {alert("process response");});
      $.ajax({
        url: url,
        dataType: 'text',
        type: 'GET',
        success: success_get_videoname_response,
        error: error_get_videoname_response 
      });
      
      return false;
    });
    
    $('#button_o2_set_videoname').click(function() {
      // set video title
      new_videoname=$('#of2_set_videoname').val();
      if(new_videoname.length>=1) {
        url = '/lib/ooyala_set_title.php';
        $.ajax({
          url: url,
          dataType: 'text',
          type: 'GET',
          data: "videotitle="+new_videoname,
          success: success_set_videoname_response,
          error: error_set_videoname_response 
        });
      } 
      else {
        alert("Type the new title for the video first!");
      }
      
      return false;
    });
  
  });







</script>
<noscript><div>Please enable Javascript to watch this video</div></noscript>



                        
<form class="ooyala-form pure-form pure-form-aligned">
    <fieldset>
        
    
        <button class="pure-button" onclick="doPlay(); return false;"><i class="fa fa-play"></i> Play</button>        
        <button class="pure-button" onclick="doPause(); return false;"><i class="fa fa-pause"></i> Pause</button>
        
        <p></p>
        
        <div class="pure-control-group">
            <label for="field1">Video Name</label>
            <input id="of_videoname" type="text" placeholder="Video Name">
        </div>       
              
        <div class="pure-control-group">
            <label for="of_videodesc">Video Description</label>
            <input id="of_videodesc" type="text" placeholder="Video Description">
        </div>

        <div class="pure-control-group">
            <label for="of_bitrate">Bitrate</label>
            <input id="of_bitrate" type="text" placeholder="Bitrate">
        </div>

        <div class="pure-control-group">
            <label for="foo">Subscribed Event Logs</label>
            <textarea id="of_eventlog" name="of_output" cols="45" rows="10" tabindex="2"></textarea>
        </div>
            
        
    </fieldset>
</form>

              

          <header class="post-header">
                <h2 class="post-title">Backlot API</h2>
          </header>                  
                
<form class="ooyala-form2 pure-form pure-form-aligned">
    <fieldset>
                       
                                           
        <p></p>
             
        <div class="pure-control-group">            
            <label for="field22">Set Video Name</label>
            <input id="of2_set_videoname" type="text" placeholder="Video Name">&nbsp;<button id="button_o2_set_videoname" class="pure-button"><i class="fa fa-pencil-square"></i> Set video name</button>  
        </div>
        
        <div class="pure-control-group">            
            <label for="field21">Get Video Name</label>
            <input id="of2_get_videoname" type="text" placeholder="Video Name">&nbsp;<button id="button_o2_get_videoname" class="pure-button"><i class="fa fa-refresh"></i> Get video name</button>
        </div>        
        
    </fieldset>
</form>
              <p>Additional logs can be found under console.log</p>
              <p>After changing video title with [Set video name], it takes a while for [Get video name] to retrieve the latest update title.</p>                        
                    
                    
                </section>
            </div>


            <div class="footer">
                <div class="pure-menu pure-menu-horizontal pure-menu-open">
                    <ul>
                        <li><a href="#">Ooyala Code Challenge</a></li>
                        <li><a href="http://github.com/ibrahimayoob/ooyala/">GitHub</a></li>                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
