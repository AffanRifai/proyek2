<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;

class AutoCompleteBookings extends Command
{
    protected $signature = 'bookings:autocomplete';
    protected $description = 'Automatically complete expired bookings';

    public function handle()
    {
        $this->info('Starting auto-complete process for expired bookings...');
        
        $count = Booking::autoCompleteExpiredBookings();
        
        if ($count > 0) {
            $this->info("✅ Successfully auto-completed {$count} bookings.");
            \Log::info("Auto-completed {$count} bookings on " . now()->toDateTimeString());
        } else {
            $this->info("ℹ️ No expired bookings found to auto-complete.");
        }
        
        return Command::SUCCESS;
    }
}