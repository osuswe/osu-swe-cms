<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use \DateTime;

class EventsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return void
	 */
	public function index() {
		$events = Event::paginate ( 15 );
		
		return view ( 'admin.events.index', compact ( 'events' ) );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return void
	 */
	public function create() {
		return view ( 'admin.events.create' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return void
	 */
	public function store(Request $request) {
		$this->validate ( $request, [ 
				'title' => 'required',
				'date' => 'required',
				'location' => 'required',
				'description' => 'required',
				'time_range' => 'required',
				'event_code' => 'required' 
		] );
		
		Event::create ( $request->all () );
		
		// schedule push notification
		$this->sendMessage ( $request->title, $request->date, $request->time_range, $request->location, $request->notification_send_time );
		
		Session::flash ( 'flash_message', 'Event added!' );
		
		return redirect ( 'admin/events' );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 *
	 * @return void
	 */
	public function show($id) {
		$event = Event::findOrFail ( $id );
		
		return view ( 'admin.events.show', compact ( 'event' ) );
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 *
	 * @return void
	 */
	public function edit($id) {
		$event = Event::findOrFail ( $id );
		
		return view ( 'admin.events.edit', compact ( 'event' ) );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id        	
	 *
	 * @return void
	 */
	public function update($id, Request $request) {
		$this->validate ( $request, [ 
				'title' => 'required',
				'date' => 'required',
				'location' => 'required',
				'description' => 'required',
				'time_range' => 'required' 
		] );
		
		$event = Event::findOrFail ( $id );
		$event->update ( $request->all () );
		
		Session::flash ( 'flash_message', 'Event updated!' );
		
		return redirect ( 'admin/events' );
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 *
	 * @return void
	 */
	public function destroy($id) {
		// send notification before deleting event
		$event = Event::findOrFail ( $id );
		
		// only send deletion notification if event still hasn't happened
		
		$splitStartEndTime = explode ( "-", $event->time_range );
		$startTimeString = $splitStartEndTime [0];
		$splitTimeArray = explode ( " ", $startTimeString );
		$startTime = $splitTimeArray [0];
		$am_pm = $splitTimeArray [1];
		$startTimeArray = explode(":", $startTime);
		$hours=$startTimeArray[0];
		$minutes = $startTimeArray[1];
		
		//add hours for 24 time representation
		if ($am_pm == 'pm' && $hours > 12) {
			$hours += 12;
		}
				
		//create new date time object for start event
		$eventDateTime = new DateTime($event->date);
		$eventDateTime->setTime($hours, $minutes);
		$now = new DateTime(null, new \DateTimeZone('America/New_York'));
		
		//send cancellation message only if event hasn't happened yet
		if($now < $eventDateTime){
			$this->sendEventCancelledMessage ( $event->title );
		}
		
		
		Event::destroy ( $id );
		
		Session::flash ( 'flash_message', 'Event deleted!' );
		
		return redirect ( 'admin/events' );
	}
	
	/**
	 * Make OneSignal push notification schedule request for events
	 *
	 * @param
	 *        	$eventName
	 * @param
	 *        	$eventDate
	 * @param
	 *        	$eventTime
	 * @param
	 *        	$eventLocation
	 * @param
	 *        	$notificationDeliveryTime
	 * @return mixed
	 */
	public function sendMessage($eventName, $eventDate, $eventTime, $eventLocation, $notificationDeliveryTime) {
		$content = array (
				"en" => 'Event: ' . $eventName . "\n" . 'Date: ' . $eventDate . "\n" . 'Time: ' . $eventTime . "\n" . 'Location: ' . $eventLocation . "\n" . "SWE you there!" 
		);
		
		$heading = array (
				"en" => "Upcoming SWE Event" 
		);
		
		$icon = "icon"; // extension left off; files in the resources folder in ionic
		
		$fields = array (
				'app_id' => "a263afad-afe2-471e-b0da-a9d0467b9cb3",
				'included_segments' => array (
						'Active Users' 
				),
				// 'data' => array("foo" => "bar"),
				'contents' => $content,
				'headings' => $heading,
				'small_icon' => $icon,
				'send_after' => $notificationDeliveryTime 
		);
		
		$fields = json_encode ( $fields );
		print ("\nJSON sent:\n") ;
		print ($fields) ;
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications" );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json; charset=utf-8',
				'Authorization: Basic N2I1NDVmNjAtZDBkMS00N2ExLTkwY2YtODczMTQ4ZmZlYTJm' 
		) );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
		curl_setopt ( $ch, CURLOPT_POST, TRUE );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		
		$response = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $response;
	}
	
	/*
	 * Send notification to users when event has been cancelled
	 */
	public function sendEventCancelledMessage($eventName) {
		$content = array (
				"en" => "The $eventName event has been cancelled. For more info please contact a SWE officer." 
		);
		
		$heading = array (
				"en" => "SWE Event Cancellation" 
		);
		
		$icon = "icon"; // extension left off; files in the resources folder in ionic
		
		$fields = array (
				'app_id' => "a263afad-afe2-471e-b0da-a9d0467b9cb3",
				'included_segments' => array (
						'Active Users' 
				),
				// 'data' => array("foo" => "bar"),
				'contents' => $content,
				'headings' => $heading,
				'small_icon' => $icon 
		);
		// 'send_after' => $notificationDeliveryTime
		
		
		$fields = json_encode ( $fields );
		print ("\nJSON sent:\n") ;
		print ($fields) ;
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications" );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json; charset=utf-8',
				'Authorization: Basic N2I1NDVmNjAtZDBkMS00N2ExLTkwY2YtODczMTQ4ZmZlYTJm' 
		) );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
		curl_setopt ( $ch, CURLOPT_POST, TRUE );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		
		$response = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $response;
	}
	public function all() {
		return Event::all ();
	}
}
