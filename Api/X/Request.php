<?php

namespace baibaratsky\WebMoney\Api\X;

use baibaratsky\WebMoney\Request\XmlRequest;

abstract class Request extends XmlRequest
{
    const AUTH_CLASSIC = 'classic';
    const AUTH_LIGHT = 'light';
    const AUTH_SHA256 = 'sha256';
    const AUTH_MD5 = 'md5';
    const AUTH_SECRET_KEY = 'secret_key';

    /** @var string */
    protected $authType;

    /** @var string reqn */
    protected $requestNumber;

    public function __construct($authType = self::AUTH_CLASSIC)
    {
        $this->authType = $authType;
        $this->requestNumber = $this->generateRequestNumber();
    }

    /**
     * @return string
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * @return int
     */
    public function getRequestNumber()
    {
        return $this->requestNumber;
    }

    /**
     * @param int $requestNumber must be greater than a previous request number
     */
    public function setRequestNumber($requestNumber)
    {
        $this->requestNumber = $requestNumber;
    }

    /**
     * @return string
     */
    protected function generateRequestNumber()
    {
        list($msec, $sec) = explode(' ', substr(microtime(), 2));
        return $sec . substr($msec, 0, 5);
    }
}
