<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class StartQuiz extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-quiz';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the quiz application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $filePath = 'E:\APIIT\others\CC2_assignment_1\NAHS_Learning\Quiz\online-quiz-system-php-laravel';

        try {
            
            $process = new Process(['php', 'artisan', 'serve', '--host=127.0.0.2', '--port=8001']);
            $process->run();

            echo "Quiz application started successfully.\n";
        } catch (\Exception $e) {
            echo "Error starting quiz application: " . $e->getMessage() . "\n";
        }
    }
}