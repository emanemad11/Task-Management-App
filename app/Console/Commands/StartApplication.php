<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartApplication extends Command
{
    protected $signature = 'app:start';
    protected $description = 'Install dependencies, generate key, run migrations, seed database, and start queue worker';

    public function handle()
    {
        $this->info('🚀 Starting the application setup...');

        // 1. Composer install
        $this->info('📦 Installing composer dependencies...');
        exec('composer install', $output, $returnVar);
        foreach ($output as $line) {
            $this->line($line);
        }
        if ($returnVar !== 0) {
            $this->error('❌ Composer install failed. Please check the error above.');
            return;
        }

        // 2. Generate application key
        $this->info('🔑 Generating application key...');
        $this->call('key:generate');

        // 3. Fresh migrate database
        $this->info('🗄️ Running fresh migrations...');
        $this->call('migrate:fresh', ['--force' => true]);

        // 4. Seeding database
        $this->info('🌱 Seeding database...');
        $this->call('db:seed', ['--force' => true]);

        // 5. Start queue worker
        $this->info('⚙️ Starting queue worker...');
        $this->call('queue:work');

        $this->info('✅ Application is up and running!');
    }
}
