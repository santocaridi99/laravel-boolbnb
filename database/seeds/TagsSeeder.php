<?php

use App\Tag;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsSeeder extends Seeder
{
    public function run()
    {

        //Creo un array semplice di tag da pushare a db
        $tags = [
            'Piscina',
            'Cortile',
            'Colazione inclusa',
            'Vista mare',
            'Posto auto',
            'Ingresso privato',
            'Patio o balcone',
            'TV',
            'Wi-fi',
            'Riscaldamenti',
            'Aria condizionata',
            'Vicino al centro'
        ];

        //cancella tutte le righe della tabella, resettando l'id autoincrementale.
        /*  Tag::truncate(); */


        /* 
            Per ogni tag presente nell'array tags, 
            genero una nuova istanza di Tag,
            dopodiché ne popolo i campi e li salvo.
        */
        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag);

            $newTag->save();
        }
    }
}
