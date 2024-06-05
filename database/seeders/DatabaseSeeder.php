<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\Show;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrateur', 'slug' => 'admin']);
        $staff = Role::create(['name' => 'Staff', 'slug' => 'staff']);
        $artist = Role::create(['name' => 'Artiste', 'slug' => 'artist']);

        $venues = Venue::factory()->createMany([
            [
                'name' => 'Maison de la Culture et des Loisirs',
                'address' => '36 rue Saint-Marcel',
                'zip_code' => '57000',
                'city' => 'Metz',
                'country' => 'France',
            ],
            [
                'name' => 'Les Frigos',
                'address' => 'Rue du Général Ferrié',
                'zip_code' => '57000',
                'city' => 'Metz',
                'country' => 'France',
            ],
            [
                'name' => '49 Nord 6 Est – Frac Lorraine',
                'address' => '1 bis rue des Trinitaires',
                'zip_code' => '57000',
                'city' => 'Metz',
                'country' => 'France',
            ],
            [
                'name' => 'Centre culturel Kulturfabrik',
                'address' => '116 Rue de Luxembourg',
                'zip_code' => 'L-4221',
                'city' => 'Esch-sur-Alzette',
                'country' => 'Luxembourg',
            ]
        ]);

        Show::factory(13)->recycle($venues)->create();

        Profile::factory(10)->create();

        $adminUser = User::factory()->create([
            'name' => 'Sam',
            'username' => 'amesul',
            'email' => 'samuelstroesser@icloud.com',
            'phone' => '+33783063344',
            'phone_country' => 'FR',
            'privacy' => 'public'
        ]);
        $adminUser->roles()->attach($admin);
        $adminUser->roles()->attach($staff);
        $adminUser->roles()->attach($artist);

        Profile::factory()->create([
            'user_id' => $adminUser->id,
            'job' => 'Régie générale',
            'link' => 'https://instagram.com/_amesul',
            'pronouns' => 'iel/ellui',
            'biography' => "<p>Cin&eacute;aste et technicien&middot;ne du spectacle, Amesul passe le plus clair de son temps dans le TGV (plus de 25 000km parcourus en 2022 tout de m&ecirc;me, faudrait penser &agrave; se calmer) &agrave; courir entre des captations de concert, des tournages de fiction ou des Z&eacute;niths. Le reste de son temps est consacr&eacute; &agrave; la pratique de l'orgue (parce que c'est quand m&ecirc;me vraiment rigolo comme instrument) et &agrave; la direction du p&ocirc;le R&eacute;gie de La Queerdom.</p><p>Sam, c&rsquo;est la personne que vous ne voyez jamais (sauf quand il lui prend l&rsquo;envie de faire un discours de remerciement &agrave; la derni&egrave;re minute) mais qui oeuvre dans l&rsquo;ombre pour que vous passiez le meilleur moment possible. Tellement dans l&rsquo;ombre qu&rsquo;on se demande si du sang de vampire ne coule pas dans ses veines. Adepte des insomnies et amoureuxe de la nuit, iel d&eacute;teste l&rsquo;&eacute;t&eacute; et fuit le soleil ou la chaleur. En revanche, iel met de l&rsquo;ail dans tous ses plats, &ccedil;a casse un peu le mythe&hellip;</p><p>Egalement militant&middot;e LGBTI, vous lae retrouverez sur les internets sous le pseudo d&rsquo;Amesul, notamment sur Twitch o&ugrave; iel pr&eacute;sente le talk-show <a href='https://wokehysterie.fr/' target='_blank' rel='noopener'>La Woke Hyst&eacute;rie</a>.</p>",
        ]);
    }
}
