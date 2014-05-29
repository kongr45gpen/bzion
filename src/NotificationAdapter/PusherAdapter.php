<?php
/**
 * This file contains functionality to communicate with the pusher.com push service
 *
 * @package    BZiON\NotificationAdapters
 * @license    https://github.com/allejo/bzion/blob/master/LICENSE.md GNU General Public License Version 3
 */

/**
 * An interface to the pusher.com service
 * @todo Perform an asynchronous request?
 * @package    BZiON\NotificationAdapters
 */
class PusherAdapter extends NotificationAdapter
{
    /**
     * The Pusher instance
     * @var Pusher
     */
    private $pusher;

    public function __construct()
    {
        // ????!!!???
    }

    /**
     * {@inheritDoc}
     */
    public function trigger($channel, $message)
    {
        $params = json_encode(array(
            'data' => array ('message' => $message),
            'name' => 'main_event',
            'channel' => $channel,
        ));

        $url  = 'http://api.pusherapp.com/apps/' . PUSHER_APP_ID . '/events';
        $par  = 'body_md5=' . md5($params);
        $par .= '&auth_version=1.0';
        $par .= '&auth_key=' . PUSHER_KEY;
        $par .= '&auth_timestamp=' . time();
        $par .= 'auth_signature=' . hash_hmac('sha256', "POST\n$url\n$par", PUSHER_SECRET);

        $time = microtime(true);
        $this->asyncPost("$url?$par", $params);
        file_put_contents(__DIR__ . "/top", " - " . (microtime(true)-$time) . "\n", FILE_APPEND);
    }

    /**
     * {@inheritDoc}
     */
    public static function isEnabled()
    {
        if (!parent::isEnabled())
            return false;

        return (bool) ENABLE_PUSHER;
    }

    /**
     * Perform a POST request without waiting to get a response
     * @param string $url The URL to perform the request on
     * @param string $postString The data to provide to the POST request
     * @return void
     */
    private static function asyncPost($url, $postString=null)
    {
        $parts=parse_url($url);

        $fp = fsockopen('23.22.231.199',
            isset($parts['port'])?$parts['port']:80,
            $errno, $errstr, 30);

        $out = "POST ".$parts['path']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/json\r\n";
        $out.= "Content-Length: ".strlen($postString)."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        if ($postString) $out.= $postString;

        fwrite($fp, $out);
        fclose($fp);
    }
}
