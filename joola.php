<?php

class Joola
{
    var $endpoint;
    var $apiKey;

    function __construct($endpoint, $apiKey)
    {
        $version = @file_get_contents($endpoint . '/system/version?APIToken=' . $apiKey);
        if ($version === FALSE) {
            throw new exception('Could not reach the joola server, check your endpoint and API Key');
        }
        $this->endpoint = $endpoint;
        $this->apiKey = $apiKey;
    }

    function pushDocument($workspace, $collection, $document)
    {
        $result = Array('error' => false, 'response' => null);
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode($document)
            )
        ));

        $response = @file_get_contents($this->endpoint . "/beacon/" . $workspace . "/" . $collection . "?APIToken=" . $this->apiKey, FALSE, $context);

        if ($response === FALSE) {
            $result['error'] = true;
            return $result;
        }

        $responseData = json_decode($response, TRUE);
        $result['response'] = $responseData;
        return $result;
    }

    function query($query)
    {
        $result = Array('error' => false, 'response' => null);
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode($query)
            )
        ));

        $response = @file_get_contents($this->endpoint . "/query?APIToken=" . $this->apiKey, FALSE, $context);

        if ($response === FALSE) {
            $result['error'] = true;
            return $result;
        }

        $responseData = json_decode($response, TRUE);
        $result['response'] = $responseData;
        return $result;
    }

    function generateToken()
    {

    }

}

?>