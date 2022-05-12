<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use Throwable;
use Carbon\Carbon;

class SendTestEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // set email values
            $timestamp = Carbon::now(
                config("app.timezone")
            )->toDateTimeString();
            $to_email = "adamdenverco@gmail.com";
            $mail_data = [
                "subject" => "test email sent at $timestamp",
                "from_email" => env("MAIL_FROM_ADDRESS"),
                "from_name" => env("MAIL_FROM_NAME"),
            ];

            // create our mail object
            $email_object = new TestEmail($mail_data);

            // send the email message
            Mail::to($to_email)->send($email_object);
        } catch (Throwable $th) {
            // output an error
            echo "<pre>Throwable: " . print_r($th) . "</pre>\n";
        }
    }
}
