<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAccountController extends Controller
{
    public function adminList(Request $request){

        $adminList = User:: where('role', 'admin')->when($request->key, function($query, $key){
            $query->where('name', 'like', '%'.$key.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('admin.adminAccount.adminList', compact('adminList'));
        
    }

    // Delete Admin Account
    public function deleteAdmin($id)
    {
        User::where('id', $id)->delete();
        Alert::success('Admin Account Deleted', 'The admin account has been deleted successfully!');
        return back()->with(['deleteSuccess' => 'Admin Account Deleted Successfully!']);
    }
}
