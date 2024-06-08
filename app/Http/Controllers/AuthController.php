<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(){
        return view('account.login');
    }

    public function register(){
        return view('account.register');
    }

    public function processRegister(Request $request){
    
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:4'
        ]);
    
        if($validator->passes()){

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            $user->save();
    
            session()->flash('success','you have been registerd succesfully');
            return response()->json([
                'status' => true,
               
            ]);
            
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        };
        
    }

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|min:4'
        ]);

        if($validator->passes()){

            if(Auth::attempt(['email'=>$request->email,
                            'password'=>$request->password])){

                                return redirect()->route('account.profile');

                            }else{
                               // session()->flash('error','either email or password incrorrect');
                                return redirect()->route('account.login')
                                    ->withInput($request->only('email'))
                                    ->with('error','either email or password incrorrect');
                            }


            } else{
                return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
            };

            }

             

            public function profile(){
                $user = User::where('id',Auth::user()->id)->first();
                return view('account.profile',[
                    'user' => $user
                ]);
            }
         
                public function updateProfile(Request $request){

                    $userId = Auth::user()->id;

                    $validator = Validator::make($request->all(),[
                        'name' => 'required',
                        'email' => 'required|email|unique:users,email,'.$userId.',id',
                        'phone' => 'required',
                        'address' => 'required'
                    ]);

                    if($validator->passes()){
                        $user = User::find($userId);

                        $user -> name = $request->name;
                        $user -> email = $request->email;
                        $user -> phone = $request->phone;
                        $user -> address = $request->address;
                        $user->save();

                        session()->flash('success' , 'Profile updated successfully');

                        return response()->json([
                            'status' => true,
                            
                        ]);

                    } else{
                        return response()->json([
                            'status' => false,
                            'errors' => $validator->errors()
                        ]);
                    }

                    
            }

            public function logout() {
                Auth::logout();
                return redirect()->route('account.login')->with('success', 'Logged out successfully');
            }
            

    
}

