<?php

namespace App\Console\Commands;

use App\Mail\Notify;
use App\Models\NotificationEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyQuiz extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:quiz';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification email will be sent to users when new quiz created.';

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
        
         
        // Setting up a random word
         
        $notify_to_users = NotificationEmail::query()->where("is_sent", 0)->with(['user', 'quiz'])->limit(100)->get();

        foreach ($notify_to_users as $notify_to_user) {
            Mail::to($notify_to_user->user->email)->send(new Notify($notify_to_user->user->name,$notify_to_user->quiz->title));
            $notify_to_user->is_sent=1;
            $notify_to_user->update();
        }
         
        $this->info('Successfully sent Email to 100 users.');
    }
}
