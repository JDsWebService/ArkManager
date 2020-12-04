<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Trade\TradeItem;

class SoftDeleteExpiredTradesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trade:softdelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Soft deletes any expired trade listing.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $trades = TradeItem::all();
        foreach($trades as $trade) {
            $this->line("Trade ID: {$trade->id}");
            $duration = $trade->duration;
            $now = Carbon::now();
            $end = Carbon::parse($trade->created_at)->addSeconds($duration);
            if($now->greaterThanOrEqualTo($end)) {
                $trade->deleted_at = Carbon::now();
                $trade->save();
                $this->info('Trade has been archived!');
            } else {
                $this->line('Skipping trade, not yet ready to be archived.');
            }
        }
        return 0;
    }
}
