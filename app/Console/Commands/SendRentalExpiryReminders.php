<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AssetAssignment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RentalExpiryNotification;

class SendRentalExpiryReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-rental-expiry-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $upcomingReturns = AssetAssignment::whereNotNull('returned_date')
        ->whereDate('returned_date', '<=', now()->addDays(7)) // Assets due in next 7 days
        ->with('user')
        ->get();

        foreach ($upcomingReturns as $assignment) {
            $assignment->user->notify(new RentalExpiryNotification($assignment));
        }
}
    
}
