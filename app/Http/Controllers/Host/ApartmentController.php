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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ApartmentController extends Controller
{
    use SlugGenerator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where("user_id", Auth::user()->id)
            ->get();
        return view("host.apartments.index", compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment)
    {
        $tags = Tag::all();
        /*  $images = Image::where("apartment_id", $apartment->id)
            ->get(); */

        return view("host.apartments.create", compact("tags", "apartment"));
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
            "title" => "required|min:5|max:35",
            "description" => "required|min:20",
            "room_numbers" => "required|integer|between:1,100",
            "bed_numbers" => "required|integer|between:1,100",
            "bathroom_numbers" => "required|integer|between:1,100",
            "square_meters" => "required|integer|min:0",
            "cover" => "required|mimes:jpeg,bmp,png",
            "price_per_night" => "required|numeric|min:0",
            "country" => "required|regex:/^[\pL\s\-]+$/u",
            "region" => "required|regex:/^[\pL\s\-]+$/u",
            "province" => "required|regex:/^[\pL\s\-]+$/u",
            /* "city" => "required|regex:/^[\pL\s\-]+$/u",
            "street" => "required|string",
            "street_number" => "required|integer|between:1,15000", */
            "streetAddress" => "required|string",
            // "post_code" =>  "required|string|min:5|max:5",
            "tags" => "required|exists:tags,id",
            "latitude" => "required",
            "longitude" => "required",
            "images" => "nullable",
            "images.*" => "nullable|mimes:jpeg,bmp,png",
            'isVisible' => 'boolean'
        ]);

        $apartment = new Apartment();


        $apartment->fill($data);

        // Genero lo slug partendo dal titolo
        $slug = Str::slug($apartment->title);

        // controllo a db se esiste già un elemento con lo stesso slug
        $exists = Apartment::where("slug", $slug)->first();
        $counter = 1;

        // Fintanto che $exists ha un valore diverso da null o false,
        // eseguo il while
        while ($exists) {
            // Genero un nuovo slug, prendendo quello precedente e concatenando un numero incrementale
            $newSlug = $slug . "-" . $counter;
            $counter++;

            // controllo a db se esiste già un elemento con i nuovo slug appena generato
            $exists = Apartment::where("slug", $newSlug)->first();

            // Se non esiste, salvo il nuovo slug nella variabile $slub che verrà poi usata
            // per assegnare il valore all'interno del nuovo post.
            if (!$exists) {
                $slug = $newSlug;
            }
        }

        // Assegno il valore di slug al nuovo post
        $apartment->slug = $slug;
        $apartment->user_id = Auth::user()->id;

        if (key_exists("cover", $data)) {
            $apartment->cover = Storage::put("coversImg", $data["cover"]);
        }
        $apartment->save();

        //TUTTE LE RELAZIONI VANNO INSERITE DOPO IL SAVE
        if (key_exists("tags", $data)) {
            $apartment->tags()->attach($data["tags"]);
        }

        // se la request ha dei file in images
        if ($request->hasFile("images")) {
            // passo ad una variabile files la request delle immagini
            $files = $request->file("images");
            // per ogni file in files
            foreach ($files as $file) {
                // assegno ad una variabile name il nome del file
                // che passo tramite la funzione getClientOriginalName
                /* $name = $file->getClientOriginalName(); */
                $name = 'image-' . time() . rand(1, 1000) . '.' . $file->extension();
                // sposto il file in una cartella image dove passo il nome del file completo
                $file->move('image', $name);
                // in apartment  images creo un istanza Image con create
                // passo all'istanza il valore di $name al campo images della tabella mages
                $apartment->images()->create(['images' => $name]);
            }
        }


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
            "title" => "required|min:5|max:35",
            "description" => "required|min:20",
            "room_numbers" => "required|integer|between:1,100",
            "bed_numbers" => "required|integer|between:1,100",
            "bathroom_numbers" => "required|integer|between:1,100",
            "square_meters" => "required|integer|min:0",
            "cover" => "nullable|mimes:jpeg,bmp,png",
            "price_per_night" => "required|numeric|min:0",
            "country" => "required|regex:/^[\pL\s\-]+$/u",
            "region" => "required|regex:/^[\pL\s\-]+$/u",
            "province" => "required|regex:/^[\pL\s\-]+$/u",
            /* "city" => "required|regex:/^[\pL\s\-]+$/u",
            "street" => "required|string",
            "street_number" => "required|integer|between:1,15000", */
            "streetAddress" => "required|string",
            // "post_code" =>  "required|string|min:5|max:5",
            "tags" => "required|exists:tags,id",
            "latitude" => "required",
            "longitude" => "required",
            "images" => "nullable",
            "images.*" => "nullable|mimes:jpeg,bmp,png",
            'isVisible' => 'boolean'
        ]);

        $apartment = Apartment::findOrFail($id);
        if ($data["title"] !== $apartment->title) {
            $data["slug"] = $this->generateUniqueSlug($data["title"]);
        }


        if (key_exists("cover", $data)) {
            if ($apartment->cover) {
                Storage::delete($apartment->cover);
            }
            $coverImg = Storage::put("coversImg", $data["cover"]);

            $apartment->cover = $coverImg;
            $apartment->save();
        }
        $apartment->update($data);

        if (key_exists("tags", $data)) {
            // Aggiorniamo anche la tabella apartment_tag

            // Per l'appartamento corrente, aggiungo le relazioni con i tag ricevuti

            // I tag che c'erano prima e ci sono anche ora, non verranno toccati.
            $apartment->tags()->sync($data["tags"]);
        } else {
            $apartment->tags()->detach();
        }
        // gestito come le cover
        // se la richiesta ha le immagini  
        // svolgo le seguenti operazioni
        // se ho già elementi nell'appartamento , cancello questa parte di request $apartment->images()
        // altrimenti procede normalmente e salva le immagini uplodate come da procedimento sulla funzione store.
        if ($request->hasFile("images")) {
            if ($apartment->images) {
                $apartment->images()->delete();
            }
            $images = $request->file("images");
            foreach ($images as $image) {
                $name = 'image-' . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move('image', $name);
                $apartment->images()->create(['images' => $name]);
            }
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
        // appartamenti cestinati (in softdelete)
        $apartment = Apartment::withTrashed()->findOrFail($id);
        // elimino i collegamenti con tabella tags
        $apartment->tags()->detach();
        $apartment->images()->delete();

        if ($apartment->cover) {
            Storage::delete($apartment->cover);
        }

        if ($apartment->images) {
            $images = $apartment->images();
            foreach ($images as $image) {
                Storage::delete("images/{$image}");
            }
        }

        // $images = explode(",", $apartment->images);

        // foreach ($images as $image) {
        //     Storage::delete("images/{$image}");
        // }
        // elemento verrà completamente eliminato
        $apartment->forceDelete();
        return redirect()->route("host.apartments.index");
    }

    public function deletedApartments()
    {
        // raccolgo solo gli appartamenti cestinati
        $apartments = Apartment::where('user_id', Auth::user()->id)->onlyTrashed()->get();
        // ritorno una view dove li mostra
        return view("host.apartments.deletedApartments", compact('apartments'));
    }

    // soft delete function
    public function softDeleteApartment($id)
    {
        // faccio findOrFail di un appartamento
        $apartment = Apartment::findOrFail($id);
        // faccio un soft delete
        $apartment->delete();
        // reiderizza nella pagina degli appartamento cancellati
        return redirect()->route('host.apartments.deletedApartments');
    }

    // restore degli appartamenti cancellati
    public function restoreApartment($id)
    {
        // appartamenti cestinati (in softdelete)
        $apartment = Apartment::withTrashed()->findOrFail($id);
        // restore
        $apartment->restore();
        // redirect alla pagina deletedApartment
        return redirect()->route("host.apartments.deletedApartments");
    }
}
