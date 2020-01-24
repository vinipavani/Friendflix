<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  public function createUser(Request $request){
    $User = new User();
    $User-> name = $request->name;
    $User-> email = $request->email;
    $User-> password = $request->password;
    $User-> save();

    return response()->json([$User]);
  }
  public function listUser(){
    $User=User::all();

    return response()->json([$User]);
  }
  public function showUser($id){
    $User = User::findOrFail($id);

    return response()->json([$User]);
  }
  public function updateUser(Request $request, $id){

    $User = User::find($id);

      if($User){

        if($request->name){
            $User->name = $request->name;
          }
          else if($request->email){
            $User->email = $request->email;
          }
          else if($request->password){
            $User->password = $request->password;
          }
          else{
            return response()->json(["Insira o parametro a ser atualizado."]);
          }
          $User->save();
            return response()->json([$User]);
      }
      else{
          return response()->json(["Este usuário não existe."]);
      }

      }
      public function deleteUser($id){
        User::destroy($id);
        return response()->json(["User deletado"]);
      }
}
