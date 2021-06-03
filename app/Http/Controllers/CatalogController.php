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

        $qualities = QualityModel::all();

        $products = DB::table('products')
            ->select('*')
            ->where('room_id', $room_first_id)
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
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
        $validation =  Validator::make($request->all(), [
            'name'      => 'required|string',
            'price'     => 'required|string',
            'code'      => 'required|string',
            'articul'   => 'required|string',
//            'room_id'   => 'integer',
//            'quality_id'=> 'integer',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);


        if ($validation->passes()) {
            $image = $request->file('image');
            $image_new_name = 'product'.rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/product/'), $image_new_name);


            try {
                $id = $request->post('id');

                $catalog        = CatalogModel::find($id);
                $catalog->name  = $request->post('name');
                $catalog->price = $request->post('price');
                $catalog->code  = $request->post('code');
                $catalog->articul  = $request->post('articul');
                $catalog->room_id  = $request->post('room_id');
                $catalog->quality_id  = $request->post('quality_id');
                if ($image_new_name) {
                    $catalog->image = $image_new_name;
                }
                $catalog->save();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
