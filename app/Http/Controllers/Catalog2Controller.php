<?php

namespace App\Http\Controllers;

use App\Models\Product2;
use App\Models\QualityModel;
use App\Models\RoomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class Catalog2Controller extends Controller
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
     * quality product2
     *
     * @return \Illuminate\Http\Response
     */
    public function index($quality_id)
    {
        $title = "Sifatga tegishli gilamlar";

        $qualities = QualityModel::all();

        $products = Product2::where('quality_id', 'LIKE', '%'.$quality_id.'%')->orderBy('created_at', 'desc')->paginate(20);

        if ($products) {

            $array = array();
            foreach ($products as $k => $p) {
                $array[$k]['id'] = $p->id;
                $array[$k]['articul'] = $p->articul;
                $array[$k]['code'] = $p->code;
                $array[$k]['price'] = $p->price;
                $array[$k]['image'] = $p->image;
                $array[$k]['quality_id'] = $p->quality_id;
                $array[$k]['changed'] = $p->changed;
                $array[$k]['created_at'] = $p->created_at;
                $array[$k]['updated_at'] = $p->updated_at;
            }
        }

        return view('catalog2.index', compact('title', 'qualities', 'array', 'quality_id', 'products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax_add(Request $request)
    {
        $rules = $this->validateData();
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $error->errors()->all(),
            ]);
        }
        else {
            $image = $request->file('image');
            if  ($paspt) {

                $image_new_name = 'product'.rand() .'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploaded/product2/'), $image_new_name);
            }


            try {
                Product2::create([
                    'articul'   => $request->articul,
                    'code'      => $request->code,
                    'price'     => $request->price,
                    'room_id'   => '',
                    'quality_id'=> $request->quality_id,
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
                    'error' => $exception,
                ]);
            }
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
            $rules = $this->validateData();
            $room_old_image = Product2::find($request->id);

            $image_old_path = public_path("uploaded/product2/{$room_old_image->image}");
            if (file_exists($image_old_path)) {
                unlink($image_old_path);
            }

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
            }

            $image_name = 'product'.rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploaded/product2/'), $image_name);

        }
        else{
            $rules = array(
                'articul'   => 'required|string',
                'code'      => 'required|string',
                'price'     => 'required|string',
                'quality_id'=> 'integer',
            );
            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
            }
        }


        $form_data = array(
            'articul'   => $request->articul,
            'code'      => $request->code,
            'price'     => $request->price,
            'quality_id'=> $request->quality_id,
            'changed'   => time(),
            'image'     => $image_name,
        );

        Product2::whereId($request->id)->update($form_data);

        return response()->json(['success' => 'successful', 'id' => $request->id, 'data' => $form_data]);

    }

    public function validateData()
    {
        return array(
            'articul'   => 'required|string',
            'code'      => 'required|string',
            'price'     => 'required|string',
            'quality_id'=> 'integer',
            'image'     => 'required|image|mimes:jpeg,png,jpg',
        );
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
        $product = Product2::findOrFail($id);

        $image_path = public_path("uploaded/product2/{$product->image}");
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $product->delete();

        return response()->json(['status' => 'catalog' ,'id' => $id]);

    }

}
