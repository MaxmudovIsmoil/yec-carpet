<?php

namespace App\Http\Controllers;

use App\Models\Product2;
use App\Models\TermPaymentModel;
use Illuminate\Http\Request;
use App\Models\RoomModel;
use App\Models\QualityModel;
use Illuminate\Support\Facades\DB;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{

//    public function __construct($login, $password)
//    {
//        $user = UserModel::where('status', 'salesman')->get();
//        if (($user[0]->unsername == $login) && ($user[0]->passord == Hash::make($password) ) ) {
//
//        }
//    }

    /**
     * get name, image and path in rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_room()
    {
        $room = RoomModel::all();

        $array = array();
        foreach($room as $k => $r) {
            $array[$k]['id'] = $r->id;
            $array[$k]['name'] = $r->name;
            $array[$k]['image'] = "http://yec.almirab.uz/public/uploaded/room/".$r->image;
            $array[$k]['changed'] = $r->changed;
            $array[$k]['updated_at'] = $r->updated_at;
            $array[$k]['created_at'] = $r->created_at;
        }

        return $array;
    }

    /**
     * get name, image and path in qualities.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_quality()
    {
        $quality = QualityModel::all();
        $array = array();
        foreach($quality as $k => $q) {
            $array[$k]['id'] = $q->id;
            $array[$k]['name'] = $q->name;
            $array[$k]['image'] = "http://yec.almirab.uz/public/uploaded/quality/".$q->image;
            $array[$k]['changed'] = $q->changed;
            $array[$k]['updated_at'] = $q->updated_at;
            $array[$k]['created_at'] = $q->created_at;
        }

        return $array;
    }

    /**
     * get name, code, articul, price, room_id, quality_id, image and path in Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_product(Request $request)
    {

//        $products = CatalogModel::all();
        $products = DB::table('products As p')
            ->select('p.*', 'q.price')
            ->leftJoin('qualities As q', 'q.id','=', 'p.quality_id')
            ->orderBy('p.created_at', 'desc')
            ->get();

        $array = array();
        foreach($products as $k => $p) {
            $array[$k]['id'] = $p->id;
            $array[$k]['articul'] = $p->articul;
            $array[$k]['code'] = $p->code;
            $array[$k]['price'] = $p->price;
            $array[$k]['room_image'] = $p->room_image;
            $array[$k]['quality_image'] = $p->quality_image;
            $array[$k]['parent_id'] = $p->parent_id;
            $array[$k]['quality_id'] = $p->quality_id;
            $array[$k]['room_id'] = $p->room_id;
            $array[$k]['changed'] = $p->changed;
            $array[$k]['updated_at'] = $p->updated_at;
            $array[$k]['created_at'] = $p->created_at;
        }

        return $array;
    }


    /**
     * get name, code, articul, price, room_id, quality_id, image and path in Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_product2(Request $request)
    {

//        $products = Product2::all();
        $products = DB::table('products2 As p')
            ->select('p.*', 'q.price')
            ->leftJoin('qualities As q', 'q.id','=', 'p.quality_id')
            ->orderBy('p.created_at', 'desc')
            ->get();

        $array = array();
        foreach($products as $k => $p) {
            $array[$k]['id'] = $p->id;
            $array[$k]['articul'] = $p->articul;
            $array[$k]['code'] = $p->code;
            $array[$k]['price'] = $p->price;
            $array[$k]['image'] = $p->image;
            $array[$k]['quality_id'] = $p->quality_id;
            $array[$k]['changed'] = $p->changed;
            $array[$k]['updated_at'] = $p->updated_at;
            $array[$k]['created_at'] = $p->created_at;
        }

        return $array;
    }


    /**
     * get name, code, articul, price, room_id, quality_id, image and path in Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_term_payment(Request $request)
    {
       $result = DB::table('due_dates')->get();
       return $result;
    }

}
