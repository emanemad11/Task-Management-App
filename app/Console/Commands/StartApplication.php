<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartApplication extends Command
{
    // Command signature to run
    protected $signature = 'app:start';

    // Description of the command
    protected $description = 'Install dependencies, generate key, run migrations, seed database, and start queue worker';

    // The main function executed when the command runs
    public function handle()
    {
        // Start message
        $this->info('🚀 Starting the application setup...');

        // 1. Composer install
        $this->info('📦 Installing composer dependencies...');
        exec('composer install');

        // 2. Generate application key
        $this->info('🔑 Generating application key...');
        $this->call('key:generate');

        // 3. Run queue:table migration
        $this->info('🛠️ Running queue table migration...');
        $this->call('queue:table');

        // 4. Fresh migrate and seed database
        $this->info('🗄️ Running fresh migrations and seeding database...');
        $this->call('migrate:fresh', ['--seed' => true, '--force' => true]);

        // 5. Start queue worker
        $this->info('⚙️ Starting queue worker...');
        $this->call('queue:work');

        // Final message
        $this->info('✅ Application is up and running!');
    }
}
