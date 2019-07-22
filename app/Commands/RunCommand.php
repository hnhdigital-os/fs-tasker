<?php

namespace App\Commands;

use App\Traits\HelperTrait;
use App\Traits\TasksTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use LaravelZero\Framework\Commands\Command;

class RunCommand extends Command
{
    use HelperTrait, TasksTrait;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'run
                            {--config= : Config file path}
                            {--tasks= : Run specific tasks}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Run the bundler';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->cwd = getcwd();

        $this->info('Running bundler...');
        $this->line('');

        $this->parseConfig();

        $this->info('Verifying...');

        $this->verifyTasks();        

        $this->info('Processing...');

        if ($this->processTasks()) {
            $this->info('Completed.');
        }
    }
}
