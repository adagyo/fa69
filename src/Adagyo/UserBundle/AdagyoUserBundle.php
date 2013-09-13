<?php

namespace Adagyo\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AdagyoUserBundle extends Bundle {
    public function getParent() {
        return 'FOSUserBundle';
    }
}
