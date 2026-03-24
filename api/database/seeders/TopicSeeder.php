<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = [
            ['de' => 'Aussenpolitik', 'fr' => 'Politique étrangère', 'it' => 'Politica estera'],
            ['de' => 'Europapolitik (EU)', 'fr' => 'Politique européenne (UE)', 'it' => 'Politica europea (UE)'],
            ['de' => 'Demokratie & Institutionen', 'fr' => 'Démocratie & Institutions', 'it' => 'Democrazia e istituzioni'],
            ['de' => 'Föderalismus', 'fr' => 'Fédéralisme', 'it' => 'Federalismo'],
            ['de' => 'Menschenrechte', 'fr' => 'Droits humains', 'it' => 'Diritti umani'],
            ['de' => 'Bürgerrechte & Freiheiten', 'fr' => 'Droits civiques & Libertés', 'it' => 'Diritti civili e libertà'],
            ['de' => 'Wirtschaft', 'fr' => 'Économie', 'it' => 'Economia'],
            ['de' => 'Finanzen & Steuern', 'fr' => 'Finances & Impôts', 'it' => 'Finanze e imposte'],
            ['de' => 'Arbeitsmarkt', 'fr' => 'Marché du travail', 'it' => 'Mercato del lavoro'],
            ['de' => 'Staatsausgaben', 'fr' => 'Dépenses publiques', 'it' => 'Spese pubbliche'],
            ['de' => 'Zoll & Freihandel', 'fr' => 'Douanes & Libre-échange', 'it' => 'Dogane e libero scambio'],
            ['de' => 'Konsumentenschutz', 'fr' => 'Protection des consommateurs', 'it' => 'Protezione dei consumatori'],
            ['de' => 'Gesundheit', 'fr' => 'Santé', 'it' => 'Sanità'],
            ['de' => 'Krankenkassenprämien', 'fr' => 'Primes d\'assurance-maladie', 'it' => 'Premi di cassa malati'],
            ['de' => 'Altersvorsorge (AHV/BVG)', 'fr' => 'Prévoyance vieillesse (AVS/LPP)', 'it' => 'Previdenza per la vecchiaia (AVS/LPP)'],
            ['de' => 'Sozialpolitik', 'fr' => 'Politique sociale', 'it' => 'Politica sociale'],
            ['de' => 'Familienpolitik', 'fr' => 'Politique familiale', 'it' => 'Politica familiare'],
            ['de' => 'Gleichstellung', 'fr' => 'Égalité', 'it' => 'Uguaglianza'],
            ['de' => 'Drogenpolitik', 'fr' => 'Politique en matière de drogues', 'it' => 'Politica in materia di droghe'],
            ['de' => 'Umwelt & Naturschutz', 'fr' => 'Environnement & Protection de la nature', 'it' => 'Ambiente e protezione della natura'],
            ['de' => 'Klima & CO2', 'fr' => 'Climat & CO2', 'it' => 'Clima e CO2'],
            ['de' => 'Energie', 'fr' => 'Énergie', 'it' => 'Energia'],
            ['de' => 'Verkehr & Mobilität', 'fr' => 'Transports & Mobilité', 'it' => 'Trasporti e mobilità'],
            ['de' => 'Öffentlicher Verkehr', 'fr' => 'Transports publics', 'it' => 'Trasporti pubblici'],
            ['de' => 'Raumplanung & Wohnen', 'fr' => 'Aménagement du territoire & Logement', 'it' => 'Pianificazione del territorio e abitazione'],
            ['de' => 'Landwirtschaft', 'fr' => 'Agriculture', 'it' => 'Agricoltura'],
            ['de' => 'Tierschutz', 'fr' => 'Protection des animaux', 'it' => 'Protezione degli animali'],
            ['de' => 'Migration & Asyl', 'fr' => 'Migration & Asile', 'it' => 'Migrazione e asilo'],
            ['de' => 'Integration', 'fr' => 'Intégration', 'it' => 'Integrazione'],
            ['de' => 'Sicherheit & Armee', 'fr' => 'Sécurité & Armée', 'it' => 'Sicurezza ed esercito'],
            ['de' => 'Justiz & Recht', 'fr' => 'Justice & Droit', 'it' => 'Giustizia e diritto'],
            ['de' => 'Kriminalität & Polizei', 'fr' => 'Criminalité & Police', 'it' => 'Criminalità e polizia'],
            ['de' => 'Bildung & Forschung', 'fr' => 'Formation & Recherche', 'it' => 'Formazione e ricerca'],
            ['de' => 'Digitalisierung & Netzpolitik', 'fr' => 'Numérisation & Politique de réseau', 'it' => 'Digitalizzazione e politica della rete'],
            ['de' => 'Datenschutz', 'fr' => 'Protection des données', 'it' => 'Protezione dei dati'],
            ['de' => 'Medienpolitik', 'fr' => 'Politique des médias', 'it' => 'Politica dei media'],
            ['de' => 'Kultur', 'fr' => 'Culture', 'it' => 'Cultura'],
            ['de' => 'Sport', 'fr' => 'Sport', 'it' => 'Sport'],
            ['de' => 'Tourismus', 'fr' => 'Tourisme', 'it' => 'Turismo'],
            ['de' => 'Religion & Kirche', 'fr' => 'Religion & Église', 'it' => 'Religione e chiesa'],
            ['de' => 'Regionalpolitik (Stadt/Land)', 'fr' => 'Politique régionale (Ville/Campagne)', 'it' => 'Politica regionale (Città/Campagna)'],
            ['de' => 'Entwicklungshilfe', 'fr' => 'Aide au développement', 'it' => 'Aiuto allo sviluppo'],
        ];

        foreach ($topics as $translations) {
            Topic::updateOrCreate(
                ['name->de' => $translations['de']],
                ['name' => $translations]
            );
        }

        $this->command->info('42 Topics seeded successfully!');
    }
}
