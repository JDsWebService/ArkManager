<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GitFixUntrackedFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes untracked files.';

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
        exec('git rm -r --cached .');
        exec('git add .');
        exec("git commit -m \"fixed untracked files\"");
        exec("git push origin master");
        return 0;
    }
}
