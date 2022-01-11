<?php

namespace App\Console\Commands;

use App\Services\AuctionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class EveryMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';
    private AuctionService $auctionService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the auction has expired and handle it.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AuctionService $auctionService)
    {
        parent::__construct();
        $this->auctionService = $auctionService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("DB updated");
        $this->auctionService->handleItemAuction();
    }
}