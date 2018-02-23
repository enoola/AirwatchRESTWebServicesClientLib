<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 09/01/2018
 * Time: 10:59
 */

namespace PhPeteur\AirwatchWebservices\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;


class Airwatch
{
    /*
     * Below will represent parameter kinds
     * for each class when function with parameter
     * we'll have name, kind, description
     */
    const PARAM_STRING = 1; //string
    const PARAM_BOOL = 2; //boolean
    const PARAM_INTEGER = 4; //integer
    const PARAM_NUMERIC = 8; //numeric
    const PARAM_DATETIME = 16; //datetime

    private $client;
    protected $httpheaders;
    private $instance_base_uri = null;
    protected $_configfile;

    public function __construct($cfg) {

        $mandatoryinfo = ['aw-tenant-code', 'apikey','instance_fqdn', 'instance_base_uri','username','password' ];
        foreach ($mandatoryinfo as $k => $keyexpected) {
            if (!array_key_exists( $keyexpected, $cfg )) {
                throw new \Exception('missing information in configuration array passed :"'.$keyexpected.'""');
            }
        }
        //creating headers for Guzzle to get it correctly.

        $this->instance_base_uri = $cfg['instance_base_uri'];
        $this->client = new Client([
            'base_uri' => $this->instance_base_uri
        ]);

        $this->httpheaders['headers']['Host'] = $cfg['instance_fqdn'];
        $this->httpheaders['headers']['Accept'] = 'application/json';
        $this->httpheaders['headers']['aw-tenant-code'] = $cfg['aw-tenant-code'];
        $this->httpheaders['apikey'] = $cfg['apikey'];
        $this->httpheaders['auth']= [];
        $this->httpheaders['auth'][0] = $cfg['username'];
        $this->httpheaders['auth'][1] = $cfg['password'];

        $this->_configfile = $cfg;
        return ;
    }

    public function query($path)
    {
        echo "path URI: ".$path;
        try {
            $response = $this->client->request('GET', $path, $this->httpheaders);
            $statusCode = $response->getStatusCode();
            $reasonPhrase = $response->getReasonPhrase();

            $resp = $this->response(
                $statusCode,
                $reasonPhrase,
                @json_decode($response->getBody()->getContents(), true),
                $path
            );

            //var_dump($resp);

            $this->cleanParamsFromQuery();

            return ($resp);
        } catch (\GuzzleHttp\Exception\ClientException $e) {

            //we want to display a nice error to the user..
            //error are composed of an error code, message, and an activityId for support(lol)

            $err_decomposed = json_decode($e->getResponse()->getBody(), true);

            echo "NEED TO IMPROVE AND VERIFY".PHP_EOL;

            echo "to understand rebase ! rather than PULL ! without -f shit.";

            echo "ça va être la merde";

            echo "Client side exception.".PHP_EOL;
            echo 'code : '.$e->getResponse()->getStatusCode() .PHP_EOL;

            echo 'message: '.$e->getResponse()->getReasonPhrase() .PHP_EOL;
            echo 'activityId : '.$e->getResponse()->getBody()->getContents() .PHP_EOL;
            exit;

        } catch (\GuzzleHttp\Exception\ServerException $e) {

            echo "Server exception\r\n";
            echo "Request Header :\r\n";
            var_dump($e->getRequest()->getHeaders());

            echo "e->Request->getRequest()->getBody():\r\n";
            echo $e->getRequest()->getBody();
            echo "\r\n";
            echo "e->getResponse->getBody()\r\n";
            echo $e->getResponse()->getBody();
            die ("server exception\r\n");
        }

    }

    public function query_post($path, $reqbody = null)
    {
        //$this->httpheaders['headers']['Content-Type']= 'application/json';
        //$this->httpheaders['body'] = json_encode($reqbody);
        $this->httpheaders['json'] = $reqbody;

        try {

            $response = $this->client->post($path, $this->httpheaders);

            $statusCode = $response->getStatusCode();
            $reasonPhrase = $response->getReasonPhrase();

            $resp = $this->response(
                $statusCode,
                $reasonPhrase,
                @json_decode($response->getBody()->getContents(), true),
                $path
            );

            $this->cleanParamsFromQuery();

            return ($resp);
        } catch (\GuzzleHttp\Exception\ClientException $e) {

            //we want to display a nice error to the user..
            //NOT SURE THIS IS THE RIGHT WAY We might need a special class to throw the exception
            // and catch it on the caller side
            $err_decomposed = json_decode($e->getResponse()->getBody(), true);
            if ($e->getResponse()->getStatusCode() == 400)
            {
                $resp = array();
                $resp['uri'] = $path;
                $resp['statuscode'] = $e->getResponse()->getStatusCode();
                $resp['message'] = $err_decomposed['Message'];
                $resp['activityId'] = $err_decomposed['ActivityId'];

                //$resp['data'] = null;
                return ( $resp );
            }

            echo PHP_EOL.'==========='.PHP_EOL;
            var_dump($e->getResponse());
            echo PHP_EOL.'==========='.PHP_EOL;
            //var_dump($err_decomposed);
            echo "Client side exception.".PHP_EOL;
            /*
            echo 'code : '.$e->getResponse()->getStatusCode().PHP_EOL;
            echo 'message: '.$e->getResponse()->getReasonPhrase().PHP_EOL;
            echo 'activityId : '.$e->getResponse()->getBody().PHP_EOL;
            */
            echo 'code : '.$err_decomposed['ErrorCode'].PHP_EOL;
            echo 'message: '.$err_decomposed['Message'].PHP_EOL;
            echo 'activityId : '.$err_decomposed['ActivityId'].PHP_EOL;

            exit;

        } catch (\GuzzleHttp\Exception\ServerException $e) {

            echo "Server exception\r\n";
            echo "Request Header :\r\n";
            var_dump($e->getRequest()->getHeaders());
            echo "e->Request->getRequest()->getBody():\r\n";
            echo $e->getRequest()->getBody();
            echo "\r\n";
            echo "e->getResponse->getBody()\r\n";
            echo $e->getResponse()->getBody();
            die ("server exception\r\n");
        }

    }

    private function activate_middleware_onquery() {

        echo '---- TAP FUNCTION -------'.PHP_EOL;
        $clientHandler = $this->client->getConfig('handler');
        // Create a middleware that echoes parts of the request.
        $tapMiddleware = Middleware::tap(function ($request) {
            echo PHP_EOL.'---- BEGIN TAP FUNCTION -------'.PHP_EOL;
            echo 'Few Header fields:'.PHP_EOL;
            echo 'Content-Length:' . $request->getHeaderLine('Content-Length') . PHP_EOL;
            //
            echo 'Content-Type:' . $request->getHeaderLine('Content-Type') . PHP_EOL;
            // application/json
            echo 'BEGIN Body: '.PHP_EOL.$request->getBody().PHP_EOL.'END Body.'.PHP_EOL;

            echo PHP_EOL.'---- END TAP FUNCTION -------'.PHP_EOL;
            // {"foo":"bar"}
        });


        $this->httpheaders['handler']=$tapMiddleware($clientHandler);

    }

    private function response($statusCode, $reasonPhrase, $data, $uri): array
    {
        $response = [
            'uri'    => $this->instance_base_uri . $uri,
            'status' => $statusCode . ' ' . $reasonPhrase,
            'data'   => $data,
        ];

        return $response;
    }

    protected function addParamsToQuery($arParams) {
        //echo PHP_EOL."Add params to query : ".PHP_EOL;
        //print_r($arParams);

        $this->httpheaders['query'] = $arParams;
    }

    protected function cleanParamsFromQuery(){
        if (array_key_exists('query',$this->httpheaders) == TRUE )
            unset($this->httpheaders['query']);
    }

    /*
     * case insentitive array key exists
     */
    static function array_ikey_exists($keyToSeek, $arrayToLookIn) {
        foreach ($arrayToLookIn as $key => $val){
            if (strnatcasecmp($key, $keyToSeek) == 0) {
                return ($key);
            }
        }
        return ( false );
    }



}