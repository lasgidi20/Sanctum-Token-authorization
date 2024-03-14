<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'c_password' => 'required|same:password',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    $success['name'] =  $user->name;
    $success['email'] =  $user->email;

    return $this->sendResponse($success, 'User register successfully.');
  }

  public function login(Request $request)
  {
      if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
          $user = Auth::user(); 
          $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
          $success['name'] =  $user->name;
          $success['email'] =  $user->email;
 
          return $this->sendResponse($success, 'User login successfully.');
      } 
      else{ 
          return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
      } 
  }

  public function logout()
  {
      Auth::logout();
      return response()->json(['message' => 'Logged Out'], 200);
  }
}
