<?php
//Define what IPs should be "let through" the false maintenance (wildcards supported)
$allow = array("123.456.789.0", "123.456.789.0", "123.456.*.*");

if(!in_array($_SERVER['REMOTE_ADDR'], $allow) && !in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $allow)) {

  //Define time for auto-retries in seconds
	$retry = 3600 * 24; // = 24hrs
	
	//Define status code to return, e.g. "503 Service Unavailable"
	header("HTTP/1.1 200 OK");
	
	header("Retry-After: $retry");
	
	//Output content in html
	echo "HTCPCP/1.0 418 I'm a teapot<html>
    <head>
      <style type='text/css'>*{text-shadow:0px 1px 0px #cfcfcf;background:#999;color:#393939;}</style>
      <title>418 I'm a teapot</title>
    </head>
    <body>
      <h1>I'm a teapot</h1>
      <p>Unfortunately this coffee machine is out of coffee.</p>
    </body>
    </html>";
    
  //Finish the fun
	exit();
}
