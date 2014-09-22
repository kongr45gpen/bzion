<?php
require_once __DIR__ . '/bzion-load.php';

use BZIon\Session\DatabaseSessionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Security\Core\Util\SecureRandom;



$generator = new SecureRandom();
$random = bin2hex($generator->nextBytes(4));

function d($msg) {
    global $random;

    $formatter = new Symfony\Component\Console\Formatter\OutputFormatter(1);

    $file_handler = fopen(__DIR__.'/log', 'a');

    $wr =  date("Y-m-d H:i:s") . " :: $random :: $msg\n";

    fwrite($file_handler, $formatter->format($wr));
    fclose($file_handler);

}

d("<bg=green;options=bold>Accepting request</>");

$request = Request::createFromGlobals();

$kernel = new AppKernel(AppKernel::guessEnvironment(), DEVELOPMENT > 0);
$kernel->boot();


if (ENABLE_WEBSOCKET) {
    // Ratchet doesn't support PHP's native session storage, so use our own
    // if we need it
    $storage = new NativeSessionStorage(array(), new DatabaseSessionHandler());
    $session = new Session($storage);
    Service::getContainer()->set('session', $session);
}

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
