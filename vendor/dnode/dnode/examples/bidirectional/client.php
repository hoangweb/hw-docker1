<?php
// Include Composer-generated autoloader
require(__DIR__.'/../../vendor/.composer/autoload.php');

// This is the class we're exposing to DNode
class Temp
{
    // Compute the client's temperature and stuff that value into the callback
    public function temperature($cb)
    {
        $degC = rand(-20, 50);
        echo "{$degC}° C\n";
        $cb($degC);
    }
}

$dnode = new DNode\DNode(new Temp());
$dnode->connect(6060, function($remote, $connection) {
    // Ask server for temperature in Fahrenheit
    $remote->clientTempF(function($degF) use ($connection) {
        echo "{$degF}° F\n";
        // Close the connection
        $connection->end();
    });
});
