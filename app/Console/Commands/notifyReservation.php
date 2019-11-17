<?php

namespace App\Console\Commands;

use App\Models\ReservationModel;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Mail;

class notifyReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifyReservation:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command notifies an upcomming reservation to the reservation creator';

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
        //
        Mail::send([], [], function ($message) {
            $message->to('lauarangom@gmail.com')->subject("Recordatorio Reserva")
            ->setBody('Holaaaa tienes una cita pronto ;)');            

        });
        /*
        $data = array('Mensaje' => 'Holaaaa tienes una cita pronto ;)');
        Mail::send('welcome', $data, function ($message) {
            $message->from('lauarangom@gmail.com', 'Laravel');
        
            $message->to('lauarango@gmail.com')->cc('jokkusu@gmail.com');
        });*/
        /*
        //$userIds = ReservationModel::getUpcommingReservations();
        $userIds = array(["5dc9f2fd91aa3d00a3555d69"]);
        foreach ($userIds as $userId){
            $client = New Client;
            $decorationData = $client->request('GET', 'http://181.50.100.167:4000/getEmail?id='. 
            (string)$userId);
            //$httpStatus = $decorationData->getStatusCode();
            $body = json_decode($decorationData->getBody(), true);
            $response = $body['response'];
            if ($response == 2) {
                $content = $body['content'];
                $email = $content['email'];
                Mail::send('emails.welcome', "Holaaaa tienes una cita pronto ;)", function ($message) {
                    $message->from(email, 'Laravel');
                
                    $message->to('lauarango@gmail.com')->cc('jokkusu@gmail.com');
                });
            }
        }
        */
         echo "siii";
    }
}
