<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartApplication extends Command
{
    // The command signature to run from the terminal
    protected $signature = 'app:start';

    // A short description of what this command does
    protected $description = 'Run migrations and start queue worker';

    // The main function that will be executed when running the command
    public function handle()
    {
        // Welcome message when starting the application
        $this->info('🚀 Starting the application...');

        // 1. Run queue:table migration to create the jobs table if it does not exist
        $this->info('🛠️ Running queue table migration...');
        $this->call('queue:table');

        // 2. Run all migrations (with --force to avoid confirmation in production)
        $this->info('🔄 Running all migrations...');
        $this->call('migrate', ['--force' => true]);

        // 3. Start queue worker to automatically process queued jobs
        $this->info('⚙️ Starting queue worker...');
        $this->call('queue:work');

        // Final message to confirm that everything is running successfully
        $this->info('✅ Application is up and running!');
    }
}
