<?php

namespace App\Console\Commands;

use App\Actions\AppInstallAction;
use Illuminate\Console\Command;

class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch initial stock prices';

    /**
     * Execute the console command.
     *
     */
    public function handle(AppInstallAction $appInstallAction)
    {
        $this->info('Beginning of app install');

        $appInstallAction->handle();

        $this->info('Ending of app install');
    }
}
