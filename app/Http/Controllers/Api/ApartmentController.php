<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $rooms = $request->input("rooms");
        if ($filter) {
            $apartments = Apartment::where("streetAddress", "LIKE", "%$filter%")->orWhere("room_numbers","=","$rooms")->paginate(5);
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

    public function show($slug)
    {
        $apartmentDetails = Apartment::where("slug", $slug)
            ->with(["tags", "user", 'images'])
            ->first();

        if (!$apartmentDetails) {
            abort(404);
        }

        return response()->json($apartmentDetails);
    }

    public function location(Request $request){
        $address = $request->input("filter");

        $results = Http::get(`https://api.tomtom.com/search/2/geocode/` . $address . `.json?storeResult=false&limit=5&countrySet=it&radius=5&view=Unified&key=Z4C8r6rK8x69JksEOmCX43MGffYO83xu`);
        
        $lat = $results["results"][0]["position"]["lat"];
        $lon = $results["results"][0]["position"]["lon"];
        $apartments = Apartment::all();
        foreach ($apartments as $apartment) {
            $distance = sqrt(
                pow($lat - $apartment['latitude'], 2) +
                  pow($lon - $apartment['longitude'], 2)
              );
            $realDistance = $distance * 0.996 * 100;
            if ($realDistance <= 20) {
                $apartmentsInRadius[] = $apartment;
            }
        }

       return response()->json($apartmentsInRadius);
    }
}
