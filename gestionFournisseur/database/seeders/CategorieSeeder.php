<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['codeSousCategorie' => '1.1.1', 'nom' => 'Bâtiments résidentiels neufs visés par un plan de garantie, classe I', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.1.2', 'nom' => 'Bâtiments résidentiels neufs visés par un plan de garantie, classe II', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.10', 'nom' => 'Remontées mécaniques', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.2', 'nom' => 'Petits Bâtiments', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.3', 'nom' => 'Bâtiments de tout genre', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.4', 'nom' => 'Routes et canalisation', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.5', 'nom' => 'Structures d’ouvrages de génie civil', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.6', 'nom' => 'Ouvrages de génie civil immergés', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.7', 'nom' => 'Télécommunication, transport, transformation et distribution d’énergie électrique', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.8', 'nom' => 'Installation d’équipement pétrolier', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '1.9', 'nom' => 'Mécanique du bâtiment', 'nomCategorie' => 'Général'],
            ['codeSousCategorie' => '10', 'nom' => 'Systèmes de chauffage localisé à combustible solide', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '11.1', 'nom' => 'Tuyauterie industrielle ou institutionnelle sous pression', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '11.2', 'nom' => 'Équipements et produits spéciaux', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '12', 'nom' => 'Armoires et comptoirs usinés', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '13.1', 'nom' => 'Protection contre la foudre', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '13.2', 'nom' => 'Systèmes d’alarme incendie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '13.3', 'nom' => 'Systèmes d’extinction d’incendie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '13.4', 'nom' => 'Systèmes localisés d’extinction incendie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '13.5', 'nom' => 'Installations spéciales ou préfabriquées', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '14.1', 'nom' => 'Ascenseurs et montecharges', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '14.2', 'nom' => 'Appareils élévateurs pour personnes handicapées', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '14.3', 'nom' => 'Autres types d’appareils élévateurs', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.1', 'nom' => 'Systèmes de chauffage à air pulsé', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.1.1', 'nom' => 'Systèmes de chauffage à air pulsé pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.10', 'nom' => 'Réfrigération', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.2', 'nom' => 'Systèmes de brûleurs au gaz naturel', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.2.1', 'nom' => 'Systèmes de brûleurs au gaz naturel pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.3', 'nom' => 'Systèmes de brûleurs à l’huile', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.3.1', 'nom' => 'Systèmes de brûleurs à l’huile pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.4', 'nom' => 'Systèmes de chauffage hydronique', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.4.1', 'nom' => 'Systèmes de chauffage hydronique pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.5', 'nom' => 'Plomberie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.5.1', 'nom' => 'Plomberie pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.6', 'nom' => 'Propane', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.7', 'nom' => 'Ventilation résidentielle', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.8', 'nom' => 'Ventilation', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '15.9', 'nom' => 'Petits systèmes de réfrigération', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '16', 'nom' => 'Électricité', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '17.1', 'nom' => 'Instrumentation, contrôle et régulation', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '17.2', 'nom' => 'Intercommunication, téléphonie et surveillance', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '2.1', 'nom' => 'Puits forés', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '2.2', 'nom' => 'Ouvrages de captage d’eau non forés', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '2.3', 'nom' => 'Systèmes de pompage des eaux souterraines', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '2.4', 'nom' => 'Systèmes d’assainissement autonome', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '2.5', 'nom' => 'Excavation et terrassement', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '2.6', 'nom' => 'Pieux et fondations spéciales', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '2.7', 'nom' => 'Travaux d’emplacement', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '2.8', 'nom' => 'Sautage', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '3.1', 'nom' => 'Structures de béton', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '3.2', 'nom' => 'Petits ouvrages de béton', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '4.1', 'nom' => 'Structures de maçonnerie', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '4.2', 'nom' => 'Travaux de maçonnerie non structurale, marbre et céramique', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '5.1', 'nom' => 'Structures métalliques et éléments préfabriqués de béton', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '5.2', 'nom' => 'Ouvrages métalliques', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '6.1', 'nom' => 'Charpentes de bois', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '6.2', 'nom' => 'Travaux de bois et plastique', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '7', 'nom' => 'Isolation, étanchéité, couvertures et revêtement extérieur', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '8', 'nom' => 'Portes et fenêtres', 'nomCategorie' => 'Spécialisé'],
            ['codeSousCategorie' => '9', 'nom' => 'Travaux de finition', 'nomCategorie' => 'Spécialisé'],
        ];

        DB::table('categories')->insert($categories);
    }
}
