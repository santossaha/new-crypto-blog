<?php

namespace App\Mail;

use App\Models\CompanySetting;
use App\Models\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user_details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request_sent)
    {
        $this->user_details=$request_sent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $generalDetails = GeneralSetting::select('site_logo')->first();
        $companyDetails = CompanySetting::first();

        return $this->view('Mail.testMail')
            ->with([
                'generalDetails'=>$generalDetails,
                'companyDetails'=>$companyDetails,

                'to' => $this->user_details['to']
            ]);

    }
}
