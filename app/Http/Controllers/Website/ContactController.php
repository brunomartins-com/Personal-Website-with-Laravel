<?php namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use Mail;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        return view('website.contact');
    }

    public function post(Request $request)
    {
        //WEBSITE SETTINGS
        $websiteSettings = Handler::readFile("websiteSettings.json");

        $this->validate($request, [
            'name'         => 'required|max:50',
            'email'        => 'required|email|max:50',
            'phone'        => 'required|max:20',
            'message'      => 'required'
        ]);
        array_set($request, "date", Carbon::now()->format('m/d/Y'));

        Mail::send('website.email.contact', ['request' => $request], function ($message) use ($websiteSettings) {
            $message->from('hello@brunomartins.com', 'Bruno Martins')
                ->subject('Website Contact [brunomartins.com]')
                ->to($websiteSettings['email']);
        });

        $message = "Contact sent successfully!";
        return redirect(route('index'))->with(compact('message'));
    }
}