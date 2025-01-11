<?php
 $PublicIP = getenv('HTTP_FORWARDED_FOR');
 $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$PublicIP"));
 $PublicIP = $geo["geoplugin_request"];
 $country = $geo["geoplugin_countryName"];
 $city = $geo["geoplugin_city"];
 $region = $geo["geoplugin_region"];
 
 $ip_address = $PublicIP;
 $ip_location = $region.', '.$city.', '.$country;
?>