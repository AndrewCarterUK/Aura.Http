<?php
/**
 *
 * This file is part of the Aura project for PHP.
 *
 * @package Aura.Http
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Http\Cookie;

use Aura\Http\Cookie\Cookie;

/**
 *
 * Factory to create new Cookie objects.
 *
 * @package Aura.Http
 *
 */
class CookieFactory
{
    /**
     *
     * Creates and returns a new Cookie object.
     *
     * @param string $name Cookie name.
     *
     * @param array $params An array of key-value pairs corresponding to
     * the remaining cookie constructor params.
     *
     * @return Cookie
     *
     */
    public function newInstance($name = null, array $params = array())
    {
        $default = [
            'value'    => null,
            'expire'   => 0,
            'path'     => null,
            'domain'   => null,
            'secure'   => false,
            'httponly' => true,
        ];

        $params = array_merge($default, $params);

        return new Cookie(
            $name,
            $params['value'],
            $params['expire'],
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
}
