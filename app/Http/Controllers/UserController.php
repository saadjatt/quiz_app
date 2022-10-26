<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(User::query()->where('id', '!=', auth()->user()->id)->where('active', $request->active)->get());
    }

    public function getActiveUser()
    {
        return response()->json(User::query()->where('id', '!=', auth()->user()->id)->where('active', 1)->get());
    }

    public function getDeactiveUser()
    {
        return response()->json(User::query()->where('id', '!=', auth()->user()->id)->where('active', 0)->get());
    }

    public function getProfile(Request $request)
    {
       return $this->apiSuccess("", $request->user());
    }

    
    public function getUsers(Request $request)
    {
        try {
            if($request->type == "all") {
                $users = User::query()->where('is_admin', '!=', '1')->where("username", "!=","saad")->where('id', '!=', $request->user()->id)->paginate($request->pageSize);
                return $this->apiSuccess("", $users);
            }
            else if($request->type == "active") {
                $users = User::query()->where('is_admin', '!=', '1')->where("username", "!=","saad")->where('id', '!=', $request->user()->id)->where("active", 1)->paginate($request->pageSize);
                return $this->apiSuccess("", $users);
            }
            else if($request->type == "deactive") {
                $users = User::query()->where('is_admin', '!=', '1')->where("username", "!=","saad")->where('id', '!=', $request->user()->id)->where("active", 0)->paginate($request->pageSize);
                return $this->apiSuccess("", $users);
            }
        } catch (Exception $exception) {
            $this->apiFailed("",[],$exception->getMessage());
        }
    }

    

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'username' => ['required', 'string', 'unique:users', 'min:3', 'max:250'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3', 'confirmed']
        ]);
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json("user {$user->username} has been inserted");
        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }

    

    public function getUser($id)
    {
        try{
            $user = User::query()->where('id', Crypt::decrypt($id))->first();
            $user->becomeSeller = $user->becomeSeller()->exists();
            return response()->json($user);
        } catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            "usrname"=> ['required','email'],
            'password'=> ['required', '']
        ]);
        try {
            if(Auth::attempt())
            {
                return response()->json($request->user());
            }
        } catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    

 
 
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json("user {$user->username} has been deleted");
        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }
}
