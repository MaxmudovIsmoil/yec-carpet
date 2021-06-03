<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomModel;
use App\Models\QualityModel;
use App\Models\CatalogModel;

class apiController extends Controller
{
    /**
     * get name, image and path in rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_room()
    {
        return RoomModel::all();
    }

    /**
     * get name, image and path in qualities.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_quality()
    {
        return QualityModel::all();
    }

    /**
     * get name, code, articul, price, room_id, quality_id, image and path in Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_product(Request $request)
    {
        return CatalogModel::all();
    }
}
