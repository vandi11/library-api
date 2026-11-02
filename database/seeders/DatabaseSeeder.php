<?php

namespace Database\Seeders;

use App\Models\Konyv;
use App\Models\Olvaso;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $olvaso1 = Olvaso::updateOrCreate(
            ['email' => 'anna.kiss@example.com'],
            ['nev' => 'Kiss Anna'],
        );
        $olvaso2 = Olvaso::updateOrCreate(
            ['email' => 'bela.nagy@example.com'],
            ['nev' => 'Nagy Béla'],
        );

        $konyvek = [
            ['isbn' => '9789634057001', 'cim' => 'Pál utcai fiúk', 'szerzo' => 'Molnár Ferenc', 'kiadas_eve' => 1906, 'olvaso_id' => $olvaso1->id],
            ['isbn' => '9789631432437', 'cim' => 'Egri csillagok', 'szerzo' => 'Gárdonyi Géza', 'kiadas_eve' => 1899, 'olvaso_id' => $olvaso2->id],
            ['isbn' => '9789630796500', 'cim' => 'A kis herceg', 'szerzo' => 'Antoine de Saint-Exupéry', 'kiadas_eve' => 1943, 'olvaso_id' => null],
            ['isbn' => '9789635044769', 'cim' => 'Abigél', 'szerzo' => 'Szabó Magda', 'kiadas_eve' => 1970, 'olvaso_id' => null],
            ['isbn' => '9789634051233', 'cim' => 'Tüskevár', 'szerzo' => 'Fekete István', 'kiadas_eve' => 1957, 'olvaso_id' => null],
        ];

        foreach ($konyvek as $adatok) {
            Konyv::updateOrCreate(['isbn' => $adatok['isbn']], $adatok);
        }
    }
}
