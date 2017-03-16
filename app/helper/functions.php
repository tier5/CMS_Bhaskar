<?php 
/*function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function browser_name()
{
	$browser=get_browser();
	return $browser->browser;
}

function browser_platform()
{
	$browser=get_browser();
	return $browser->platform;
}

function browser_version()
{
	$browser=get_browser();
	return $browser->version;
}*/