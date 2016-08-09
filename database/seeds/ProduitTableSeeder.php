<?php
use Illuminate\Database\Seeder;
class ProduitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Produit = new \App\Produit([
            'imagePath' => 'http://www.magazinefuse.com/wp-content/uploads/2015/09/1-Laravel-5-Essentials.jpg',
            'title' => 'Laravel 5 essentials',
            'description' => 'Super cool les essentiels de laravel 5',
            'price' => 10
        ]);
        $Produit->save();
        $Produit = new \App\Produit([
            'imagePath' => 'https://s3.amazonaws.com/titlepages.leanpub.com/codebright/hero?1463857524',
            'title' => 'Code bright Laravel',
            'description' => 'Code bright Laravel DESCRIPTION',
            'price' => 10
        ]);
        $Produit->save();
        $Produit = new \App\Produit([
            'imagePath' => 'https://d13yacurqjgara.cloudfront.net/users/33374/screenshots/2222517/cover.png',
            'title' => 'Laravel survival guide',
            'description' => 'Pour l\'invasion Laravel zombie.',
            'price' => 20
        ]);
        $Produit->save();
        $Produit = new \App\Produit([
            'imagePath' => 'http://wordpressthemes2016.com/wp-content/uploads/2016/02/4-Laravel-5-Lukas-White.jpg',
            'title' => 'Laravel Practical',
            'description' => 'Simple et pratique',
            'price' => 20
        ]);
        $Produit->save();

    }
}