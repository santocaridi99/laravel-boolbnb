<?php

use App\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipsSeeder extends Seeder
{
    public function run()
    {
        //Creo un array di oggetti
        $sponsorPlans = [
            ["type" => "Standard", "duration" => "24 ore", "price" => 2.99],
            ["type" => "Plus", "duration" => "72 ore", "price" => 5.99],
            ["type" => "Premium", "duration" => "144 ore", "price" => 9.99],
        ];

        /* 
            Premessa: IL FILL NON è IL FILLABLE!

            Per ogni oggetto presente nell'array di oggetti creo un'istanza, 
            riempio il model con un array di attributi attraverso il fill, 
            salvandoli tramite la funzione save(). 
        */
        foreach ($sponsorPlans as $plan) {
            $newPlan = new Sponsorship();

            $newPlan->fill($plan);
            $newPlan->save();
        }
    }
}
