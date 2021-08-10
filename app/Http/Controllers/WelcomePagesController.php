<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventsCategories as Categories;
use App\Models\Event;
use PDF;



class WelcomePagesController extends Controller
{

    protected $kkiapay;

    public function __construct(Request $request)
    {

        
    }
    
    public function firstPage()
    {
        $events = Event::with("organiser")->get();
        $eventsCategories = Categories::select('name')->get();
        return view('welcomePages.index', compact(['events','eventsCategories']));
    }

    public function eventsByCategory($name)
    {
        $events = Event::where('category', '=', $name)->get();
        return view('welcomePages.eventsByCategory', compact('events'));
    }

    public function eventsDetails($event_id)
    {
   
        $event = Event::where('is_live', '=', 1)->findOrfail($event_id);
        return view('welcomePages.eventDetails', compact('event'));

    }

    public function payment()
    {

        $kkiapay = new \Kkiapay\Kkiapay(env('KKIAPAY_PUBLIC_API_KEY'),
                                env('KKIAPAY_PRIVATE_API_KEY'), 
                                env('KKIAPAY_SECREY_API_KEY'), 
                                $sandbox = true);
        return view('pdf');
        
    }
}
