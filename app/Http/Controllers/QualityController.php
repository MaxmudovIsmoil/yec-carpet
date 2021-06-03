<?php

namespace App\Http\Controllers;

use App\Models\QualityModel;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QualityController extends Controller
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
        $title = "Sifatlar";

        $quality = QualityModel::all();
        $i = 1;
        return view('quality.index', compact('title', 'quality', 'i'));
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
            $image_new_name = 'quality'.rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/quality/'), $image_new_name);


            try {
                QualityModel::create([
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
            $image_new_name = 'quality'.rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/quality/'), $image_new_name);


            try {
                $id = $request->post('id');
                $room = QualityModel::find($id);
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
        $u = QualityModel::findOrFail($id);

        $image_path = public_path("uploaded/quality/{$u->image}");
        unlink($image_path);

        $u->delete();

        return  redirect()->route('quality.index');
    }
}
