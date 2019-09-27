<?php

use Illuminate\Database\Seeder;
use App\Models\TypeItem;

class BudgetItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_01 = TypeItem::create([ 'name' => 'Frais pédagogiques']);
        $type_01->items()->createMany([
            [ 'budget_id' => 1, 'designation' => 'Honoraires formateurs N°1', 'unite' => 'Homme/jour',
            'nb_unite' => 8, 'cout_unite' => 125000 ],
            [ 'budget_id' => 1, 'designation' => 'Honoraires formateurs N°2', 'unite' => 'Homme/jour',
            'nb_unite' => 8, 'cout_unite' => 125000 ],
            [ 'budget_id' => 1, 'designation' => 'Perdiem Experts formateurs (Hébergements: 2pers*6jours*25000)', 'unite' => 'Par jour',
            'nb_unite' => 12, 'cout_unite' => 25000 ],
            [ 'budget_id' => 1, 'designation' => 'Perdiem Experts formateurs (Repas du soir et téléphone: 2pers*6jours*15000)', 'unite' => 'Par jour',
            'nb_unite' => 12, 'cout_unite' => 15000 ],
            [ 'budget_id' => 1, 'designation' => 'Transport par avion des formateurs', 'unite' => 'Billet d\'avion/Expert',
            'nb_unite' => 2, 'cout_unite' => 242240 ],
            [ 'budget_id' => 1, 'designation' => 'Transport intra urbain des formateurs', 'unite' => 'Forfait',
            'nb_unite' => 2, 'cout_unite' => 30000 ]
        ]);

        $type_02 = TypeItem::create([ 'name' => 'Frais logistiques']);
        $type_02->items()->createMany([
            [ 'budget_id' => 1, 'designation' => 'Location de la salle', 'unite' => 'Jour',
            'nb_unite' => 5, 'cout_unite' => 200000 ],
            [ 'budget_id' => 1, 'designation' => 'Restauration: Pause-café (35 pers*5jrs*2500), Pause déjeuner (35pers*5jrs*5500)', 'unite' => 'personne/Jour',
            'nb_unite' => 175, 'cout_unite' => 8000 ],
            [ 'budget_id' => 1, 'designation' => 'Forfait logistique (eau en salle, impression des attestations, photo, reprographie sur site, sonorisation, internet, etc...)', 'unite' => 'Fofait',
            'nb_unite' => 1, 'cout_unite' => 150000 ],
            [ 'budget_id' => 1, 'designation' => 'Location bus-descente terrain', 'unite' => 'Fofait',
            'nb_unite' => 1, 'cout_unite' => 125000 ],
            [ 'budget_id' => 1, 'designation' => 'Kit du participant (clé USB, blocs note, chemises à rabat)', 'unite' => 'Par personne',
            'nb_unite' => 40, 'cout_unite' => 5200 ]
        ]);

        $type_03 = TypeItem::create([ 'name' => 'Frais de communication']);
        $type_03->items()->createMany([
            [ 'budget_id' => 1, 'designation' => 'Banderole', 'unite' => 'Unité',
            'nb_unite' => 1, 'cout_unite' => 75000 ],
            [ 'budget_id' => 1, 'designation' => 'Relation publique', 'unite' => 'Forfait',
            'nb_unite' => 1, 'cout_unite' => 100000 ],
            [ 'budget_id' => 1, 'designation' => 'Couverture médiatique (CRTV, CANAL 2)', 'unite' => 'Fofait',
            'nb_unite' => 1, 'cout_unite' => 100000 ]
        ]);

        $type_04 = TypeItem::create([ 'name' => 'Prise en charge du personnel PNFMV']);
        $type_04->items()->createMany([
            [ 'budget_id' => 1, 'designation' => 'billet d\'avion personnel PNFMV (aller/retour)', 'unite' => 'billet d\'avion/personne',
            'nb_unite' => 3, 'cout_unite' => 242240 ],
            [ 'budget_id' => 1, 'designation' => 'location de véhicule sur le terrain (05 jours)', 'unite' => 'forfait',
            'nb_unite' => 1, 'cout_unite' => 250000 ],
            [ 'budget_id' => 1, 'designation' => 'frais de transport intra urbain du personnel PNFMV', 'unite' => 'forfait',
            'nb_unite' => 1, 'cout_unite' => 30000 ],
            [ 'budget_id' => 1, 'designation' => 'Frais de mission Superviseur', 'unite' => 'homme/jour',
            'nb_unite' => 5, 'cout_unite' => 75000 ],
            [ 'budget_id' => 1, 'designation' => 'Frais de mission Chef de mission', 'unite' => 'homme/jour',
            'nb_unite' => 5, 'cout_unite' => 40000 ],
            [ 'budget_id' => 1, 'designation' => 'Frais de mission Assistant Formation', 'unite' => 'homme/jour',
            'nb_unite' => 5, 'cout_unite' => 40000 ]
        ]);
    }
}
