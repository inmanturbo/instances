<?php

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'xr'])
    ->each->not->toBeUsed();
