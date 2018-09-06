;<?php die(''); ?>
;for security reasons , don't remove or modify the first line

;Services
;list the different map services (servers, generic parameters, etc.)
[services]
wmsServerURL="http://127.0.0.1/cgi-bin/qgis_mapserv.fcgi"
;List of URL available for the web client
onlyMaps=off
defaultRepository=montpellier
cacheStorageType=file
;cacheStorageType=sqlite => store cached images in one sqlite file per repo/project/layer
;cacheStorageType=file => store cached images in one folder per repo/project/layer. The root folder is /tmp/
cacheRedisHost=localhost
cacheRedisPort=6379
cacheExpiration=0
; default cache expiration : the default time to live of data, in seconds.
; 0 means no expiration, max : 2592000 seconds (30 days)
proxyMethod=php
; php -> use the built in file_get_contents method
; curl-> use curl. It must be installed.
debugMode=1
; debug mode
; on = print debug messages in lizmap/var/log/messages.log
; off = no lizmap debug messages
cacheRootDirectory="/tmp/"
; cache root directory where cache files will be stored
; must be writable
allowUserAccountRequests=off

; path to find repositories
; rootRepositories="path"


appName=Lizmap
qgisServerVersion=2.18
wmsMaxWidth=3000
wmsMaxHeight=3000
[repository:montpellier]
label=Demo
path="../install/qgis/"
allowUserDefinedThemes=1
[repository:intranet]
label="Demo - Intranet"
path="../install/qgis_intranet/"
allowUserDefinedThemes=


[theme]
headerLogo=blason_invert_colors_small.png
headerLogoWidth=88


