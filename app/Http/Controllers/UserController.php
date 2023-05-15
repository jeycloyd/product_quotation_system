<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //view all users
    public function index(){
        $users = User::paginate(5);
        return view('pages.users.index', compact('users'));
    }
    //change role of the user to either admin or viewer
    public function update(Request $request){
        //get the selected user's role
        $userRole = DB::table('users')->where('id',$request->id)->value('role'); 
        //get selected user's name
        $userName = DB::table('users')->where('id',$request->id)->value('name'); 
        //check first if the selected user is currently the authenticated user
        if(auth()->user()->name == $userName){
            return redirect()->back()->with('error',"Cannot change the logged in user's roles");
        }
        //check if user is either admin or viewer
        if($userRole == 'admin'){
            DB::table('users')->where('id',$request->id)->update(['role' => 'viewer']);
            return redirect()->back()->with('success','User has been changed into viewer');
        }else{
            DB::table('users')->where('id',$request->id)->update(['role' => 'admin']);
            return redirect()->back()->with('success','User has been changed into admin');
        }
    }
}
