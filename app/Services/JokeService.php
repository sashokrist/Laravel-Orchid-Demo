<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Orchid\Screen\Repository;

class JokeService
{

    /**
     * @var Response
     */
    public $response;

    public function getRandomTen()
   {
       $randomTen = 'random_ten';
       $random = 'random_joke';
        $this->response = Http::acceptJson()->get('https://official-joke-api.appspot.com/' . $randomTen);
        return $this;
    }

    public function getRandom()
    {
        $this->response = Http::acceptJson()->get('https://official-joke-api.appspot.com/random_joke');
       // dd($this);
        return $this;
    }

    /**
     * Get response data
     * @return array
     */
    public function data($key = 'data')
    {
        if (!$this->response->successful()) {
            return [];
        }

        $response = $this->response->json();
        return $key && isset($response[$key]) ? $response[$key] : $response;
    }

    public function repository()
    {
        $result = [];
        foreach ($this->data() as $row) {
            $result[] = new Repository($row);
        }
        return $result;
    }

    /**
     * Get paginated result data
     *
     * @param string $key       Data key to fetch items from API response, default `data`.
     * @param int $perPage      Number of items per page, default 15.
     * @param int $page         Current page
     * @param array $options    Paginator options
     * @return LengthAwarePaginator
     */
    public function paginate($key = 'data', $perPage = 10, $page = null, $options = [])
    {
        $items = $this->data();
        $meta = ['total' => 10];

        if (!$items) {
            return [];
        }

        $items = $items instanceof Collection ? $items : Collection::make($items);
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $currentUrlPath = Request::path();
        $options = array_merge($options, [
            'path' => $currentUrlPath,
        ]);

        return new LengthAwarePaginator($items, $meta['total'], $perPage, $page, $options);
    }

}
