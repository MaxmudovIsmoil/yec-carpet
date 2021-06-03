<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\GroupModel;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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
        $title = "Hodimlar";
        $usersObj = User::all();

        $users = array();
        foreach($usersObj as $k => $u) {

            if ($u->status == 'manager') {
                $users[$k]['id'] = $u->id;
                $users[$k]['first_name'] = $u->first_name;
                $users[$k]['last_name'] = $u->last_name;
                $users[$k]['phone'] = Helper::phoneFormat($u->phone);
                $users[$k]['username'] = $u->username;
                $users[$k]['status'] = $u->status;
            }
        }
        $i = 1;

        return view('user.index', compact('title', 'users', 'i'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajax_add(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'last_name' => ['required', 'string'],
            'first_name'=> ['required', 'string'],
            'phone'     => ['required', 'string'],
            'address'   => ['required', 'string'],
            'dob'       => ['required', 'string'],
            'username'  => ['required', 'string', 'min:3', 'unique:users'],
            'password'  => ['required', 'min:5'],
            'password_confirm' => ['required_with:password', 'same:password', 'min:5']
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        else{
             $values = [
                'last_name' => $request->post('last_name'),
                'first_name'=> $request->post('first_name'),
                'dob'       => $request->post('dob'),
                'phone'     => $request->post('phone'),
                'address'   => $request->post('address'),
                'gender'    => $request->post('gender'),
                'username'  => $request->post('username'),
                'password'  => $request->post('password'),
                'email'     => '',
                'status'    => 'manager',
             ];
             $query = DB::table('users')->insert($values);

             if ($query)
                return response()->json(['status' => 1, 'msg' => "successful"]);

            return response()->json('sssss');
        }


    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajax_edit(Request $request)
    {
//        $id = $request->post('id');
//
//        $room = User::find($id);
//        $room->name = $request->post('name');
//        $room->save();
//
//        if ($room->save())
//            return response()->json(true);

        return response()->json($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::findOrFail($id);
        $u->delete();

        return  redirect()->route('user.index');
    }
}
