<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Phinx\Console\Command\Create as PhinxCreate;
use Rareloop\Hatchet\Migrations\Commands\LumberjackConfigProvider;

class Create extends PhinxCreate
{
    use LumberjackConfigProvider;
}
