<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    //approve user registration
    public function approveUser(Request $request){
        $user = User::findOrFail($request->user_id);
        $user->approval_status = 'Approved';
        $user->role = $request->user_role;
        $user->save();

        return redirect()->back()->with('success','User registration has been approved');
    }
    //disapprove user registration
    public function disapproveUser(Request $request){
        $user = User::findOrFail($request->user_id);
        $user->delete();

        return redirect()->back()->with('success','User registration has been disapproved');
    }
    //search a specific user
    public function search(Request $request){
        $user_role = $request->user_role;
        $search = $request->search;
        
        $users = DB::table('users')->where('name','LIKE', '%'. $search . '%' )->paginate(5);
        $count_users = $users->total();
        return view('pages.users.index',compact('users','count_users'));
    }
    //change password of user
    public function changePassword(Request $request){
        //extract inputs and check if they are the same
        if($request->user_password != $request->confirm_user_password){
            //return password do not match
            return redirect()->back()->with('error','Passwords do not match');
        }
        //update password
        $users = User::findOrFail($request->user_id);
        $users->password = Hash::make($request->user_password);
        $users->save();

        return redirect()->back()->with('success','User password successfully changed');
    }
}
