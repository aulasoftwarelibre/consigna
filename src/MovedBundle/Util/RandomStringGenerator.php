<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MovedBundle\Util;

class RandomStringGenerator
{
    public static function length($length)
    {
        return base64_encode(bin2hex(openssl_random_pseudo_bytes($length)));
    }
}
