<?php 

function getSession() { 
    $data['email'] = '';
    $data['token'] = '';

    $data = http_build_query($data);

    $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $xml = curl_exec($curl);

    if ( $xml == 'Unauthorized' ) {
        echo "Unauthorized";
        exit;
    }

    curl_close($curl);

    $xml = simplexml_load_string($xml);

    if (count($xml->error) > 0) {
        echo "error";

        var_dump($xml->error);

        exit;
    }

    echo $xml->code;
}