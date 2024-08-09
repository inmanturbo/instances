<?php

namespace Inmanturbo\Instances\Commands;

use Illuminate\Console\Command;

class InstancesCommand extends Command
{
    public $signature = 'instances';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
