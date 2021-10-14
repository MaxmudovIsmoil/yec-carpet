<?php

namespace App\Http\Controllers;

use App\Models\CatalogModel;
use App\Models\Product2;
use App\Models\QualityModel;
use App\Models\RoomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
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

    public function index(Request $request)
    {
        $title = "Mahsulot izlash";
        $array = array();

        return view('search.index', compact('title', 'array'));
    }


    public function products(Request $request)
    {
        $title = "Mahsulot izlash";

        $request->validate([
            'search_type'=> 'required',
            'name'       => 'required'
        ]);

        $rooms = RoomModel::all();

        $qualities = QualityModel::all();
        $quality_id = $qualities[0]->id;

        $search = $request->name;

        if ($request->search_type == 'room')
        {
            $products = DB::table('products AS p')
                ->select('p.*' ,'q.price')
                ->leftJoin('qualities AS q', 'q.id', '=', 'p.quality_id')
                ->orWhere('p.articul', 'like', '%' . $search . '%')
                ->orWhere('p.code', 'like', '%' . $search . '%')
                ->get();


            if ($products) {
                $array = array();
                foreach ($products as $k => $p) {
                    $array[$k]['id'] = $p->id;
                    $array[$k]['articul'] = $p->articul;
                    $array[$k]['code'] = $p->code;
                    $array[$k]['price'] = $p->price;
                    $array[$k]['room_image'] = $p->room_image;
                    $array[$k]['quality_id'] = $p->quality_id;
                    $array[$k]['room_id'] = explode(";", $p->room_id);
                    $array[$k]['changed'] = $p->changed;
                    $array[$k]['created_at'] = $p->created_at;
                    $array[$k]['updated_at'] = $p->updated_at;
                }
            }
            else {
                $array = array();
            }
        }
        else {
            $products = DB::table('products2 AS p2')
                ->select('p2.*', 'q.price')
                ->leftJoin('qualities As q', 'q.id', '=', 'p2.quality_id')
                ->orWhere('p2.articul', 'like', '%' . $search . '%')
                ->orWhere('p2.code', 'like', '%' . $search . '%')
                ->get();

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
            else{
                $array = array();
            }
        }
        $search_type = $request->search_type;
        $name = $request->name;
        $i = 1;

        return view('search.index', compact('title','array','rooms', 'qualities',
            'quality_id', 'search_type', 'name', 'i'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajax_product_delete(Request $request)
    {
        $id = $request->id;
        $u = CatalogModel::findOrFail($id);

        $image_path = public_path("uploaded/product/{$u->room_image}");
        unlink($image_path);

        $u->delete();

        return response()->json(['status' => 'room_quality', 'id' => $id]);
    }

    public function ajax_product2_delete(Request $request)
    {
        $id = $request->id;
        $u = Product2::findOrFail($id);

        $image_path = public_path("uploaded/product2/{$u->image}");
        unlink($image_path);

        $u->delete();

        return response()->json(['status' => 'room_quality', 'id' => $id]);
    }
}
