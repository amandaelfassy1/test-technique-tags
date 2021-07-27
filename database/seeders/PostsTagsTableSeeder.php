<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $tags = Tag::all();

        foreach($posts as $post)
        {
            $post->tags()->sync($tags->random(rand(1,$tags->count()))->pluck('id'));
        }
    }
}
