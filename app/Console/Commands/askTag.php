<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;
use App\Models\Post;

class askTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amanda';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $answer= $this->ask("Rentrez un tag");
        /** @var Tag $tag*/
        $tag= Tag::query()
                    ->where('name', $answer)
                    ->orWhere('id', $answer)
                    ->first();

        if($tag != null){
            
            $this->info("\033[33mVotre tag est : ".$tag->name);
            
            /** @var Post $posts*/
            $posts = Post::query()->whereHasTag($tag)->get();
            if($posts !=null){
                $this->info("\e[31;1m".$posts->count()." posts trouvés");
                foreach($posts as $post){
                    $this->info("\e[33m".$post->id);
                    $this->info("\e[32m".$post->title);
                    $this->info("\e[39m".$post->content);
                }
            }
            else{
                $this->error("Aucun post trouvé");
            }
        }
        else{
            $this->error("Ce tag n'existe pas");
        }
    }
}
