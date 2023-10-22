<?php
namespace App\Repositories;

use App\Models\Client;
use App\Enums\TypePaginate;
use Carbon\Carbon;

class ClientRepository implements BaseRepositoryInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return Client::all();
    }

    public function find($id)
    {
        return Client::find($id);
    }

    public function create(array $data)
    {
        return Client::create($data);
    }

    public function update($id, array $data)
    {
        $client = Client::find($id);
        $client->update($data);
        return $client;
    }

    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
    }

    public function checkExists($request){
        $client = $this->client->where('last_name', $request->client_name)->exists();
        return $client;
    }

    public function getDataNotExists($request){
        $client = $this->client->create([
            'first_name' => '',
            'last_name' => $request->client_name,
            'email' => '',
            'phone' => $request->phone,
            'address' => $request->description,
            'created_at' => Carbon::now(),
            'upadted_at' => Carbon::now(),
        ]);
        return $client;
    }

    public function getDataExists($request){
        $client = $this->client->where('last_name', $request->client_name)->first();
        return $client;

    }
}