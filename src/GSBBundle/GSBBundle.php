<?php

namespace GSBBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GSBBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
