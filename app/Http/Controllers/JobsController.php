<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jobs\SendTestEmail;

class JobsController extends Controller
{
    public function process_queue()
    {
        $carbon_object = Carbon::now(config("app.timezone"))->addMinutes(10);
        $timestamp = $carbon_object->toDateTimeString();
        SendTestEmail::dispatch()->delay($carbon_object);
        echo "
      <p style=\"
        padding: 2em; margin: 2em; border: 4px solid #ddd;
        border-radius: 0.5em;
        font-family: sans-serif; font-weight: bold;
        font-size: 1.5em; color: #777;
      \">
        We scheduled an email at $timestamp.
      </p>
    \n";
    }
}
