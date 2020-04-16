<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Phinx\Console\Command\SeedCreate as PhinxSeedCreate;
use Rareloop\Hatchet\Migrations\Commands\LumberjackConfigProvider;

class SeedCreate extends PhinxSeedCreate
{
    use LumberjackConfigProvider;
}
