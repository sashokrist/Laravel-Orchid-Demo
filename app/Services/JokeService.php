<?php

namespace App\Services;

use App\Repositories\JokeRepository;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class JokeService
{
//    /*
//     * @var $jokeRepository
//     */
//    protected $jokeRepository;

//    /*
//     * JokeService constructor
//     *
//     * @param JokeRepository $jokeRepository
//     */
//    public function __construct(JokeRepository $jokeRepository)
//    {
//        $this->jokeRepository = $jokeRepository;
//    }


    public function getRandom()
   {
       // dd($response->body());  //$response->body()
        return Http::get('https://official-joke-api.appspot.com/random_ten');
    }

}
