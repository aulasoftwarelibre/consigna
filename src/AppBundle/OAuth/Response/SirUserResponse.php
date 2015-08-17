<?php

namespace AppBundle\OAuth\Response;

use HWI\Bundle\OAuthBundle\OAuth\Response\PathUserResponse;

class SirUserResponse extends PathUserResponse
{
    /**
     * @var array
     */
    protected $paths = array(
        'identifier' => 'openid.0',
        'nickname' => 'openid.0',
        'realname' => 'openid.0',
        'email' => 'openid.0',
        'profilepicture' => null,
    );

    protected function getRequestMetadata()
    {
        $openid = $this->getValueForPath('identifier');
        preg_match('#(?<email>(?<username>[^/]+)@(?<organization>[^/]+))#', $openid, $matches);

        return $matches;
    }

    public function getUsername()
    {
        $metadata = $this->getRequestMetadata();

        return $metadata['email'];
    }

    public function getEmail()
    {
        $metadata = $this->getRequestMetadata();

        return $metadata['email'];
    }

    public function getOrganization()
    {
        $metadata = $this->getRequestMetadata();

        return $metadata['organization'];
    }
}
