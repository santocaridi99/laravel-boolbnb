<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ApartmentView;

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
        $price = $request->input('price');
        $picked = $request->input('picked');
        $filter = $request->input("filter");
        $radius = $request->input('radius');


        if ($filter) {
            $coordinate = Http::get('https://api.tomtom.com/search/2/search/.json?key=Z4C8r6rK8x69JksEOmCX43MGffYO83xu&query=' . $filter . '&countrySet=IT' . '&limit=1');
            $lat = $coordinate["results"][0]["position"]["lat"];
            $lon = $coordinate["results"][0]["position"]["lon"];
            // dd($radius);
            // $notFilteredApartments = Apartment::all();
            if ($filter && $picked && $beds && $rooms && $price) {
                $notFilteredApartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->where("bed_numbers", "=", "$beds")->where("room_numbers", "=", "$rooms")->where("price_per_night", "<=", "$price")->paginate(15);
            } 
            
            elseif ($filter && $rooms && $beds && $price) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->where("bed_numbers", "=", "$beds")->where("price_per_night", "<=", "$price")->orderBy('streetAddress', 'DESC')->paginate(15);
            } 
            
            elseif ($filter && $picked && $beds && $price) {
                $notFilteredApartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->where("bed_numbers", "=", "$beds")->where("price_per_night", "<=", "$price")->paginate(15);
            } 
            
            elseif ($filter && $picked && $rooms && $price) {
                $notFilteredApartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->where("room_numbers", "=", "$rooms")->where("price_per_night", "<=", "$price")->paginate(15);
            } 
            
            elseif ($filter && $rooms && $beds) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->where("bed_numbers", "=", "$beds")->orderBy('streetAddress', 'DESC')->paginate(15);
            } 
            
            elseif ($filter && $picked && $beds) {
                $notFilteredApartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->where("bed_numbers", "=", "$beds")->paginate(15);
            } 
            
            elseif ($filter && $picked && $rooms) {
                $notFilteredApartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->where("room_numbers", "=", "$rooms")->paginate(15);
            } 
            
            elseif ($filter && $rooms && $price) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->where("price_per_night", "<=", "$price")->orderBy('streetAddress', 'DESC')->paginate(15);
            } 
            
            elseif ($filter && $picked && $price) {
                $notFilteredApartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->where("price_per_night", "<=", "$price")->paginate(15);
            } 
            
            elseif ($filter && $price && $beds) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("price_per_night", "<=", "$price")->where("bed_numbers", "=", "$beds")->orderBy('streetAddress', 'DESC')->paginate(15);
            } 
            
            elseif ($filter && $rooms) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->orderBy('streetAddress', 'DESC')->paginate(15);
            } 
            
            elseif ($filter && $picked) {
                $notFilteredApartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->paginate(15);
            } 
            
            elseif ($filter && $beds) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("bed_numbers", "=", "$beds")->orderBy('streetAddress', 'DESC')->paginate(15);
            } 

            elseif ($filter && $price) {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->where("price_per_night", "<=", "$price")->orderBy('streetAddress', 'DESC')->paginate(15);
            } 
            
            else {
                $notFilteredApartments = Apartment::where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->paginate(15);
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
                if ($distance <= $radius) {
                    $filteredApartments[] = $apartment;
                }
            }

            // dd($filteredApartments);
            return response()->json($filteredApartments);
        } else {
            if ($rooms && $beds && $picked && $price) {
                $apartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->orderBy('streetAddress', 'DESC');
                })->where("room_numbers", "=", "$rooms")->where("price_per_night", "<=", "$price")->where("bed_numbers", "=", "$beds")->paginate(15);
            } elseif ($rooms && $picked && $price) {
                $apartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->orderBy('streetAddress', 'DESC');
                })->where("room_numbers", "=", "$rooms")->where("price_per_night", "<=", "$price")->paginate(15);
            } elseif ($beds && $picked && $price) {
                $apartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->orderBy('streetAddress', 'DESC');
                })->where("bed_numbers", "=", "$beds")->where("price_per_night", "<=", "$price")->paginate(15);
            } elseif ($rooms && $beds && $price) {
                $apartments = Apartment::where("isVisible", "=", "1")->where("bed_numbers", "=", "$beds")->where("price_per_night", "<=", "$price")->where("room_numbers", "=", "$rooms")->orderBy('streetAddress', 'DESC')->paginate(15);
            } elseif ($rooms && $beds && $picked) {
                $apartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->orderBy('streetAddress', 'DESC');
                })->where("room_numbers", "=", "$rooms")->where("bed_numbers", "=", "$beds")->paginate(15);
            } elseif ($rooms && $picked) {
                $apartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->orderBy('streetAddress', 'DESC');
                })->where("room_numbers", "=", "$rooms")->paginate(15);
            } elseif ($beds && $picked) {
                $apartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->orderBy('streetAddress', 'DESC');
                })->where("bed_numbers", "=", "$beds")->paginate(15);
            } elseif ($rooms && $beds) {
                $apartments = Apartment::where("isVisible", "=", "1")->where("bed_numbers", "=", "$beds")->where("room_numbers", "=", "$rooms")->orderBy('streetAddress', 'DESC')->paginate(15);
            } elseif ($beds && $price) {
                $apartments = Apartment::where("isVisible", "=", "1")->where("bed_numbers", "=", "$beds")->where("price_per_night", "<=", "$price")->orderBy('streetAddress', 'DESC')->paginate(15);
            } elseif ($rooms && $price) {
                $apartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->where("price_per_night", "<=", "$price")->orderBy('streetAddress', 'DESC')->paginate(15);
            } elseif ($picked) {
                $apartments = Apartment::whereHas('tags', function ($query) use ($picked) {
                    $query->whereIn('tag_id', $picked)->where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC');
                })->paginate(15);
            } elseif ($beds){
                $apartments = Apartment::where("isVisible", "=", "1")->where("bed_numbers", "=", "$beds")->orderBy('streetAddress', 'DESC')->paginate(15);
            } elseif ($rooms){
                $apartments = Apartment::where("isVisible", "=", "1")->where("room_numbers", "=", "$rooms")->orderBy('streetAddress', 'DESC')->paginate(15);
            } elseif ($price){
                $apartments = Apartment::where("isVisible", "=", "1")->where("price_per_night", "<=", "$price")->orderBy('streetAddress', 'DESC')->paginate(15);
            } else {
                $apartments = Apartment::where("isVisible", "=", "1")->orderBy('streetAddress', 'DESC')->paginate(15);
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
            // ->with('category', 'user')
            // ->withCount('favorites')
            // ->find($apartmentDetails->id)
            ->first();

            if (!$apartmentDetails) {
                abort(404);
            }

            // $apart = Apartment::with('category', 'user')
            //         ->withCount('favorites')
            //         ->find($apart->id);

            if($apartmentDetails->showApartment()){// this will test if the user viwed the post or not
                return response()->json($apartmentDetails);
            }

            $apartmentDetails->increment('views');//I have a separate column for views in the post table. This will increment the views column in the posts table.
            ApartmentView::createViewLog($apartmentDetails);

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
