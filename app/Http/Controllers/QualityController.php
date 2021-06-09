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
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);

        if ($validation->passes()) {
            $image = $request->file('image');
            $image_new_name = 'quality'.rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/quality/'), $image_new_name);


            try {
                QualityModel::create([
                    'name' => $request->post('name'),
                    'image' => $image_new_name,
                    'changed'   => time(),
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

            $image_name = 'quality'.rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/quality/'), $image_name);

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

        QualityModel::whereId($request->id)->update($form_data);

        return response()->json(['success' => 'Data is successful updated']);


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
