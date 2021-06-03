<?php

namespace App\Http\Controllers;

use App\Models\RoomModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
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
        $title = "Xonalar";
        $rooms = RoomModel::all();
        $i = 1;
        return view('room.index', compact('title', 'rooms', 'i'));
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajax_add(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'name'  => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validation->passes()) {
            $image = $request->file('image');
            $image_new_name = 'room'.rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/room/'), $image_new_name);


            try {
                RoomModel::create([
                    'name' => $request->post('name'),
                    'image' => $image_new_name,
                ]);

                return response()->json([
                    'status' => 1,
                    'message' => 'rasm yuklandi va bazaga yozildi',
                ]);

            } catch (\Exception $exception) {
                return response()->json([
                    'status' => 2,
                    'message' => $exception,
                ]);
            }

        }
        else{
            return response()->json([
                'status' => 0,
                'message' => $validation->errors()->all(),
            ]);
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajax_edit(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'name'  => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validation->passes()) {
            $image = $request->file('image');
            $image_new_name = 'room'.rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/room/'), $image_new_name);


            try {
                $id = $request->post('id');
                $room = RoomModel::find($id);
                $room->name = $request->post('name');
                if ($image_new_name) {
                    $room->image = $image_new_name;
                }
                $room->save();


                return response()->json([
                    'status' => 1,
                    'message' => 'rasm yuklandi va bazaga yozildi',
                ]);

            } catch (\Exception $exception) {
                return response()->json([
                    'status' => 2,
                    'message' => $exception,
                ]);
            }

        }
        else{
            return response()->json([
                'status' => 0,
                'message' => $validation->errors()->all(),
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = RoomModel::findOrFail($id);

        $image_path = public_path("uploaded/room/{$u->image}");
        unlink($image_path);

        $u->delete();

        return  redirect()->route('room.index');
    }
}
