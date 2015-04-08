<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 8/04/15
 * Time: 13:13
 */

namespace AppBundle\Model;

interface FileInterface {

    public function getPlainPassword();

    public function getSalt();

    public function setPassword($password);

    public function eraseCredentials();

}