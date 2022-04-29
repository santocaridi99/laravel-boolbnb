<?php

namespace App\Http\Controllers\Host;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        //     $sponsorship = Sponsorship::all();
        //     $apartments = Apartment::where("user_id", Auth::user()->id);
        //     return view('host.sponsor.index', compact('sponsorship', 'apartments'));
        $sponsorship = Sponsorship::all();
        $apartments = Apartment::where("slug", $slug)->first();
        return view('host.sponsor.index', compact('sponsorship', 'apartments'));
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
        $data = $request->validate([
            "id" => "required",
            "apartment_id" => "required",
            "sponsorship_id" => "required",
            "start_date" => "required",
            "end_date" => "required",
        ]);

        $sponsor = new Sponsorship();

        $sponsor->fill($data);

        $sponsor->save();

        $sponsor->apartments()->attach($data["apartment_id"]);

        return redirect()->route("host.apartments.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sponsorship=Sponsorship::where("id",$id)->first();    
        return view('host.sponsor.show', compact('sponsorship'));
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
