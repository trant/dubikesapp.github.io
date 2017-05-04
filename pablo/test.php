
<?php 

include('lib/httpful.phar');
echo \Httpful\Request::get('http://api.citybik.es/dublinbikes.json')->send();

 ?>