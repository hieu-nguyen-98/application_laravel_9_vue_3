<?php
namespace App\Repositories;

use App\Models\Product;
use App\Enums\TypePaginate;

class ProductRepository implements BaseRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        $perPage = TypePaginate::TEN;
        return Product::query()
        ->when(request('query'), function ($query, $searchQuery) {
            $query->where('name', 'like', "%{$searchQuery}%");
        })
        ->latest()
        ->paginate($perPage);
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
    }

    public function mulDelete($ids){
        return $this->product->whereIn('id', $ids)->delete();
    }

    public function getProduct(){
        return $this->product->all();
    }
}