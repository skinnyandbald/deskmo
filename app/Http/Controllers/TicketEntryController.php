<?php

namespace App\Http\Controllers;

use App\User;
use App\TicketEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TicketEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        Log::debug(print_r($request->all(), true));

        $data = $this->validate($request, [
            'msisdn' => 'required',
            'text' => 'required'
        ]);

        $user = User::where('phone_number', $data['msisdn'])->firstOrFail();
        $ticket = $user->latestTicketWithActivity();

        $entry = new TicketEntry([
            'content' => $data['text'],
            'channel' => 'sms',
        ]);

        $entry->user()->associate($user);
        $entry->ticket()->associate($ticket);
        $entry->save();
        
        return response('', 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
