<?php

namespace App\Http\Controllers;

use App\Models\CatalogModel;
use App\Models\QualityModel;
use App\Models\RoomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CatalogController extends Controller
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
        $title = "Katalog";

        $rooms = RoomModel::all();
        $room_first_id = $rooms[0]->id;

        $limit_id = isset($id) ? $id : $room_first_id;

        $qualities = QualityModel::all();

        $products = DB::table('products')
            ->select('*')
            ->where('room_id', $limit_id)
            ->get();


        return view('catalog.index', compact('title', 'rooms', 'qualities', 'products','room_first_id'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax_add(Request $request)
    {

        $validation =  Validator::make($request->all(), [
            'name'  => 'required|string',
            'price'  => 'required|string',
            'code'  => 'required|string',
            'articul'  => 'required|string',
            'room_id'  => 'required|integer',
            'quality_id'  => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);


        if ($validation->passes()) {

            $image = $request->file('image');
            $image_new_name = 'product'.rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/product/'), $image_new_name);


            try {

                CatalogModel::create([
                    'name'      => $request->post('name'),
                    'code'      => $request->post('code'),
                    'price'     => $request->post('price'),
                    'articul'   => $request->post('articul'),
                    'room_id'   => $request->post('room_id'),
                    'quality_id'=> $request->post('quality_id'),
                    'description'=> '',
                    'changed'   => time(),
                    'image'     => $image_new_name,
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajax_edit(Request $request)
    {
        $image_name = $request->image_hidden;
        $image = $request->file('image');

        if ($image != '') {
            $rules = array(
                'name'      => 'required|string',
                'price'     => 'required|string',
                'code'      => 'required|string',
                'articul'   => 'required|string',
                'room_id'   => 'integer',
                'quality_id'=> 'integer',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            );
            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
            }

            $image_name = 'product'.rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/product/'), $image_name);

        }
        else{
            $rules = array(
                'name'      => 'required|string',
                'price'     => 'required|string',
                'code'      => 'required|string',
                'articul'   => 'required|string',
                'room_id'   => 'integer',
                'quality_id'=> 'integer',
            );
            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'name'      => $request->name,
            'price'     => $request->price,
            'code'      => $request->code,
            'articul'   => $request->articul,
            'room_id'   => $request->room_id,
            'quality_id'=> $request->quality_id,
            'image'     => $image_name
        );

        CatalogModel::whereId($request->id)->update($form_data);

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
        $product = CatalogModel::findOrFail($id);

        $image_path = public_path("uploaded/product/{$product->image}");
        unlink($image_path);

        $product->delete();

        return  redirect()->route('catalog.index');
    }
}
