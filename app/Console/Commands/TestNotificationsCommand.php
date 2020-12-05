<?php

namespace App\Console\Commands;

use App\Models\Auth\User;
use App\Models\Tribe\Tribe;
use Illuminate\Support\Str;
use App\Models\Tribe\Invite;
use Illuminate\Console\Command;
use App\Notifications\UserAddedToTribe;

class TestNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modifiable Command to run a series of notifications for testing.';

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
        $this->alert("This command has not been setup yet, and is for testing purposes only!");
        return 0;
    }
}
