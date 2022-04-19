<?php

use App\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = [
            [
                'Appartamento al Colosseo',
                'Appartamento nel centro di Roma. Giardino privato, aria condizionata, riscaldamento, WiFi, Netflix, smart TV 50, colazione inclusi nel prezzo!',
                '1',
                '4',
                '4',
                '2',
                60,
                'public/img/img1.webp',
                50,
                'Italia',
                'RM',
                'Roma',
                'Via Plinio, 25, 00193',
                '12.465',
                '41.90717',
                '1'
            ],
            [
                'Monolocale indipendente con bagno privato',
                'Tutti, senza distinzioni, siete i benvenuti nel mio monolocale con bagno privato in uno dei quartieri più vivaci e centrali della Roma popolare!',
                '1',
                '3',
                '3',
                '1',
                40, 
                'public/img/img2.webp',
                36,
                'Italia',
                'RM',
                'Roma',
                'Via Cola di Rienzo, 140, 00193',
                '12.46557',
                '41.90793',
                '1'
            ],
            [
                'Suite Termini con Balcone, Wi-Fi e A/C',
                'B&B nel cuore di Roma a soli 5 minuti a piedi dalla Stazione Termini. Bellissima camera con balcone, tv 32", luce per lettura, bagno in camera, materasso in Memory, appendiabiti!',
                '1',
                '4',
                '3',
                '1',
                60,
                'public/img/img3.webp',
                56,
                'Italia',
                'RM',
                'Roma',
                'Via Nicola Ricciotti, 4, 00195',
                '12.46529',
                '41.91455',
                '1'
            ],
            [
                'Splendido Loft Appartamento',
                'Il mio loft e\' uno spazio ricavato in palazzo del XXVI secolo nel cuore di Roma unico e accogliente',
                '1',
                '3',
                '3',
                '2',
                67,
                'public/img/img4.webp',
                76,
                'Italia',
                'RM',
                'Roma',
                'Via Costabella, 28, 00195',
                '12.46378',
                '41.92127',
                '1'
            ],
            [
                'Rooms near the Trastevere station',
                'Ampia camera in appartamento vicino stazione Fs Trastevere : linee per Torino, Genova , Civitavecchia, linea per Fiumicino, Linea Viterbo, linea Roma Tiburtina, vicino fermata dei tram 8 e 3 , nonchè di moltri bus per il centro. Molti locali notturni e ristoranti e supermercati nelle vicinanze.',
                '1',
                '2',
                '3',
                '2',
                53,
                'public/img/img5.webp',
                66,
                'Italia',
                'RM',
                'Roma',
                'Via delle Fratte di Trastevere, 51, 00153',
                '12.47199',
                '41.88809',
                '1'
            ],
            [
                'Casa LUNA-Accomodation in Santa Maria Maggiore',
                'Casa LUNA-Accomodation si trova a 250 metri dalla metropolitana Vittorio Emanuele a 200 metri dalla basilica di Santa Maria Maggiore a 200 metri dalla stazione ferroviaria Termini e 1,2 km dal Colosseo.',
                '1',
                '3',
                '4',
                '2',
                63,
                'public/img/img6.webp',
                88,
                'Italia',
                'RM',
                'Roma',
                'Via di Santa Dorotea, 14, 00153',
                '12.46814',
                '41.89209',
                '1'
            ],
            [
                'Ponte Milvio - little and lovely apartment',
                'Piccolo appartamento, ideale per coppie, famiglie con figli piccoli o gruppi di giovani. Dotato di camera da letto matrimoniale, cucina attrezzata, soggiorno con divano letto e TV, tavolo da pranzo, bagno con wc, bidet e doccia. Anche un piacevole terrazzo, dover poter fare colazioni e cene.',
                '1',
                '3',
                '2',
                '3',
                63,
                'public/img/img7.webp',
                68,
                'Italia',
                'RM',
                'Roma',
                'Via Torino, 146, 00184',
                '12.49662',
                '41.90057',
                '1'
            ],
            [
                'Appartamento luminoso vicino a Villa Borghese',
                'L\'appartamento si trova all\'ultimo piano di un edificio dei primi del \'900 con ascensore: si compone di soggiorno, cucina, bagno con doccia e camera da letto matrimoniale. Dista poche fermate di bus dalla stazione Termini, è molto ben collegato al centro storico.',
                '1',
                '2',
                '2',
                '2',
                43,
                'public/img/img8.webp',
                58,
                'Italia',
                'RM',
                'Roma',
                'Via Lazio, 6, 00187',
                '12.48863',
                '41.90879',
                '1'
            ],
            [
                'Mini apartment with garden & wifi',
                'Metro station Battistini is a 5 minute walk away. In maximum 15 minutes you are in the center of Rome at the Spanish Steps or at the Vatican.',
                '1',
                '4',
                '5',
                '3',
                83,
                'public/img/img9.webp',
                98,
                'Italia',
                'RM',
                'Roma',
                'Via delle Carrozze, 44, 00187',
                '12.48140',
                '41.90617',
                '1'
            ],
            [
                'Appartamento nel cuore di Napoli luminoso e intimo',
                'Appartamento luminoso, intimo e silenziosissimo in posizione centrale, a pochi passi dalla metropolitana, Orto Botanico, tutti i musei e attrazioni principali del centro storico.',
                '1',
                '5',
                '2',
                '3',
                73,
                'public/img/img10.webp',
                88,
                'Italia',
                'NA',
                'Napoli',
                'Corso Umberto I, 257, 80133',
                '14.26383',
                '40.84868',
                '1'
            ],
            [
                'Suite Monolocale a Rimini Marina Centro',
                'A Rimini Marina Centro c’è una novità: Rimini Bay Suite & Residence. 12 appartamenti, tutti completamente ristrutturati a fine 2019, capaci di ospitare da 2 fino a 7 persone e caratterizzati ognuno da arredi, finiture e servizi esclusivi.',
                '1',
                '4',
                '3',
                '3',
                63,
                'public/img/img11.webp',
                68,
                'Italia',
                'RN',
                'Rimini',
                'Viale Misurata, 7, 47921',
                '12.58342',
                '44.06482',
                '1'
            ],
            [
                'Casa nuova con giardino,bici, a 800mt mare/fiera',
                'Appartamento fra mare e verde, rinnovato completamente in casa bifamiliare: cucina abitabile, due matrimoniali, terza camera x gioco o eventuale lettino per bimbi, sala con divano letto singolo, ampi spazi esterni per pranzare, giardino, 2 posti auto.',
                '1',
                '4',
                '4',
                '2',
                73,
                'public/img/img12.webp',
                88,
                'Italia',
                'RN',
                'Rimini',
                'Viale Tripoli, 258, 47921',
                '12.58416',
                '44.06295', 
                '1'
            ],
        ]; 
        
        foreach ($apartments as $apartment) {
            $newApartment = new Apartment;
            
            $newApartment->title = $apartment[0];
            $newApartment->description = $apartment[1];
            $newApartment->isVisible = $apartment[2];
            $newApartment->room_numbers = $apartment[3];
            $newApartment->bed_numbers = $apartment[4];
            $newApartment->bathroom_numbers = $apartment[5];
            $newApartment->square_meters = $apartment[6];
            $newApartment->cover = $apartment[7];
            $newApartment->price_per_night = $apartment[8];
            $newApartment->country = $apartment[9];
            $newApartment->region = $apartment[10];
            $newApartment->province = $apartment[11];
            $newApartment->streetAddress = $apartment[12];
            $newApartment->longitude = $apartment[13];
            $newApartment->latitude = $apartment[14];
            $newApartment->user_id = $apartment[15];
            $newApartment->slug = Str::slug($newApartment->title);

            $newApartment->save();
    };
}
}
