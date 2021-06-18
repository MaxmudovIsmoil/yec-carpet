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
        $room_id = $rooms[0]->id;

        $i = 1;
        return view('room.index', compact('title', 'rooms', 'i', 'room_id'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);

        if ($validation->passes()) {
            $image = $request->file('image');
            $image_new_name = 'room'.rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/room/'), $image_new_name);


            try {
                RoomModel::create([
                    'name' => $request->post('name'),
                    'image' => $image_new_name,
                    'changed'=> time(),
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
        $image_name = $request->image_hidden;
        $image = $request->file('image');

        if ($image != '') {
            $rules = array(
                'name'      => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            );
            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
            }

            $image_name = 'room'.rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/room/'), $image_name);

        }
        else{
            $rules = array(
                'name'      => 'required|string',
            );
            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'name'      => $request->name,
            'image'     => $image_name,
            'changed'   => time()
        );

        RoomModel::whereId($request->id)->update($form_data);

        return response()->json(['success' => 'Data is successful updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajax_delete(Request $request)
    {
        $id = $request->id;
        $u = RoomModel::findOrFail($id);

        $image_path = public_path("uploaded/room/{$u->image}");
        unlink($image_path);

        $u->delete();

        return response()->json(['status' => 'room_quality', 'id' => $id]);
    }
}
