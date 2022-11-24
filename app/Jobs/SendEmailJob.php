<?php

namespace App\Jobs;

use App\Models\Coupon;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $results, $coupon, $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($results)
    {
        $this->results = $results;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->coupon = Coupon::find($this->results['coupon'])->first();

        foreach ($this->results['patients'] as $patient)
        {
            $this->user = User::find($patient);

            if($this->user->email)
            {
                Mail::raw('You Coupon is '. $this->coupon->title , function($message) {
                    $message -> from('Info@drtele.com', 'DrTele | Hospital');
                    $message -> to($this->user->email);
                    $message -> subject('Promotion Coupon');
                });
            }


        }
    }
}
