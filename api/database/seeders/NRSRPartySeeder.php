<?php

namespace Database\Seeders;

use App\Models\Party;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NRSRPartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed parties in the national council (NR) and the council of states (SR) of swiss parliament with their respective abbreviations and full names
        // German names and abbreviations:
        // Sozialdemokratische Partei der Schweiz	SP
        // GRÜNE Schweiz	Grüne
        // Schweizerische Volkspartei	SVP
        // Die Mitte	M-E
        // Grünliberale Partei	GLP
        // FDP.Die Liberalen	FDP
        // Lega dei Ticinesi	Lega
        // Mouvement Citoyens Genevois	MCG
        // Evangelische Volkspartei der Schweiz	EVP
        // Eidgenössisch-Demokratische Union	EDU
        // Alternative-die Grünen Kanton Zug	AL Zug
        // Liberal-Demokratische Partei	LDP

        $parties = [
            [
                "name" => [
                    "de" => "Sozialdemokratische Partei",
                    "fr" => "Parti socialiste",
                    "it" => "Partito Socialista",
                ],
                "abbreviation" => [
                    "de" => "SP",
                    "fr" => "PS",
                    "it" => "PS",
                ],
                "color" => "#FF0000",
            ],
            [
                "name" => [
                    "de" => "GRÜNE",
                    "fr" => "Les Verts",
                    "it" => "I Verdi",
                ],
                "abbreviation" => [
                    "de" => "Grüne",
                    "fr" => "Verts",
                    "it" => "Verdi",
                ],
                "color" => "#03F21A",
            ],
            [
                "name" => [
                    "de" => "Schweizerische Volkspartei",
                    "fr" => "Union démocratique du centre",
                    "it" => "Unione Democratica di Centro",
                ],
                "abbreviation" => [
                    "de" => "SVP",
                    "fr" => "UDC",
                    "it" => "UDC",
                ],
                "color" => "#007832",
            ],
            [
                "name" => [
                    "de" => "Die Mitte",
                    "fr" => "Le Centre",
                    "it" => "Il Centro",
                ],
                "abbreviation" => [
                    "de" => "Mitte",
                    "fr" => "Centre",
                    "it" => "Centro",
                ],
                "color" => "#F77103",
            ],
            [
                "name" => [
                    "de" => "Grünliberale Partei",
                    "fr" => "Parti vert’libéral",
                    "it" => "Partito Verde Liberale",
                ],
                "abbreviation" => [
                    "de" => "GLP",
                    "fr" => "PVL",
                    "it" => "PVL",
                ],
                "color" => "#740E72",
            ],
            [
                "name" => [
                    "de" => "FDP.Die Liberalen",
                    "fr" => "Parti libéraux-radicaux",
                    "it" => "Partito Liberale Radicale",
                ],
                "abbreviation" => [
                    "de" => "FDP",
                    "fr" => "PLR",
                    "it" => "PLR",
                ],
                "color" => "#0044D4",
            ],
            [
                "name" => [
                    "de" => "Lega dei Ticinesi",
                    "fr" => "Lega dei Ticinesi",
                    "it" => "Lega dei Ticinesi",
                ],
                "abbreviation" => [
                    "de" => "Lega",
                    "fr" => "Lega",
                    "it" => "Lega",
                ],
                "color" => "#007832",
            ],
            [
                "name" => [
                    "de" => "Mouvement Citoyens Genevois",
                    "fr" => "Mouvement Citoyens Genevois",
                    "it" => "Mouvement Citoyens Genevois",
                ],
                "abbreviation" => [
                    "de" => "MCG",
                    "fr" => "MCG",
                    "it" => "MCG",
                ],
                "color" => "#007832",
            ],
            [
                "name" => [
                    "de" => "Evangelische Volkspartei der Schweiz",
                    "fr" => "Parti évangélique suisse",
                    "it" => "Partito Evangelico Svizzero",
                ],
                "abbreviation" => [
                    "de" => "EVP",
                    "fr" => "PEV",
                    "it" => "PEV",
                ],
                "color" => "#F77103",
            ],
            [
                "name" => [
                    "de" => "Eidgenössisch-Demokratische Union",
                    "fr" => "Union démocratique fédérale",
                    "it" => "Unione Democratica Federale",
                ],
                "abbreviation" => [
                    "de" => "EDU",
                    "fr" => "UDF",
                    "it" => "UDF",
                ],
                "color" => "#007832",
            ],
            [
                "name" => [
                    "de" => "Alternative-die Grünen Kanton Zug",
                    "fr" => "Alternative-les Verts Canton de Zoug",
                    "it" => "Alternative-i Verdi Cantone di Zugo",
                ],
                "abbreviation" => [
                    "de" => "ALG Zug",
                    "fr" => "ALG Zug",
                    "it" => "ALG Zug",
                ],
                "color" => "#03F21A",
            ],
            [
                "name" => [
                    "de" => "Liberal-Demokratische Partei",
                    "fr" => "Liberal-Demokratische Partei",
                    "it" => "Liberal-Demokratische Partei",
                ],
                "abbreviation" => [
                    "de" => "LDP",
                    "fr" => "LDP",
                    "it" => "LDP",
                ],
                "color" => "#0044D4",
            ],
        ];
        Party::truncate();
        foreach ($parties as $party) {
            Party::create($party);
        }
    }
}
