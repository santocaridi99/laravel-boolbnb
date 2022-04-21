<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*     public function index(Request $request)
    {
        $filter = $request->input("filter");
        if($filter){
            $apartments = Apartment::where("streetAddress","LIKE", "%$filter%")->paginate(5);

        }else{
            $apartments=Apartment::paginate(5);
        }
        $apartments->load("tag");
        $apartments->each(function ($apartment) {
            if ($apartment->cover) {
                $apartment->cover = asset("storage/" . $apartment->cover);
            }
        });

        return response()->json($apartments);
        

    } */

    public function index(Request $request)
    {
        $filter = $request->input("filter");
        if ($filter) {
            $apartments = Apartment::where("streetAddress", "LIKE", "%$filter%")->paginate(5);
        } else {
            $apartments = Apartment::paginate(5);
        }
        $apartments->load("tags", "user");

        /* return response()->json([
            "isWorking" => 'yes',
            'dataInvioRichiesta' => now()->format('d-m-Y, H:i'),
            'apartmentsData' => $apartments
        ]); */

        //per visualizzare le immagini inviate dal backend
        $apartments->each(function ($apartment) {
            //formo l'url completo per l'immagine del apartment
            if ($apartment->cover) {
                $apartment->cover = asset('storage/' . $apartment->cover);
            }
        });

        return response()->json($apartments);
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
        //
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
