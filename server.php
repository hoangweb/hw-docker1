<?php
require __DIR__. '/vendor/autoload.php';

$port = $port = getenv('PORT')? getenv('PORT'): 2020;//33636,63,443,8000
$interval = 10;	//10s

$loop = React\EventLoop\Factory::create();
$server = new React\Socket\Server('0.0.0.0'. ":$port", $loop);//:10.129.149.105

/**
 * Listen for a event
 */
$server->on('connection', function ($conn) use($server) {
	$address = $conn->getRemoteAddress();
	echo 'Connection with ' . $address . PHP_EOL;

	$conn->on('data', function ($data) use ($conn, $server) {
		$dt = json_decode($data, true);	//parse data
		$conn->close();
		print_r($dt);

		//if(empty($dt['task']) || empty($dt['domain'])) return;  //invalid argument

		//heavy task
		echo 'heavy task process';
	});
});
$server->on('error', function($error){
	printf($error);
	shutdown();
});

/**
 * Periodic Timer
 */
/*$i = 0;
$loop->addPeriodicTimer($interval, function(React\EventLoop\Timer\Timer $timer) use (&$i, $loop) {
    echo ++$i, PHP_EOL;
    if ($i >= 15) {
        $loop->cancelTimer($timer);
    }
});
*/
function shutdown()
{
	echo 'crashed!';	
}
register_shutdown_function('shutdown');

echo 'Listening on ' . $server->getAddress() .' port: '.$port. PHP_EOL;
$loop->run();
