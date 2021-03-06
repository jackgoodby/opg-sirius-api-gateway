<?php
include_once '../vendor/autoload.php';

use Aws\Credentials\Credentials;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Aws\Signature\SignatureV4;


$access_key = 'XXXXXXXXXXXXXXXXXXXXX';
$secret_key = 'XXXXXXXXXXXXXXXXXXXXX';


$request = new Request('GET', 'https://api.dev.sirius.opg.digital/v1/lpa-online-tool/lpas/A15423875412');


$credentials = new Credentials($access_key, $secret_key);


$s4 = new SignatureV4('execute-api', 'eu-west-1');


$signed_request = $s4->signRequest($request, $credentials);


try {

    $response = (new Client)->send($signed_request);
    echo $response->getBody()."\n\n";

} catch (\GuzzleHttp\Exception\ClientException $e) {
    echo $e->getResponse()->getBody()."\n";
} catch (\Exception $e) {
    echo $e->getMessage();
} catch (\TypeError $e) {
    echo $e->getMessage();
}
