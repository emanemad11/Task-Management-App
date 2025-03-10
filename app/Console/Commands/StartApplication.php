<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartApplication extends Command
{
    protected $signature = 'app:start';
    protected $description = 'Generate key, run migrations, seed database, and start queue worker';

    public function handle()
    {
        $this->info('🚀 Starting the application setup...');

        // 1. Generate application key
        $this->info('🔑 Generating application key...');
        $this->call('key:generate');

        // 2. Fresh migrate database
        $this->info('🗄️ Running fresh migrations...');
        $this->call('migrate:fresh', ['--force' => true]);

        // 3. Seeding database
        $this->info('🌱 Seeding database...');
        $this->call('db:seed', ['--force' => true]);

        // 4. Start queue worker
        $this->info('⚙️ Starting queue worker...');
        $this->call('queue:work');

        $this->info('✅ Application is up and running!');
    }
}
