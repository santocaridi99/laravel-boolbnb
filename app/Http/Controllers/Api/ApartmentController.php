<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Tag;
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
        // $filter = $request->input("filter");


        // $apartments->load("tags", "user");

        // /* return response()->json([
        //     "isWorking" => 'yes',
        //     'dataInvioRichiesta' => now()->format('d-m-Y, H:i'),
        //     'apartmentsData' => $apartments
        // ]); */

        // //per visualizzare le immagini inviate dal backend
        // $apartments->each(function ($apartment) {
        //     //formo l'url completo per l'immagine del apartment
        //     if ($apartment->cover) {
        //         $apartment->cover = asset('storage/' . $apartment->cover);
        //     }
        // });

        // return response()->json($apartments);
        $rooms = $request->input("rooms");
        $beds = $request->input('beds');
        $picked = $request->input('picked');

        $filter = $request->input("filter");


        if ($filter) {
            $coordinate = Http::get('https://api.tomtom.com/search/2/search/.json?key=Z4C8r6rK8x69JksEOmCX43MGffYO83xu&query=' . $filter . '&countrySet=IT' . '&limit=1');
            $lat = $coordinate["results"][0]["position"]["lat"];
            $lon = $coordinate["results"][0]["position"]["lon"];
            // dump($lat,$lon);
            // $notFilteredApartments = Apartment::all();
            if ($filter && $rooms && $beds) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->where("bed_numbers", "=", "$beds")->orderBy('streetAddress', 'DESC')->paginate(5);
            } elseif ($filter && $rooms) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->orderBy('streetAddress', 'DESC')->paginate(5);
            } elseif ($filter && $picked) {
                $notFilteredApartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->where('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->paginate(5);
            } elseif ($filter && $beds) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("bed_numbers", "=", "$beds")->orderBy('streetAddress', 'DESC')->paginate(5);
            } else {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->paginate(5);
            }


            $notFilteredApartments->load("tags", "user");

            /* return response()->json([
                "isWorking" => 'yes',
                'dataInvioRichiesta' => now()->format('d-m-Y, H:i'),
                'apartmentsData' => $apartments
            ]); */

            //per visualizzare le immagini inviate dal backend
            $notFilteredApartments->each(function ($filteredApartments) {
                //formo l'url completo per l'immagine del apartment
                if ($filteredApartments->cover) {
                    $filteredApartments->cover = asset('storage/' . $filteredApartments->cover);
                }
            });

            foreach ($notFilteredApartments as $apartment) {
                $distance = sqrt(pow($lat - $apartment['latitude'], 2) + pow($lon - $apartment['longitude'], 2)) * 100;
                if ($distance <= 20) {
                    $filteredApartments[] = $apartment;
                }
            }
            // dd($filteredApartments);
            return response()->json($filteredApartments);
        } else {
            if ($rooms && $beds) {
                $apartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->where("bed_numbers", "=", "$beds")->orderBy('streetAddress', 'DESC')->paginate(5);
            } elseif ($rooms) {
                $apartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->orderBy('streetAddress', 'DESC')->paginate(5);
            } elseif ($picked) {
                $apartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->where('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->paginate(5);
            } elseif ($beds) {
                $apartments = Apartment::where("isVisible", "=", "1")->where("bed_numbers", "=", "$beds")->orderBy('streetAddress', 'DESC')->paginate(5);
            } else {
                $apartments = Apartment::where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->paginate(5);
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

    public function location(Request $request)
    {
        // $address = $request->input("filter");

        // $results = Http::get(`https://api.tomtom.com/search/2/geocode/` . $address . `.json?storeResult=false&limit=5&countrySet=it&radius=5&view=Unified&key=Z4C8r6rK8x69JksEOmCX43MGffYO83xu`);

        // $lat = $results["results"][0]["position"]["lat"];
        // $lon = $results["results"][0]["position"]["lon"];
        // $apartments = Apartment::all();
        // foreach ($apartments as $apartment) {
        //     $distance = sqrt(
        //         pow($lat - $apartment['latitude'], 2) +
        //             pow($lon - $apartment['longitude'], 2)
        //     );
        //     $realDistance = $distance * 0.996 * 100;
        //     if ($realDistance <= 20) {
        //         $apartmentsInRadius[] = $apartment;
        //     }
        // }

        // return response()->json($apartmentsInRadius);
    }
}
