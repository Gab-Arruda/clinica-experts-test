<?php

namespace App\Console\Commands;

use App\Services\LinkService;
use Illuminate\Console\Command;

class ResetCounterCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:counter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Resets this month's request of all links";

    /**
     * Create a new command instance.
     */
    public function __construct(protected LinkService $service){
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->service->reset_counter();
    }
}
