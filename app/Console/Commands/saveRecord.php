<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReservationRecordModel;

class saveRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ReservationHistory:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command update the History of the Reservations';

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
     * @return mixed
     */
    public function handle()
    {
        ReservationRecordModel::addNewReservations();
        
    }
}
