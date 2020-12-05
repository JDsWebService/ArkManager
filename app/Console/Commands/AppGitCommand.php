<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppGitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push {--p|production : Pushes the project to production server}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pushes the project using Git.';

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
        $production = $this->option('production');
        $commitTitle = $this->ask('Enter your commit title:');
        $commitMessage = $this->ask('Enter your commit message:');
        $this->alert("Adding all files to git...");
        exec('git add .');
        $this->alert("Crafting Commit Message...");
        $message = "-m \"{$commitTitle}\"";
        if($commitMessage != null) {
            $message .= " -m \"{$commitMessage}\"";
        }
        exec("git commit " . $message);
        $pushMessage = "Pushing to Origin.";
        if($production) {
            $pushMessage .= " Pushing to Production";
        }
        $this->alert($pushMessage);
        exec("git push origin master");
        if($production) {
            exec("git push production master");
        }
        $this->info("Command has been executed successfully!");
        return 0;
    }
}
