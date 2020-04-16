<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Phinx\Console\Command\Status as PhinxStatus;
use Rareloop\Hatchet\Migrations\Commands\LumberjackConfigProvider;

class Status extends PhinxStatus
{
    use LumberjackConfigProvider;
}
