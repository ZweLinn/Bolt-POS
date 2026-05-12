<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function userAccountPage(Request $request) {
        $userList = User:: where('role', 'user')->when($request->key, function($query, $key){
            $query->where('name', 'like', '%'.$key.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('admin.adminAccount.userList', compact('userList'));
    }
}
