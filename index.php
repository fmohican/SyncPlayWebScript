<?php
$action = @$_GET['action'];
if($action == "delete"){
  $da = @$_GET['file'];
  unlink($da);
  header("Location: index.php?action=success");
}
function by2hum($bytes) {
    $symbols = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $exp = floor(log($bytes)/log(1024));

    return sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
}
function listfl() {
  $thelist= "";
  if($handle = opendir('.')) {
      while (false !== ($file = readdir($handle)))
      {
          if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'mkv' or strtolower(substr($file, strrpos($file, '.') + 1)) == 'mp4')
          {
            if($_SERVER['SERVER_PORT'] == 443)
              $thelist .= "https://".$_SERVER['HTTP_HOST']."/".rawurlencode($file)."<br/>";
            else
              $thelist .= "http://".$_SERVER['HTTP_HOST']."/".rawurlencode($file)."<br/>";
          }
      }
      return $thelist;
      closedir($handle);
  }
}
function listf() {
  $thelist= "<blockquote>";
  if($handle = opendir('.')) {
      while (false !== ($file = readdir($handle)))
      {
          if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'mkv' || strtolower(substr($file, strrpos($file, '.') + 1)) == 'mp4')
          {
              $thelist .= "<p>".$file."<a href='index.php?action=delete&file=$file' style='color: #2196f3;text-decoration:none;font-weight:bold;float:right;'>Delete</a></p>";
          }
      }
      $thelist .= "<footer>This file was detected in your current directoiry</footer></blockquote><hr/>";
      return $thelist;
      closedir($handle);
  }
}
function left() {
$dsk = "F:";
$data = "<address style='float:right;color:#c62828;'><strong>Server Information:</strong><br/>
Available Disk Space: ".by2hum(disk_free_space($dsk))."/".by2hum(disk_total_space($dsk))."<br/>
Server Port: ".$_SERVER['SERVER_PORT']."<br/>
Server Address : ".$_SERVER['SERVER_ADDR']."<br/>
Client Address : ".$_SERVER['REMOTE_ADDR']."<br/>
<strong>Maded with &#10084; in România</span>";
echo $data;
}
?>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      <title> Simple Index of Your SyncPlayer </title>
      <link href="asset/css/bootstrap.min.css" rel="stylesheet">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="asset/js/clipboard.min.js"></script>
      <script src="asset/js/bootstrap.min.js"></script>
      <style>
      body {
        padding: 10px;
      }
      #alert {
        position:fixed;
        display:block;
        top:10%;
        text-align: center;
        text-align: -webkit-center;
        width:100%;
      }
      .alert {
          width: 40%;
      }
      blockquote {
          font-size: 14.5px;
          border-left: 4px double #c62828;
      }
      hr {
          padding: 0;
          border: none;
          border-top: medium double #c62828;
          color: #c62828;
          text-align: center;
      }
      hr:after {
          content: "§";
          display: inline-block;
          position: relative;
          top: -0.7em;
          font-size: 1.5em;
          padding: 0 0.25em;
          background: white;
      }
      .well {
        word-break: break-all;
      }
      </style>
    </head>
    <body>
      <script>
$.fn.extend({
    toggleText: function(a, b){
        return this.text(this.text() == b ? a : b);
    }
});

var clipboard = new Clipboard('.btn');

clipboard.on('success', function(e) {
  $( "button" ).fadeToggle( 250, function() {
    $(this).toggleClass("btn-success").toggleText( "Copy To Clipboard", "Data was copyed to clipboard!").fadeIn('slow');
  });
  e.clearSelection();
});
      </script>
<h1 style="text-align:center; color:#c62828;">SyncPlayer HTTP Generator</h1><hr/>
<?php
if($action == "success")
  echo '<div id="alert"><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> File was deleted success fully</div></div>';
echo listf();
echo "<h1 style='text-align:center; color:#c62828;'>Code for SyncPlayer</h1><br/><div class='well well-lg' id='target'>".listfl()."</div><br/><button class='btn btn-lg btn-block' data-clipboard-action='copy' data-clipboard-target='#target'>Copy To Clipboard</button><hr/>";
left();
?>
  </body>
</html>
