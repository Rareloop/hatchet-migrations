<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Phinx\Console\Command\Rollback as PhinxRollback;
use Rareloop\Hatchet\Migrations\Commands\LumberjackConfigProvider;

class Rollback extends PhinxRollback
{
    use LumberjackConfigProvider;
}
