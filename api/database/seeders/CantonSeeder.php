<?php

namespace Database\Seeders;

use App\Models\Canton;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CantonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cantons = [
            ['name' => ["de" => "Aargau", "fr" => "Argovie", "it" => "Argovia"], 'abbreviation' => 'AG'],
            ['name' => ["de" => "Appenzell Ausserrhoden", "fr" => "Appenzell Rhodes-Extérieures", "it" => "Appenzello Esterno"], 'abbreviation' => 'AR'],
            ['name' => ["de" => "Appenzell Innerrhoden", "fr" => "Appenzell Rhodes-Intérieures", "it" => "Appenzello Interno"], 'abbreviation' => 'AI'],
            ['name' => ["de" => "Basel-Landschaft", "fr" => "Bâle-Campagne", "it" => "Basilea Campagna"], 'abbreviation' => 'BL'],
            ['name' => ["de" => "Basel-Stadt", "fr" => "Bâle-Ville", "it" => "Basilea Città"], 'abbreviation' => 'BS'],
            ['name' => ["de" => "Bern", "fr" => "Berne", "it" => "Berna"], 'abbreviation' => 'BE'],
            ['name' => ["de" => "Fribourg", "fr" => "Fribourg", "it" => "Friburgo"], 'abbreviation' => 'FR'],
            ['name' => ["de" => "Genf", "fr" => "Genève", "it" => "Ginevra"], 'abbreviation' => 'GE'],
            ['name' => ["de" => "Glarus", "fr" => "Glaris", "it" => "Glarona"], 'abbreviation' => 'GL'],
            ['name' => ["de" => "Graubünden", "fr" => "Grisons", "it" => "Grigioni"], 'abbreviation' => 'GR'],
            ['name' => ["de" => "Jura", "fr" => "Jura", "it" => "Giura"], 'abbreviation' => 'JU'],
            ['name' => ["de" => "Luzern", "fr" => "Lucerne", "it" => "Lucerna"], 'abbreviation' => 'LU'],
            ['name' => ["de" => "Neuenburg", "fr" => "Neuchâtel", "it" => "Neuchâtel"], 'abbreviation' => 'NE'],
            ['name' => ["de" => "Nidwalden", "fr" => "Nidwald", "it" => "Nidvaldo"], 'abbreviation' => 'NW'],
            ['name' => ["de" => "Obwalden", "fr" => "Obwald", "it" => "Obvaldo"], 'abbreviation' => 'OW'],
            ['name' => ["de" => "St. Gallen", "fr" => "Saint-Gall", "it" => "San Gallo"], 'abbreviation' => 'SG'],
            ['name' => ["de" => "Schaffhausen", "fr" => "Schaffhouse", "it" => "Sciaffusa"], 'abbreviation' => 'SH'],
            ['name' => ["de" => "Schwyz", "fr" => "Schwytz", "it" => "Svitto"], 'abbreviation' => 'SZ'],
            ['name' => ["de" => "Solothurn", "fr" => "Soleure", "it" => "Soletta"], 'abbreviation' => 'SO'],
            ['name' => ["de" => "Thurgau", "fr" => "Thurgovie", "it" => "Turgovia"], 'abbreviation' => 'TG'],
            ['name' => ["de" => "Tessin", "fr" => "Tessin", "it" => "Ticino"], 'abbreviation' => 'TI'],
            ['name' => ["de" => "Uri", "fr" => "Uri", "it" => "Uri"], 'abbreviation' => 'UR'],
            ['name' => ["de" => "Waadt", "fr" => "Vaud", "it" => "Vaud"], 'abbreviation' => 'VD'],
            ['name' => ["de" => "Wallis", "fr" => "Valais", "it" => "Vallese"], 'abbreviation' => 'VS'],
            ['name' => ["de" => "Zug", "fr" => "Zoug", "it" => "Zugo"], 'abbreviation' => 'ZG'],
            ['name' => ["de" => "Zürich", "fr" => "Zurich", "it" => "Zurigo"], 'abbreviation' => 'ZH']
        ];
        Canton::truncate();
        foreach ($cantons as $canton) {
            Canton::create($canton);
        }
    }
}
