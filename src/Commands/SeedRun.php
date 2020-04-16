<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Phinx\Console\Command\SeedRun as PhinxSeedRun;
use Rareloop\Hatchet\Migrations\Commands\LumberjackConfigProvider;

class SeedRun extends PhinxSeedRun
{
    use LumberjackConfigProvider;
}
