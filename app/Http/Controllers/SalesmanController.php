<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SalesmanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Sotuvchi uchun login parol';

        $user = User::where('status', 'salesman')->get();

        return view('salesman.index', compact('title', 'user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );
        $error = Validator::make($request->all(), $rules);


        if ($error->fails()) {
            return response()->json(['error' => $error->errors()->all()]);
        }
        else {
            $data = array(
                'username' => $request->username,
                'phone'    => $request->password,
                'password' => Hash::make($request->password),
            );
            User::whereId($id)->update($data);

            return response()->json(['success' => true]);
        }
    }

}
