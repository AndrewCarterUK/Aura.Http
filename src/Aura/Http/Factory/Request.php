<?php
/**
 * 
 * This file is part of the Aura project for PHP.
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */
namespace Aura\Http\Factory;

use Aura\Http\Headers;
use Aura\Http\Cookies;
use Aura\Http\Request as HttpRequest;
use Aura\Http\Request\Response as RequestResponse;
use Aura\Http\Request\CookieJar;
use Aura\Http\Request\Multipart;
use Aura\Http\Request\ResponseBuilder;
use Aura\Http\Request\Adapter\Curl;
use Aura\Http\Request\Adapter\Stream;

/**
 * 
 * Create a new Request instance.
 * 
 * @package Aura.Http
 * 
 */
class Request
{
    /**
     *
     * Convenience method for creating a Request object. 
     * 
     * @param string $adapter Use this adapter. Defaults to `auto` if Curl is 
     * installed the Curl adapter is used else the Stream adapter is used.
     * 
     * @param array $options Adapter specific options and defaults. Currently 
     * only used by Curl.
     * 
     * @return Aura\Http\Request
     *
     */
    public function newInstance($adapter = 'auto', array $options = [])
    {
        $headers          = new Headers(new Header);
        $cookiefactory    = new Cookie;
        $cookies          = new Cookies($cookiefactory);
        $response         = new RequestResponse($headers, $cookies);
        $response_builder = new ResponseBuilder($response, new ResponseStack);

        if ('curl' == $adapter ||
            ('auto' == $adapter && extension_loaded('curl'))) {
            
            $adapter   = new Curl($response_builder, $options);
        } else {
            $cookiejar = new CookieJar($cookiefactory);
            $adapter   = new Stream(
                                $response_builder, 
                                new Multipart, 
                                $cookiejar
                            );
        }

        return new HttpRequest($adapter, $headers, $cookies);
    }
}