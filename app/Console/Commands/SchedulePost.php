<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SchedulePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:premiumPost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Premium members will be able to schedule their posts and the posts will be automatically published at their scheduled time.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
