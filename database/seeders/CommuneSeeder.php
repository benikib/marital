<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Province;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des communes principales par province avec des noms uniques
        $communes = [
            'Casablanca' => [
                'Ain Sebaa Casa',
                'Ain Chock Casa',
                'Ben M\'Sick Casa',
                'Sidi Bernoussi Casa',
                'Sidi Moumen Casa',
                'Hay Mohammadi Casa',
                'Moulay Rachid Casa',
                'Derb Sultan Casa',
                'Maârif Casa',
                'Anfa Casa'
            ],
            'Rabat' => [
                'Hassan Rabat',
                'Agdal Rabat',
                'Yacoub El Mansour Rabat',
                'Souissi Rabat',
                'Hay Riad Rabat',
                'Akkari Rabat',
                'Youssoufia Rabat',
                'Touarga Rabat',
                'Océan Rabat',
                'Diour Jamaâ Rabat'
            ],
            'Marrakech' => [
                'Gueliz Marrakech',
                'Hivernage Marrakech',
                'Sidi Youssef Ben Ali Marrakech',
                'Ménara Marrakech',
                'Agdal Marrakech',
                'Daoudiate Marrakech',
                'Massira Marrakech',
                'Sidi Ghanem Marrakech',
                'Al Massar Marrakech',
                'Assif Marrakech'
            ],
            'Fès' => [
                'Fès El Bali',
                'Fès El Jdid',
                'Ain Chkef Fès',
                'Saiss Fès',
                'Jnan El Ward Fès',
                'Zouagha Fès',
                'Oulad Tayeb Fès',
                'Oulad Ziyane Fès',
                'Ain Bida Fès',
                'Sidi Harazem Fès'
            ],
            'Tanger' => [
                'Beni Makada Tanger',
                'Charf Tanger',
                'Bni Makada Tanger',
                'Mghogha Tanger',
                'Boukhalef Tanger',
                'Gzenaya Tanger',
                'M\'Sallah Tanger',
                'Dradeb Tanger',
                'Mountain Tanger',
                'Tangier City'
            ],
            'Agadir' => [
                'Inzegane Agadir',
                'Ait Melloul Agadir',
                'Dcheira Agadir',
                'Tikiouine Agadir',
                'Tassila Agadir',
                'Anza Agadir',
                'Bensergao Agadir',
                'Lqliaa Agadir',
                'Taddart Agadir',
                'Taghazout Agadir'
            ],
            'Meknès' => [
                'Hamria Meknès',
                'Boufakrane Meknès',
                'Ouislane Meknès',
                'Toulal Meknès',
                'Al Ismaïlia Meknès',
                'Bni Oual Meknès',
                'Moulay Driss Zerhoun Meknès',
                'Moulay Idriss Meknès',
                'Ain Jemaa Meknès',
                'Ain Karma Meknès'
            ],
            'Oujda' => [
                'Al Qods Oujda',
                'Al Massira Oujda',
                'Al Hamra Oujda',
                'Bni Drar Oujda',
                'Naima Oujda',
                'Bni Khaled Oujda',
                'Berkane Oujda',
                'Ahfir Oujda',
                'Bouarfa Oujda',
                'Figuig Oujda'
            ],
            'Kénitra' => [
                'Mehdia Kénitra',
                'Souk El Arbaa Kénitra',
                'Sidi Slimane Kénitra',
                'Sidi Kacem Kénitra',
                'Sidi Yahya Kénitra',
                'Moulay Bousselham Kénitra',
                'Lalla Mimouna Kénitra',
                'Souk Tlet Kénitra',
                'Oulad Slama Kénitra',
                'Oulad M\'Barek Kénitra'
            ],
            'Tétouan' => [
                'Martil Tétouan',
                'Fnideq Tétouan',
                'M\'diq Tétouan',
                'Oued Laou Tétouan',
                'Al Hoceima Tétouan',
                'Bni Hadifa Tétouan',
                'Bni Bouchibet Tétouan',
                'Bni Gmil Tétouan',
                'Bni Idder Tétouan',
                'Bni Said Tétouan'
            ]
        ];

        foreach ($communes as $provinceName => $communeNames) {
            $province = Province::where('nom', $provinceName)->first();

            if ($province) {
                foreach ($communeNames as $communeName) {
                    // Vérifier si la commune existe déjà avant de la créer
                    if (!Commune::where('nom', $communeName)->exists()) {
                        Commune::create([
                            'nom' => $communeName,
                            'province_id' => $province->id
                        ]);
                    }
                }
            }
        }
    }
}
