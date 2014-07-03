<?php
$username = $_REQUEST["username"];
$ip       = $_REQUEST["ip"];
$domain   = $_REQUEST["domain"];

echo("
screen mode id:i:2
use multimon:i:0
desktopwidth:i:1280
desktopheight:i:1024
session bpp:i:15
winposstr:s:0,1,2106,126,2933,846
compression:i:1
keyboardhook:i:2
audiocapturemode:i:0
videoplaybackmode:i:1
connection type:i:1
displayconnectionbar:i:1
disable wallpaper:i:1
allow font smoothing:i:0
allow desktop composition:i:0
disable full window drag:i:1
disable menu anims:i:1
disable themes:i:1
disable cursor setting:i:0
bitmapcachepersistenable:i:0
full address:s:$ip
audiomode:i:1
redirectprinters:i:0
redirectcomports:i:0
redirectsmartcards:i:0
redirectclipboard:i:1
redirectposdevices:i:0
redirectdirectx:i:1
autoreconnection enabled:i:1
authentication level:i:0
prompt for credentials:i:0
negotiate security layer:i:1
remoteapplicationmode:i:0
alternate shell:s:
shell working directory:s:
gatewayhostname:s:
gatewayusagemethod:i:4
gatewaycredentialssource:i:4
gatewayprofileusagemethod:i:1
promptcredentialonce:i:1
use redirection server name:i:0
drivestoredirect:s:
networkautodetect:i:0
bandwidthautodetect:i:1
enableworkspacereconnect:i:0
rdgiskdcproxy:i:0
kdcproxyname:s:
username:s:$domain\\$username
");