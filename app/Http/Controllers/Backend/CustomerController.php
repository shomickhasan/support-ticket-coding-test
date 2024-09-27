<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerStoreUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        if($user->user_type !=0){
            return redirect()->back()->with('error','you dont have permission');
        }
        $customers =  User::where('user_type', '!=', 0)->orderBy('id','DESC')->get();
        return view('backend.pages.customer.index',compact('customers'));
    }

    public function add_edit($id= null){
        $user = auth()->user();
        if($user->user_type !=0){
            return redirect()->back()->with('error','you dont have permission');
        }

        if($id == null){
            return view('backend.pages.customer.add_edit');
        }
        else{
            $data = User::find($id);
            return view('backend.pages.customer.add_edit',compact('data'));
        }

    }

    public function store(CustomerStoreUpdateRequest $request){
        try{
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'user_type' => 1,
            ]);
            return redirect()->back()->with('message', 'Customer created successfully.');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'Customer created faild.');
        }
    }

    public function update(CustomerStoreUpdateRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            return redirect()->back()->with('message', 'Customer updated successfully.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Customer update failed.');
        }
    }
}
