<?php

namespace Bundle\CoreBundle;

use Bundle\CoreBundle\DependencyInjection\ConsignaCoreExtension;
use Mmoreram\BaseBundle\BaseBundle;

class ConsignaCoreBundle extends BaseBundle
{
    public function getContainerExtension()
    {
        return new ConsignaCoreExtension();
    }
}
