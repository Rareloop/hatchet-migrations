<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Phinx\Console\Command\Migrate as PhinxMigrate;
use Rareloop\Hatchet\Migrations\Commands\LumberjackConfigProvider;

class Migrate extends PhinxMigrate
{
    use LumberjackConfigProvider;
}
