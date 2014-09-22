<?php

$cj = 'cookiejart';
$cf = 'cookiefile';

unlink($cj);touch($cj);
unlink($cf);touch($cf);


for($i = 1; true; $i++){
    $a = 0;

    echo "Try $i";

    $site = req("http://localhost/bzion/login/autoreport");
    echo ".";
    // prof($site);

    chk($site);

    $site = req("http://localhost/bzion/logout");
    echo ".";
    if (strpos($site, 'logged out su') === FALSE) {
        echo "\nNLO\n";
        die();
    }
    // prof($site);
    $site = req("http://localhost/bzion/login/autoreport");
    echo ".";
    // prof($site);

    chk($site);

    echo "\n";
}

function req($url) {
    global $cf, $cj, $i, $a;

    $ch =  curl_init();
    curl_setopt( $ch, CURLOPT_COOKIESESSION, true );
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cj );
    curl_setopt( $ch, CURLOPT_COOKIEFILE, $cf );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_ENCODING, '');

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Host: localhost',
'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:32.0) Gecko/20100101 Firefox/32.0',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
'Accept-Language: en-US,en;q=0.5',
'Accept-Encoding: gzip, deflate',
'Referer: http://localhost/bzion/',
'Connection: keep-alive',
'Cache-Control: max-age=0'
    ));

    curl_setopt( $ch, CURLOPT_URL, $url );

    $site = curl_exec( $ch );
            curl_close( $ch );


    $time = floor(mt_rand() / mt_getrandmax() * 4 *10)/10;

    echo "\rTry #$i.$a (sleep $time s)";
    usleep($time*1000000);

    $a++;

    return $site;
}

function prof($site) {
    $france = "',            function(xhr, el)";
    $britain = "            '";

    $site = explode($france, $site);
    $site = $site[0];
    $site = explode($britain, $site);
    $site = end($site);

    $r = req("http://localhost$site");
}

function chk($site) {
    if (strpos($site, 'anonymous') !== FALSE) {
        echo "\nFAIL!\n";
        die();
    } elseif (strpos($site, 'logged in as AutoReport') === FALSE) {
        echo "\n?????\n";

        echo $site;
        die();
    }
}
