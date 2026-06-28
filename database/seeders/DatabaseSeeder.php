<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MenuItem;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Cedila',
            'email' => 'admin@cedila.local',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Create Test Client
        User::create([
            'name' => 'Client Test',
            'email' => 'client@cedila.local',
            'password' => Hash::make('password'),
            'role' => 'client'
        ]);

        // Création des plats (Menus Africains)
        $africanDishes = [
            [
                'name' => 'Agbeli Kaklo & Coco',
                'description' => 'Croquettes de manioc croustillantes servies avec de la noix de coco fraîche. Un classique togolais authentique.',
                'price' => 1500,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Poulet DG',
                'description' => 'Délicieux ragoût de poulet camerounais avec bananes plantains frites, carottes, poivrons et épices douces.',
                'price' => 5000,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Tiep Bou Dien (Thieboudienne)',
                'description' => 'Le plat national sénégalais : riz cassé deux fois aromatisé, poisson frais, carottes, manioc et chou.',
                'price' => 3500,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1574484284002-952d92456975?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Ndole aux Crevettes',
                'description' => 'Plat traditionnel camerounais à base de feuilles amères, arachides écrasées, viande et crevettes fraîches.',
                'price' => 4500,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Foutou Banane & Sauce Graine',
                'description' => 'Boule de foutou onctueuse accompagnée d\'une riche sauce aux noix de palme, viande de brousse et escargots.',
                'price' => 6000,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Garba Ivoirien',
                'description' => 'Attiéké (semoule de manioc) accompagné de thon frit, piments frais coupés et oignons. Rapide et délicieux.',
                'price' => 2000,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Yassa Poulet',
                'description' => 'Poulet mariné au citron et oignons, mijoté doucement, servi avec du riz blanc parfumé.',
                'price' => 3000,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Amala & Ewedu',
                'description' => 'Spécialité nigériane : pâte d\'igname (Amala) servie avec une soupe gluante d\'Ewedu et une sauce tomate épicée.',
                'price' => 4000,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Maffe Viande',
                'description' => 'Ragoût de bœuf onctueux à la pâte d\'arachide, accompagné de riz blanc, carottes et pommes de terre.',
                'price' => 3500,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Chawarma Boeuf (Spécial Cedila)',
                'description' => 'Pain libanais garni de viande de bœuf marinée et rôtie, crudités, frites et notre sauce secrète.',
                'price' => 2000,
                'type' => 'food',
                'image_path' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&h=400&fit=crop'
            ]
        ];

        foreach ($africanDishes as $dish) {
            MenuItem::create([
                'name' => $dish['name'],
                'description' => $dish['description'],
                'price' => $dish['price'],
                'type' => $dish['type'],
                'image_path' => $dish['image_path'],
                'is_available_today' => true
            ]);
        }
        MenuItem::create([
            'name' => 'Bière Pression (50cl)',
            'description' => 'Bière blonde locale bien fraîche.',
            'price' => 5.50,
            'type' => 'drink',
            'is_available_today' => true,
        ]);

        // Events
        Event::create([
            'title' => 'Soirée Karaoké',
            'description' => 'Venez chanter vos classiques avec nous ce week-end !',
            'event_date' => Carbon::now()->addDays(3),
            'is_published' => true,
        ]);
        Event::create([
            'title' => 'Buffet Spécial',
            'description' => 'Un buffet à volonté pour célébrer le week-end.',
            'event_date' => Carbon::now()->addDays(5),
            'is_published' => true,
        ]);
    }
}
