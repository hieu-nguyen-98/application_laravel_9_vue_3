<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        return view('admin.users.index');
    }

    public function getUser(){
        $query = request('query');
        $users = $this->userRepository->all($query);
        
        return $users;
    }

    public function store(StoreUserRequest $request){
        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        return $this->userRepository->create($data);
    }

    public function update(UpdateUserRequest $request, $id){
        $data = $request->all();
        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }

        $user = $this->userRepository->update($id, $request->all());

        return $user;
    }

    public function destory($id)
    {
        $user = $this->userRepository->delete($id);
        if($user){
            return response()->json('message','something went wrong!');
        }
        return response()->noContent();
    }

    public function changeRole(Request $request, $id)
    {
        $role = $this->userRepository->changeRole($request->role, $id);
        return response()->json(['success' => true]);
    }

    public function MultipleDelete(Request $request)
    {
        $ids = $request->ids; 

        if (!empty($ids)) { 
            $this->userRepository->mulDelete($ids);
            return response()->json(['message' => 'Users deleted successfully!']);
        }

        return response()->json(['message' => 'No users to delete.']);
    }
}
