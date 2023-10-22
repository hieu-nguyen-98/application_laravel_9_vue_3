<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Exception\BadRequest;
use Exception;

class ProductController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(){
        return view('admin.products.index');
    }

    public function getProducts(){
        $query = request('query');
        $products = $this->productRepository->all($query);
        
        return $products;
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request){
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAndReturnImageUrl($request->file('image'));
        }

        $product = $this->productRepository->create($data);
        return response()->json(['message' => 'Product created successfully!']);
    }

    public function edit($id){
        $product = $this->productRepository->find($id);
        if($product){
            return view('admin.products.edit');
        };
        abort(StatusCode::NOT_FOUND);
    }

    public function editData(Product $product){
        return $product;
    }

    public function update(UpdateProductRequest $request, $id){
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAndReturnImageUrl($request->file('image'));
        }

        $product = $this->productRepository->update($id, $data);
        return response()->json(['message' => 'Product updated successfully!']);
    }

    protected function uploadAndReturnImageUrl($image)
    {
        try {
            if ($image->isValid()) {
                $uploadedFile = Cloudinary::upload($image->getRealPath(), [
                    'upload_preset' => 'my-custom-preset',
                ]);
                return $uploadedFile->getSecurePath();
            } else {
                return null; 
            }
        } catch (BadRequest $e) {
            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function destroy($id){

        $product = $this->productRepository->delete($id);
        if($product){
            return response()->json('message','something went wrong!');
        }

        return response()->json(['success' => true], StatusCode::OK);
    }

    public function MultipleDelete(Request $request)
    {
        $ids = $request->ids; 

        if (!empty($ids)) { 
            $this->productRepository->mulDelete($ids);
            return response()->json(['message' => 'Users deleted successfully!']);
        }

        return response()->json(['message' => 'No users to delete.']);
    }

    // Frontend
    public function home(){
        return view('user.products.index');
    }

    public function showOrder($id){
        $product = $this->productRepository->find($id);
        if($product){
            return view('user.products.showOrder');
        }
        abort(StatusCode::NOT_FOUND);
    }
}
