<?php
include('lib/httpful.phar');
header('Content-type: application/json');
$cartoUri = 'http://www.dublinbikes.ie/service/carto';
$detailUri = 'http://www.dublinbikes.ie/service/stationdetails/dublin/';
$stations = \Httpful\Request::get($cartoUri)  // Will parse based on Content-Type
    ->expectsXml()              // from the response, but can specify
    ->send(); 
$idx = 0;
echo "[";
foreach($stations->body->markers->marker as $station)
{
	if ($id > 0)
	{
	echo ",";
	}
	$attributes = $station->attributes();
	$id = $attributes['number'];
	$stationName = $attributes['name'];
	$lat = $attributes['lat'];
	$long = $attributes['lng'];
	$details = \Httpful\Request::get($detailUri.$id)
		->expectsXml()
		->send(); 
	$data = $details->body;
	$epoch = $data->updated; 
	$dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
	
	echo'{
    "bikes": '.$data->available.',
    "name": "'.$stationName.'",
    "idx": '.$idx.',
    "lat": '.$lat.',
    "timestamp": "'.$dt->format('c').'",
    "lng": '.$long.',
    "id": '.$id.',
    "free": '.$data->free.',
    "number": '.$data->total.'
}';
$idx++;
}
echo "]";