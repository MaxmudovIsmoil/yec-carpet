<?php

namespace App\Http\Controllers;

use App\Models\CatalogModel;
use App\Models\QualityModel;
use App\Models\RoomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name = null)
    {
        $title = "Mahsulot izlash";

        $rooms = RoomModel::all();

        $qualities = QualityModel::all();
        $quality_id = $qualities[0]->id;

        $search = isset($_GET['name']) ? $_GET['name'] : '';

        if ($search)
        {
            $products = DB::table('products')
                ->select('*')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->orWhere('articul', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%')
                ->get();

            $array = array();
            foreach($products as $k => $p) {
                $array[$k]['id'] = $p->id;
                $array[$k]['name'] = $p->name;
                $array[$k]['code'] = $p->code;
                $array[$k]['price'] = $p->price;
                $array[$k]['articul'] = $p->articul;
                $array[$k]['image'] = $p->image;
                $array[$k]['description'] = $p->description;
                $array[$k]['parent_id'] = $p->parent_id;
                $array[$k]['quality_id'] = $p->quality_id;
                $array[$k]['room_id'] = explode(";", $p->room_id);
                $array[$k]['changed'] = $p->changed;
                $array[$k]['created_at'] = $p->created_at;
                $array[$k]['updated_at'] = $p->updated_at;
            }
        }
        else
            $array = array();

        $i = 1;

        return view('search.index', compact('title','array','rooms', 'qualities', 'quality_id', 'i'));

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
        $u = CatalogModel::findOrFail($id);

        $image_path = public_path("uploaded/product/{$u->image}");
        unlink($image_path);

        $u->delete();

        return response()->json(['status' => 'room_quality', 'id' => $id]);
    }
}
