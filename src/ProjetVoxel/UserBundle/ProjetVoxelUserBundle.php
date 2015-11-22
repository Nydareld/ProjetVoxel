<?php

namespace ProjetVoxel\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProjetVoxelUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
