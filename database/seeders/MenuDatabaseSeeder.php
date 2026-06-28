<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        MenuItem::truncate();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $categories = [
            'NOS PETITS DEJEUNERS' => [
                'type' => 'food', 'sort' => 10,
                'items' => [
                    ['name' => 'Croissant', 'price' => 500, 'type' => 'food'],
                    ['name' => 'Pain au chocolat', 'price' => 600, 'type' => 'food'],
                    ['name' => 'Pain viennois', 'price' => 300, 'type' => 'food'],
                    ['name' => 'Friand Viande ou saucisses', 'price' => 1000, 'type' => 'food'],
                    ['name' => 'Pain au raisin', 'price' => 600, 'type' => 'food'],
                    ['name' => 'Œuf au plat', 'price' => 2000, 'type' => 'food'],
                    ['name' => 'Omelette sur plat', 'price' => 3000, 'type' => 'food'],
                    ['name' => 'Omelette nature', 'price' => 2500, 'description' => 'fromage, fines, l\'herbes', 'type' => 'food'],
                    ['name' => 'Petit déjeuner simple', 'price' => 2000, 'description' => 'nescafé en thé, en chocolat, tranche de pain, beurre ou confiture', 'type' => 'food'],
                    ['name' => 'Petit déjeuner amélioré', 'price' => 3500, 'description' => 'nescafé en thé, en chocolat, croissant, chocolatine, omelette nature, jus de fruit nature', 'type' => 'food'],
                    ['name' => 'Gateau d\'anniversaire', 'price' => 10000, 'description' => 'à partir de 10.000 F', 'type' => 'food'],
                ]
            ],
            'NOS BOISSONS CHAUDES' => [
                'type' => 'drink', 'sort' => 20,
                'items' => [
                    ['name' => 'Thé au lait', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Chocolat chaud', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Thé menthe', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Thé gingembre', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Thé mojito', 'price' => 2500, 'type' => 'drink'],
                    ['name' => 'Café expres', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Thé maison', 'price' => 2500, 'description' => 'Feuille bazilic, ail, citron, miel', 'type' => 'drink'],
                    ['name' => 'Lait chaud', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Café au lait', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Lipton', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Café noir', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Supplément de lait ou de miel', 'price' => 500, 'type' => 'drink'],
                ]
            ],
            'NOS BOISSONS FROIDES' => [
                'type' => 'drink', 'sort' => 30,
                'items' => [
                    ['name' => 'Café au lait (froid)', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Milo au lait', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Lipton au lait', 'price' => 2000, 'type' => 'drink'],
                ]
            ],
            'NOS CRÊPES' => [
                'type' => 'food', 'sort' => 40,
                'items' => [
                    ['name' => 'Crêpes de nature', 'price' => 2000, 'type' => 'food'],
                    ['name' => 'Crêpes Nutella', 'price' => 2500, 'type' => 'food'],
                ]
            ],
            'NOS JUS NATURE' => [
                'type' => 'drink', 'sort' => 50,
                'items' => [
                    ['name' => 'Jus d\'ananas', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Jus d\'orange', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Jus de pasthèque', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Jus de mangue', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Jus de gingembre', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Jus mixte', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Xtra mangue', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Xtra goyave', 'price' => 1000, 'type' => 'drink'],
                ]
            ],
            'NOS BURGER' => [
                'type' => 'food', 'sort' => 60,
                'items' => [
                    ['name' => 'Burger viandes', 'price' => 3000, 'description' => 'Viandes, feuille laitue, sauce, frite', 'type' => 'food'],
                    ['name' => 'Hamburger', 'price' => 2500, 'type' => 'food'],
                    ['name' => 'Cheese burger', 'price' => 3500, 'type' => 'food'],
                    ['name' => 'King burger', 'price' => 4000, 'type' => 'food'],
                    ['name' => 'Chicken burger', 'price' => 4000, 'type' => 'food'],
                    ['name' => 'Double burger', 'price' => 5500, 'type' => 'food'],
                    ['name' => 'Double cheese burger', 'price' => 6000, 'type' => 'food'],
                ]
            ],
            'NOS SANDWICH' => [
                'type' => 'food', 'sort' => 70,
                'items' => [
                    ['name' => 'Sandwich viande de bœuf hachée cornichon', 'price' => 2000, 'type' => 'food'],
                    ['name' => 'Sandwich Omelette cornichon', 'price' => 2000, 'type' => 'food'],
                    ['name' => 'Sandwich poulet cornichon', 'price' => 2500, 'type' => 'food'],
                    ['name' => 'Sandwich Américain cornichon', 'price' => 2500, 'description' => 'fromage jambon', 'type' => 'food'],
                    ['name' => 'Sandwich crudites cornichon', 'price' => 2000, 'type' => 'food'],
                    ['name' => 'Sandwich au thon cornichon', 'price' => 2000, 'type' => 'food'],
                    ['name' => 'Sandwich CEDILA cornichon', 'price' => 3500, 'description' => 'Blanc de poulet, choux, carottes, jambon, fromage, poulet emieté, maïs doux, petit pois', 'type' => 'food'],
                ]
            ],
            'NOS CHAWARMA' => [
                'type' => 'food', 'sort' => 80,
                'items' => [
                    ['name' => 'Chawarma viande assiette', 'price' => 3000, 'type' => 'food'],
                    ['name' => 'Chawarma Poulet', 'price' => 2500, 'type' => 'food'],
                    ['name' => 'Chawarma viande de bœuf', 'price' => 2000, 'type' => 'food'],
                    ['name' => 'Chawarma Cedila', 'price' => 3500, 'description' => 'Double viande, cornichon, frite, laitue, chou, tomate, oignon', 'type' => 'food'],
                    ['name' => 'Chawarma végétarien', 'price' => 3000, 'type' => 'food'],
                    ['name' => 'Chawarma langue de bœuf', 'price' => 3000, 'type' => 'food'],
                    ['name' => 'Chawarma poisson', 'price' => 2000, 'type' => 'food'],
                    ['name' => 'Chawarma janbom', 'price' => 3000, 'type' => 'food'],
                    ['name' => 'Chawarma au thon', 'price' => 2500, 'type' => 'food'],
                ]
            ],
            'NOS SALADES' => [
                'type' => 'food', 'sort' => 90,
                'items' => [
                    ['name' => 'Avocat à la macédoine', 'price' => 4000, 'type' => 'food'],
                    ['name' => 'Salade d\'avocat crevette', 'price' => 4500, 'type' => 'food'],
                    ['name' => 'Salade composée', 'price' => 4500, 'type' => 'food'],
                    ['name' => 'Salade niçoise', 'price' => 4500, 'description' => 'Laitue ciselée, haricot vert, poivron, tomate, oignon, thon, œuf de caille, sauce vinaigrette', 'type' => 'food'],
                    ['name' => 'Omlette roulée à la salade verte', 'price' => 4500, 'type' => 'food'],
                    ['name' => 'Salade d\'avocat au thon', 'price' => 4500, 'description' => 'Laitue, concombre, avocat, tomates, œuf du thon, olive noire', 'type' => 'food'],
                    ['name' => 'Hors d\'œuvre à chaud', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Salade cedila', 'price' => 7500, 'description' => 'Laitue, choux, betterave, tomate, pomme, carotte, Avocat, maïs doux, jambon, viande poêlée, œuf', 'type' => 'food'],
                ]
            ],
            'NOS PIZZA' => [
                'type' => 'food', 'sort' => 100,
                'items' => [
                    ['name' => 'Pizza margherita', 'price' => 4500, 'description' => 'Mozzarella, sauce tomate, tomate, oignon, poivron vert', 'type' => 'food'],
                    ['name' => 'Pizza Reine', 'price' => 5500, 'description' => 'Sauce tomate, mozzarella, champignons, poivrons, olives noires, jambon', 'type' => 'food'],
                    ['name' => 'Pizza forestière', 'price' => 6000, 'description' => 'Sauce tomate, viande hachée, champignons, olives noires, maïs doux, poivron', 'type' => 'food'],
                    ['name' => 'Pizza fruit de mer', 'price' => 6500, 'description' => 'Sauce tomate, mozzarella, crevettes, calamara', 'type' => 'food'],
                    ['name' => 'Pizza royale', 'price' => 4500, 'description' => 'mozzarella, sauce tomate, jambon, viande de poulet, Oeuf, olives noires', 'type' => 'food'],
                    ['name' => 'Pizza mexicaine', 'price' => 6000, 'description' => 'Sauce tomate, mozzarella, viande hachée, poivrons', 'type' => 'food'],
                    ['name' => 'Pizza végétarienne', 'price' => 5500, 'description' => 'Sauce tomate, champignons, poivre, oignons, mais doux, tomates tranchés, olives', 'type' => 'food'],
                    ['name' => 'Pizza calzone', 'price' => 6000, 'description' => 'Sauce tomate, mozzarella, champignons, tomates tranchés, olives, viande de poulet, jambon', 'type' => 'food'],
                    ['name' => 'Pizza Arabiata', 'price' => 7000, 'description' => 'Sauce tomate, merguez, œuf, poivrons olives, piment', 'type' => 'food'],
                    ['name' => 'Pizza Poulet', 'price' => 6500, 'description' => 'Sauce tomate, parmesan, mozzarella, œuf dur, poivrons origan', 'type' => 'food'],
                    ['name' => 'Pizza carbonara', 'price' => 6000, 'description' => 'Sauce tomate, parmesan, mozzarella, lardons, œuf dur, olives, poivrons', 'type' => 'food'],
                    ['name' => 'Pizza CEDILA', 'price' => 7500, 'description' => 'Sauce crème, mozzarella, champignons, poivrons, viande hachée, jambon, olives noires, crème fraiche, origan, maïs doux', 'type' => 'food'],
                ]
            ],
            'NOS PLATS' => [
                'type' => 'food', 'sort' => 110,
                'items' => [
                    ['name' => 'Poulet bicyclette entier braisé', 'price' => 6000, 'type' => 'food'],
                    ['name' => '1/2 Poulet bicyclette braisé', 'price' => 3500, 'type' => 'food'],
                    ['name' => 'Poulet de chair Rôti', 'price' => 4500, 'type' => 'food'],
                    ['name' => 'Poulet yassa', 'price' => 5500, 'type' => 'food'],
                    ['name' => 'Poulet rôti', 'price' => 10000, 'type' => 'food'],
                    ['name' => 'Poulet mayo', 'price' => 3500, 'type' => 'food'],
                    ['name' => 'Choukouya de poulet', 'price' => 4500, 'type' => 'food'],
                    ['name' => 'Choukouya de bœuf', 'price' => 4500, 'type' => 'food'],
                    ['name' => 'Kedjenou de poulet', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Kedjenou de pintade', 'price' => 7000, 'type' => 'food'],
                    ['name' => 'Steak de bœuf', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Langue de bœuf', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Carpe braisée', 'price' => 5000, 'description' => '5000 F / 7000 F', 'type' => 'food'],
                    ['name' => 'Bar Sauté à la poêle', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Sole meunière', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Tilapia braisée', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Lapin braisé', 'price' => 5500, 'type' => 'food'],
                    ['name' => 'Pintade braisée', 'price' => 5500, 'type' => 'food'],
                    ['name' => 'Langouste grillée à l\'ail au persil', 'price' => 8000, 'type' => 'food'],
                    ['name' => 'Bar braisé', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Filet de poisson forestier', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Gros bar à la papillotte', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Filet de sol à la normande', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Filet de poisson sauce fifine', 'price' => 7500, 'description' => 'Sauce crème, purée, persil, crème fraiche', 'type' => 'food'],
                    ['name' => 'Filet de bœuf grillé', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Cotelette d\'agneau braisée', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Steak poivre', 'price' => 5500, 'type' => 'food'],
                    ['name' => 'Steak grillé', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Langue de bœuf grillé', 'price' => 6500, 'type' => 'food'],
                    ['name' => 'Poulet braisé', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Souris d\'agneau', 'price' => 8000, 'type' => 'food'],
                    ['name' => 'Rognons à la moutarde', 'price' => 4000, 'type' => 'food'],
                    ['name' => 'Côte de bœuf au barbecue', 'price' => 8000, 'type' => 'food'],
                ]
            ],
            'NOS BROCHETTES' => [
                'type' => 'food', 'sort' => 120,
                'items' => [
                    ['name' => 'Brochette de gésier de dinde', 'price' => 4000, 'type' => 'food'],
                    ['name' => 'Brochette d\'escargot', 'price' => 6500, 'type' => 'food'],
                    ['name' => 'Brochette de bœuf', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Brochette de poulet', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Brochette de poisson', 'price' => 5500, 'type' => 'food'],
                    ['name' => 'Brochette de filet de poisson', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Brochette de ganbas flambée au whisky', 'price' => 9000, 'type' => 'food'],
                    ['name' => 'Brochette de gésier et poisson', 'price' => 7000, 'type' => 'food'],
                    ['name' => 'Brochette mixte composé', 'price' => 7000, 'description' => 'bœuf, poulet, poisson', 'type' => 'food'],
                ]
            ],
            'NOS CRUSTACÉS' => [
                'type' => 'food', 'sort' => 130,
                'items' => [
                    ['name' => 'Ecrévisses à l\'Américaine', 'price' => 4500, 'type' => 'food'],
                    ['name' => 'Langouste thermidor', 'price' => 14000, 'type' => 'food'],
                    ['name' => 'Calama sauté à la provençale', 'price' => 7000, 'type' => 'food'],
                ]
            ],
            'NOS PÂTES' => [
                'type' => 'food', 'sort' => 140,
                'items' => [
                    ['name' => 'Spaghetti bolognaise', 'price' => 3500, 'description' => 'Viande de boeuf hachée, sauce tomate maison, poivron, carottes', 'type' => 'food'],
                    ['name' => 'Tagliatelle à la crème et aux champignons', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Spaghetti napolitaine', 'price' => 4000, 'description' => 'sauce tomate, maïs doux, petit pois, carotte, oignon, viande', 'type' => 'food'],
                    ['name' => 'Gratin de macaroni', 'price' => 5500, 'type' => 'food'],
                    ['name' => 'Spaghetti cedila', 'price' => 5000, 'description' => 'sauce tomate, maïs doux, petit pois, viande, jambon, pomme', 'type' => 'food'],
                ]
            ],
            'NOS SPECIALITES AFRICAINES' => [
                'type' => 'food', 'sort' => 150,
                'items' => [
                    ['name' => 'Légume 4 pièce (Mantindjan)', 'price' => 6000, 'description' => 'Poisson ou viande, crevettes ou crabe, sesame, peau de boeuf, Fromage peulh, gboman, tchayo, amanvivè', 'type' => 'food'],
                    ['name' => 'Man gnignan à la moutarde', 'price' => 6000, 'description' => 'Legumes, poisson, fromage, peau de boeuf, Moutarde africaine', 'type' => 'food'],
                    ['name' => 'Gbôta complet', 'price' => 7500, 'type' => 'food'],
                    ['name' => 'Gbôta 1/2', 'price' => 4000, 'type' => 'food'],
                    ['name' => 'Blôkôtô', 'price' => 4500, 'type' => 'food'],
                    ['name' => 'Assrôkoui', 'price' => 4000, 'type' => 'food'],
                    ['name' => 'Gombo Royal', 'price' => 4000, 'description' => 'Gombo, poisson, peau de boeufs, Fétri man, crabe', 'type' => 'food'],
                    ['name' => 'Monyo au poisson Bar', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Sauce d\'arachide à la viande de mouton', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Dakoin', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Crin crin', 'price' => 4000, 'type' => 'food'],
                    ['name' => 'Legume CEDILA', 'price' => 7000, 'description' => 'Viande, poissons, crevettes, crabe, sesame, peau de boeuf, fromage peulh, fonman, Tchayo, Amanvivè', 'type' => 'food'],
                    ['name' => 'Amiwô au poulet', 'price' => 6500, 'type' => 'food'],
                    ['name' => 'Sauce tchiayo', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Sauce mouton', 'price' => 5000, 'type' => 'food'],
                    ['name' => 'Atassi (carpe + oeuf + frommage)', 'price' => 7500, 'type' => 'food'],
                    ['name' => 'Attiékè + poisson braisé + alloco', 'price' => 7000, 'type' => 'food'],
                    ['name' => 'Cassoulet à la viande de bœuf', 'price' => 6000, 'type' => 'food'],
                    ['name' => 'Lapin', 'price' => 7000, 'type' => 'food'],
                ]
            ],
            'PRESSION' => [
                'type' => 'drink', 'sort' => 160,
                'items' => [
                    ['name' => 'Bière pression 0.33cl', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Bière pression 0.50cl', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Bière pression 1l', 'price' => 3500, 'type' => 'drink'],
                    ['name' => 'Bière pression 3l', 'price' => 10000, 'type' => 'drink'],
                    ['name' => 'Monaco', 'price' => 3500, 'type' => 'drink'],
                    ['name' => 'Tango', 'price' => 3000, 'type' => 'drink'],
                ]
            ],
            'COCKTAILS SANS ALCOOL' => [
                'type' => 'drink', 'sort' => 170,
                'items' => [
                    ['name' => 'Chantaco', 'price' => 2000, 'description' => 'Jus d\'orange, jus de pamplemousse, jus de citron, sirop de grenadine', 'type' => 'drink'],
                    ['name' => 'Virgin Mojito', 'price' => 3000, 'description' => 'Sirop de canne, eau gazeuse, feuille de menthe', 'type' => 'drink'],
                    ['name' => 'Arc-en-ciel', 'price' => 3000, 'description' => 'Jus de mangue, jus d\'ananas, sirop de menthe, Sirop de grenadine, ceraçao bleu', 'type' => 'drink'],
                    ['name' => 'Parisette', 'price' => 2500, 'description' => 'Lait entier, sirop de grenadine ou de menthe', 'type' => 'drink'],
                    ['name' => 'Tonino', 'price' => 2500, 'description' => 'Sirop de fraise, sirop de pêche, jus de mangue, jus d\'ananas, jus de citron', 'type' => 'drink'],
                    ['name' => 'Cendrillon', 'price' => 3000, 'description' => 'Jus d\'ananas, jus d\'orange, jus de citron, grenadine, eau gazeuse', 'type' => 'drink'],
                    ['name' => 'Pinacolade', 'price' => 3000, 'description' => 'Jus d\'ananas, crème fraiche, lait de coco, sirop de canne', 'type' => 'drink'],
                    ['name' => 'Floride', 'price' => 2000, 'description' => 'Jus d\'orange, sirop de grenadine, jus de citron', 'type' => 'drink'],
                ]
            ],
            'COCKTAILS ALCOOLISÉS' => [
                'type' => 'drink', 'sort' => 180,
                'items' => [
                    ['name' => 'Danseuse', 'price' => 2500, 'description' => 'Jus de mangue, jus de pomme, citron, crème de cassis', 'type' => 'drink'],
                    ['name' => 'J\'aime ça', 'price' => 3000, 'description' => 'Jus de mangue, lait demi écréme, sirop de fraise', 'type' => 'drink'],
                    ['name' => 'Milk shake alcoolisé', 'price' => 3000, 'description' => 'Glace vanille ou choco, sirop de fraise, chantilles', 'type' => 'drink'],
                    ['name' => 'Sirop de menthe maison', 'price' => 3000, 'description' => 'Sucre de canne, sirop de menthe, feuille de menthe, eau, Jus d\'ananas, sirop de grenadine, vodka, curaçao bleu', 'type' => 'drink'],
                    ['name' => 'A l\'étage', 'price' => 5000, 'description' => 'Jus d\'ananas, sirop de grenadine, vodka, bleu curaçao', 'type' => 'drink'],
                    ['name' => 'Bleu magarita', 'price' => 5000, 'description' => 'Téquila, bleu curaçao, triple sec, jus de citron', 'type' => 'drink'],
                    ['name' => 'Mojito', 'price' => 4000, 'description' => 'Feuille de menthe, citron vert, sucre de canne, rhum blanc', 'type' => 'drink'],
                    ['name' => 'Mojito orange', 'price' => 4000, 'description' => 'Feuille de menthe, citron, sucre de canne, orange, rhum blanc, soda', 'type' => 'drink'],
                    ['name' => 'Cosmopolitan', 'price' => 4000, 'description' => 'Jus de cranberry, citron vert, vodka, cointreau ou orange sec', 'type' => 'drink'],
                    ['name' => 'White house', 'price' => 4000, 'description' => 'Liqueur de café, sucre de canne, lait', 'type' => 'drink'],
                    ['name' => 'Cocktails du chef', 'price' => 5000, 'description' => 'Vin mousseur, malibou, jus d\'ananas, sirop de fraise', 'type' => 'drink'],
                    ['name' => 'Perroquet', 'price' => 2500, 'description' => 'Pastis ou ricard, sirop de menthe, allongé d\'eau, glaçon', 'type' => 'drink'],
                    ['name' => 'Cuba libre', 'price' => 4000, 'description' => 'Coca, whisky, citron', 'type' => 'drink'],
                    ['name' => 'Jamaïc', 'price' => 4000, 'description' => 'Jus d\'ananas, jus d\'orange, sirop de grenadine, vodka', 'type' => 'drink'],
                    ['name' => 'Pina colada', 'price' => 4000, 'description' => 'Jus d\'ananas, malibu, rhum, lait', 'type' => 'drink'],
                    ['name' => 'Muscow mules', 'price' => 4000, 'description' => 'Gingembre frais, jus de citron, vadka, soda', 'type' => 'drink'],
                    ['name' => 'Long island', 'price' => 5000, 'description' => 'Vodka, gin triple sec, rhum, toquila, jus de citron, curaçao', 'type' => 'drink'],
                ]
            ],
            'NOS LIQUEURS' => [
                'type' => 'drink', 'sort' => 190,
                'items' => [
                    ['name' => 'Bull Frog', 'price' => 6000, 'description' => 'Vodka, gin, triple sec, rhum, téquilla, bleu de curçao, energy drink', 'type' => 'drink'],
                    ['name' => 'Viagra', 'price' => 5000, 'description' => 'Campary, suze, guiness, rhum', 'type' => 'drink'],
                    ['name' => 'Le CEDILA', 'price' => 6000, 'description' => 'Jack Daniel au miel, jus de pomme, menthe fraîche, suvre de canne', 'type' => 'drink'],
                    ['name' => 'Hennessy VS', 'price' => 50000, 'type' => 'drink'],
                    ['name' => 'Hennessy VSOP', 'price' => 70000, 'type' => 'drink'],
                    ['name' => 'Chivas 12ans', 'price' => 40000, 'type' => 'drink'],
                    ['name' => 'Vat 69', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Red label', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Black label', 'price' => 40000, 'type' => 'drink'],
                    ['name' => 'Label 5', 'price' => 20000, 'type' => 'drink'],
                    ['name' => 'Jack Daniel', 'price' => 40000, 'type' => 'drink'],
                    ['name' => 'JB', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Williams Lawson', 'price' => 30000, 'type' => 'drink'],
                    ['name' => 'Vodka', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Pastis', 'price' => 15000, 'type' => 'drink'],
                    ['name' => 'Suze', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Martini', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Campari', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Cointro', 'price' => 30000, 'type' => 'drink'],
                    ['name' => 'Rhum', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Amaruta', 'price' => 25000, 'type' => 'drink'],
                ]
            ],
            'NOS GARNITURES' => [
                'type' => 'food', 'sort' => 200,
                'items' => [
                    ['name' => 'Supplément de garniture', 'price' => 1000, 'description' => 'Riz, frites, Alloco, Attièkè, Akassa, Couscous, Pate de maïs, Agbéli, Amiwô, Piron, Pâte de semoule, légumes sautés, pomme sauté, Langue d\'oiseau, carotte, curry', 'type' => 'food'],
                    ['name' => 'Portion supplémentaire', 'price' => 1000, 'description' => 'Piron, Pommes, Pâte, Légume sauté, L\'igname frite ou bouillie', 'type' => 'food'],
                ]
            ],
            'EAUX & SUCRERIES' => [
                'type' => 'drink', 'sort' => 210,
                'items' => [
                    ['name' => 'Possotomè', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Posso citron', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Fifa', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Kwabô', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Kwabô citron', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Comtesse', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Possotomè gazéifié', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Coca cola', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Malta Guiness', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Sprite', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Fanta', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'World cola', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Fizzi cocktail', 'price' => 1000, 'type' => 'drink'],
                    ['name' => 'Fizzi pamplemousse', 'price' => 1000, 'type' => 'drink'],
                ]
            ],
            'NOS GLACES' => [
                'type' => 'food', 'sort' => 220,
                'items' => [
                    ['name' => 'Milkshake (Glaces)', 'price' => 3500, 'description' => '02 boules de vanille, lait entier, glaçon, sirop de grenadine ou menthe ou fraise', 'type' => 'food'],
                    ['name' => '01 boule glace', 'price' => 1000, 'type' => 'food'],
                    ['name' => '03 boules glace', 'price' => 2500, 'description' => 'vanille, chocolat, fraise, Américaine, caramel, banane, coco, stracciatella, oreo, menthe, pistache, malaga, mangue', 'type' => 'food'],
                    ['name' => 'Dame blanche', 'price' => 3500, 'description' => '01 boules coco vanille et chocolat, chantilly, sauce chocolat', 'type' => 'food'],
                    ['name' => 'Dame noire', 'price' => 3500, 'type' => 'food'],
                    ['name' => 'Dame métisse', 'price' => 3500, 'type' => 'food'],
                ]
            ],
            'NOS ENERGIES' => [
                'type' => 'drink', 'sort' => 230,
                'items' => [
                    ['name' => 'Red Bull', 'price' => 2500, 'type' => 'drink'],
                    ['name' => 'Qube', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Rox', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'XXL', 'price' => 1500, 'type' => 'drink'],
                ]
            ],
            'NOS BIÈRES' => [
                'type' => 'drink', 'sort' => 240,
                'items' => [
                    ['name' => 'Béninoise', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Beaufort', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Guiness', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Eku', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Pils', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Doppel munich', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Awoyo', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Doppel lager', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Despérado', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Savana', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Heineken', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Flag', 'price' => 1500, 'type' => 'drink'],
                    ['name' => 'Castel', 'price' => 1500, 'type' => 'drink'],
                ]
            ],
            'NOS VINS & CONSOS' => [
                'type' => 'drink', 'sort' => 250,
                'items' => [
                    ['name' => 'Tantation du Pasteur (Languedoc)', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Chateau ministre (Languedoc)', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Enclos du ministre (Languedoc)', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Les caves royales', 'price' => 20000, 'type' => 'drink'],
                    ['name' => 'Baume', 'price' => 20000, 'type' => 'drink'],
                    ['name' => 'Carillonade (Bordeaux)', 'price' => 10000, 'type' => 'drink'],
                    ['name' => 'Grand versant', 'price' => 10000, 'type' => 'drink'],
                    ['name' => 'Prestigium rouge', 'price' => 10000, 'type' => 'drink'],
                    ['name' => 'Prestigium blanc moelleux', 'price' => 10000, 'type' => 'drink'],
                    ['name' => 'Castel syrah', 'price' => 15000, 'type' => 'drink'],
                    ['name' => 'Chateau maine barreau (Bordeaux)', 'price' => 15000, 'type' => 'drink'],
                    ['name' => 'Petit condat (Bordeaux)', 'price' => 15000, 'type' => 'drink'],
                    ['name' => 'Cadet d\'Arhus (Bordeaux)', 'price' => 15000, 'type' => 'drink'],
                    ['name' => 'Chateau des leotins blanc (Bordeaux)', 'price' => 15000, 'type' => 'drink'],
                    ['name' => 'JPChenet', 'price' => 10000, 'type' => 'drink'],
                    ['name' => 'Vin mousseux', 'price' => 15000, 'type' => 'drink'],
                    ['name' => 'Capitor', 'price' => 30000, 'type' => 'drink'],
                    ['name' => 'Alexis lichine', 'price' => 20000, 'type' => 'drink'],
                    ['name' => 'Vin cap', 'price' => 20000, 'type' => 'drink'],
                    ['name' => 'Rhum (Conso)', 'price' => 3000, 'type' => 'drink'],
                    ['name' => 'Campari (Conso)', 'price' => 3000, 'type' => 'drink'],
                    ['name' => 'Vadka (Conso)', 'price' => 3000, 'type' => 'drink'],
                    ['name' => 'Sodabi', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'King of soto', 'price' => 2000, 'type' => 'drink'],
                    ['name' => 'Cointreau', 'price' => 3500, 'type' => 'drink'],
                    ['name' => 'Martini blanc / rouge / rose', 'price' => 3000, 'type' => 'drink'],
                    ['name' => 'Marie Brizard', 'price' => 3500, 'type' => 'drink'],
                    ['name' => 'Whisky crème', 'price' => 3500, 'type' => 'drink'],
                    ['name' => 'Black label (Conso)', 'price' => 4000, 'type' => 'drink'],
                    ['name' => 'Jack Daniel (Conso)', 'price' => 4000, 'type' => 'drink'],
                    ['name' => 'Chivas (Conso)', 'price' => 4000, 'type' => 'drink'],
                    ['name' => 'Cardhu', 'price' => 4000, 'type' => 'drink'],
                    ['name' => 'Ricard / Pastis', 'price' => 3000, 'type' => 'drink'],
                    ['name' => 'Red label / JB', 'price' => 3000, 'type' => 'drink'],
                    ['name' => 'Cognac', 'price' => 4500, 'type' => 'drink'],
                    ['name' => 'Calvados', 'price' => 4500, 'type' => 'drink'],
                ]
            ],
            'NOS CHAMPAGNES' => [
                'type' => 'drink', 'sort' => 260,
                'items' => [
                    ['name' => 'Ruinart blanc de blanc', 'price' => 120000, 'type' => 'drink'],
                    ['name' => 'Perrier Jouet', 'price' => 100000, 'type' => 'drink'],
                    ['name' => 'Moet et chandon', 'price' => 65000, 'type' => 'drink'],
                    ['name' => 'Veuve Clicquot', 'price' => 65000, 'type' => 'drink'],
                    ['name' => 'Castel ICE', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Cuvée rosée', 'price' => 25000, 'type' => 'drink'],
                    ['name' => 'Belaire', 'price' => 45000, 'type' => 'drink'],
                ]
            ],
        ];

        foreach ($categories as $categoryName => $catData) {
            $category = Category::create([
                'name' => $categoryName,
                'type' => $catData['type'],
                'sort_order' => $catData['sort'],
            ]);

            $itemsToSeed = array_slice($catData['items'], 0, 3);
            foreach ($itemsToSeed as $itemData) {
                MenuItem::create([
                    'category_id' => $category->id,
                    'name' => $itemData['name'],
                    'description' => $itemData['description'] ?? null,
                    'price' => $itemData['price'],
                    'type' => $itemData['type'],
                    'is_available_today' => true,
                ]);
            }
        }
    }
}
