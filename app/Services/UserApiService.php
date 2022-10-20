<?php

namespace App\Services;

use App\Orchid\Filters\UserFilter;
use Illuminate\Http\Client\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Orchid\Screen\Repository;

class UserApiService
{

    /**
     * @var Response
     */
    public $response;

    public function get()
   {
       $this->response = Http::acceptJson()->get('https://reqres.in/api/users' ,  [
               'page' => request()->page,
               'per_page' => request()->per_page,
           ]);
       return $this;
    }

    public function getById($id)
    {
        $this->response = Http::acceptJson()->get('https://reqres.in/api/users/' . $id);
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
     * @param int $currentUrlPath  Current page
     * @param array $options    Paginator options
     * @return LengthAwarePaginator
     */
    public function paginate($key = 'data', $perPage = null, $page = null, $options = [])
    {
        $items = $this->data();
        $response = $this->response->json();
        $meta = ['total' => $response['total']];

        if (!$items) {
            return [];
        }
        $items = $items instanceof Collection ? $items : Collection::make($items);
       // $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $currentUrlPath = Request::path();
        $options = array_merge($options, [
            'path' => substr($currentUrlPath, 15),
        ]);
        return new LengthAwarePaginator($items, $meta['total'], $perPage = $response['per_page'], $page = $response['page'], $options);
    }

    public function put( \Illuminate\Http\Request $request, $id)
    {
        $response = Http::put('https://reqres.in/api/users/' . $id, [
            'name' => $request->name,
            'job' => $request->job,
        ]);
        dd($response->json());
        return $this;
    }

    public function post( \Illuminate\Http\Request $request)
    {
        $response = Http::post('https://reqres.in/api/users/' . '/login', [
            'username' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
dd($response->json());
        return $this;
    }
}
