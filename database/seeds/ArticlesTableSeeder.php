<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\ArticleImage;


class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = factory(Article::class, 10)->create();
        $articles->each(function($article){
    		  $images=factory(ArticleImage::class,3)->make();
    		  $article->imagenes()->saveMany($images);
        });
    }
}
