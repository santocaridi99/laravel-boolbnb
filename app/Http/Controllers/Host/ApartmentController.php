<?php

namespace App\Http\Controllers\Host;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Image;
use App\Tag;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller {
    use SlugGenerator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartment = Apartment::where("user_id", Auth::user()->id)
        ->get();
        return view("host.apartments.index", compact("apartment"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment)
    {
        $tags = Tag::all();
        $images = Image::where("apartment_id", $apartment->id)
        ->get();

        return view("host.apartments.create", compact("tags", "images"));
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
            "title" => "required|min:5|max:100",
            "description" => "required|min:20|max:255",
            "room_numbers" => "required",
            "bed_numbers" => "required",
            "bathroom_numbers" => "required",
            "square_meters" => "required",
            "cover" => "required|mimes:jpg,jpeg,png,bmp|max:500",
            "price_per_night" => "required",
            "country" => "required",
            "region" => "required",
            "province" => "required",
            "city" => "required",
            "street" => "required",
            "street_number" => "required",
            "post_code" => "required",
            "tags" => "nullable|exists:tags,id",
            "images" => "nullable|mimes:jpg,jpeg,png,bmp|max:500"
        ]);

        $apartment = new Apartment();
        $apartment->fill($data);
        $apartment->slug = $this->generateUniqueSlug($apartment["title"]);
        $apartment->save();

        if (key_exists("tags", $data)) {
            $apartment->tags()->attach($data["tags"]);
          };

        // if (key_exists("cover", $data)) {
        // $apartment->cover = Storage::put("cover", $data["cover"]);
        // }

          return redirect()->route("host.apartments.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $apartment = Apartment::where("slug", $slug)->first();

        return view("host.apartments.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $apartment = Apartment::where("slug", $slug)->first();
        $tags = Tag::all();

        return view("host.apartments.edit", compact("apartment", "tags"));
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
        $data = $request->validate([
            "title" => "required|min:5|max:100",
            "description" => "required|min:20|max:255",
            "room_numbers" => "required",
            "bed_numbers" => "required",
            "bathroom_numbers" => "required",
            "square_meters" => "required",
            "cover" => "required|mimes:jpg,jpeg,png,bmp|max:500",
            "price_per_night" => "required",
            "country" => "required",
            "region" => "required",
            "province" => "required",
            "city" => "required",
            "street" => "required",
            "street_number" => "required",
            "post_code" => "required",
            "tags" => "nullable|exists:tags,id",
            "images" => "nullable|mimes:jpg,jpeg,png,bmp|max:500"
        ]);

        $apartment = Apartment::findOrFail($id);
        if ($data["title"] !== $apartment->title) {
            $data["slug"] = $this->generateUniqueSlug($data["title"]);
        }
        $apartment->update($data);
        if (key_exists("cover", $data)) {
            // controllare se a db esiste già un immagine
            // Se si, PRIMA di caricare quella nuova, cancelliamo quella vecchia
            if ($apartment->cover) {
              Storage::delete($apartment->cover);
            }
      
            $cover = Storage::put("cover", $data["cover"]);
      
            $apartment->cover = $cover;
            $apartment->save();
          }
      
          if (key_exists("tags", $data)) {
            // Aggiorniamo anche la tabella apartment_tag
            
            // Per l'appartamento corrente, aggiungo le relazioni con i tag ricevuti
      
            // I tag che c'erano prima e ci sono anche ora, non verranno toccati.
            $apartment->tags()->sync($data["tags"]);
          }
      
          return redirect()->route("host.apartments.show", $apartment->slug);
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
