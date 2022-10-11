<?php

namespace App\Repositories;

use App\Models\Joke;
use Illuminate\Database\Eloquent\Collection;

class JokeRepository
{
    /**
     * @return Collection
     */
    public function getUsers($joke): Collection
    {
        dd($joke);
        return Joke::all();
    }
//    /*
//     * @var Joke
//     */
//    protected $joke;
//
//    /*
//     * JokeRepository constructor
//     *
//     * @param Joke $joke
//     */
//    public function __construct(Joke $joke)
//    {
//        $this->joke = $joke;
//    }
//
//    /*
//     * Get all jokes
//     *
//     * return Joke $joke
//     */
//    public function getAllJoke()
//    {
//
//        return $this->joke->getContent( 'type', 'setup', 'punchline');
//    }

}
