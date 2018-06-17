<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/16/2018
 * Time: 2:42 PM
 */

class RequestLog {
    private $_senderIpAdress;
    private $_time;
    private $_requestMethod;
    private $_requestUri;
    private $_requestParams;
    private $_requestAuthorization;
    private $_response;
    private $_responseCode;

    public function __construct() {
        $this->_requestUri = $_SERVER['REQUEST_URI'];
        $this->_requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->_requestParams = json_encode($_REQUEST);
        $this->_senderIpAdress = $_SERVER['REMOTE_ADDR'];
        $this->_responseCode = http_response_code();

        $service = new \Klein\ServiceProvider();
        $token = null;
        try{
            $token = $service->getToken();
        } catch (\Exception $e) {
            $token = 'NONE';
        }
        $this->_requestAuthorization = $token;
    }

    /**
     * @return mixed
     */
    public function getSenderIpAdress()
    {
        return $this->_senderIpAdress;
    }

    /**
     * @param mixed $senderIpAdress
     */
    public function setSenderIpAdress($senderIpAdress)
    {
        $this->_senderIpAdress = $senderIpAdress;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->_time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->_time = $time;
    }

    /**
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $this->_requestMethod;
    }

    /**
     * @param mixed $requestMethod
     */
    public function setRequestMethod($requestMethod)
    {
        $this->_requestMethod = $requestMethod;
    }

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->_requestUri;
    }

    /**
     * @param mixed $requestUri
     */
    public function setRequestUri($requestUri)
    {
        $this->_requestUri = $requestUri;
    }

    /**
     * @return mixed
     */
    public function getRequestParams()
    {
        return $this->_requestParams;
    }

    /**
     * @param mixed $requestParams
     */
    public function setRequestParams($requestParams)
    {
        $this->_requestParams = $requestParams;
    }

    /**
     * @return mixed
     */
    public function getRequestAuthorization()
    {
        return $this->_requestAuthorization;
    }

    /**
     * @param mixed $requestAuthorization
     */
    public function setRequestAuthorization($requestAuthorization)
    {
        $this->_requestAuthorization = $requestAuthorization;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->_response = $response;
    }

    /**
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->_responseCode;
    }

    /**
     * @param mixed $responseCode
     */
    public function setResponseCode($responseCode)
    {
        $this->_responseCode = $responseCode;
    }

}