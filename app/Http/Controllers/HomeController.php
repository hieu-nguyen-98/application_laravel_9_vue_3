<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatus;
use App\Http\Requests\User\CreateOrderRequest;
use App\Models\Client;
use App\Repositories\AppointmentRepository;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $productRepository;
    protected $settingRepository;
    public function __construct(
        ProductRepository $productRepository,
        SettingRepository $settingRepository,
        AppointmentRepository $appointmentRepository,
        ClientRepository $clientRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->settingRepository = $settingRepository;
        $this->appointmentRepository = $appointmentRepository;
        $this->clientRepository = $clientRepository;
    }
    public function index(){
        return view('user.app');
    }
    // public function product(){
    //     return view('user.products.index');
    // }
    // public function categories(){
    //     return view('user.categories.index');
    // }

    public function getProducts(){
        $products = $this->productRepository->getProduct();
        return $products;
    }

    public function getSettings(){
        $setting = $this->settingRepository->getSetting();
        return $setting;
    }

    public function detailProduct($id){
        $product = $this->productRepository->find($id);
        return $product;
    }

    public function createOrder(CreateOrderRequest $request){
        $data = $request->all();
        $check_client = $this->clientRepository->checkExists($request);
        if(empty($check_client)){
            $client = $this->clientRepository->getDataNotExists($request);
       }else{
            $client = $this->clientRepository->getDataExists($request);
       }
       $data['status'] = AppointmentStatus::SCHEDULED;
       $data['client_id'] = $client->id;
       $appointment = $this->appointmentRepository->create($data);
       return $appointment;
    }
}
