<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 8/04/15
 * Time: 13:13.
 */

namespace AppBundle\Model;

use AppBundle\Entity\User;

interface FileInterface
{
    public function addSharedWith(User $user);

    public function eraseCredentials();

    public function getPlainPassword();

    public function getSalt();

    public function getShareCode();

    public function setPassword($password);
}
