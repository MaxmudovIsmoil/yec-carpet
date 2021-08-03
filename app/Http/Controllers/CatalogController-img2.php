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
     * index and room
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Xonaga tegishli gilamlar";

        $rooms = RoomModel::all();
        $room_id = $rooms[0]->id;

        $qualities = QualityModel::all();
        $quality_id = $qualities[0]->id;


        $products = CatalogModel::where('room_id', 'LIKE', '%'.$room_id.'%')->orderBy('created_at', 'desc')->paginate(20);


        if ($products) {

            $array = array();
            foreach ($products as $k => $p) {
                $array[$k]['id'] = $p->id;
                $array[$k]['articul'] = $p->articul;
                $array[$k]['code'] = $p->code;
                $array[$k]['price'] = $p->price;
                $array[$k]['room_image'] = $p->room_image;
                $array[$k]['quality_image'] = $p->quality_image;
                $array[$k]['description'] = $p->description;
                $array[$k]['parent_id'] = $p->parent_id;
                $array[$k]['quality_id'] = $p->quality_id;
                $array[$k]['room_id'] = explode(";", $p->room_id);
                $array[$k]['changed'] = $p->changed;
                $array[$k]['created_at'] = $p->created_at;
                $array[$k]['updated_at'] = $p->updated_at;
            }

        }


        return view('catalog.index', compact('title', 'rooms', 'qualities', 'array', 'room_id', 'quality_id', 'products'));
    }


    public function room($id)
    {
        $title = "Xonaga tegishli gilamlar";

        $rooms = RoomModel::all();
        $room_id = $id;

        $qualities = QualityModel::all();
        $quality_id = $qualities[0]->id;


        $products = CatalogModel::where('room_id','LIKE', '%'.$room_id.'%')->orderBy('created_at', 'desc')->paginate(20);

        $array = array();
        foreach($products as $k => $p) {
            $array[$k]['id'] = $p->id;
            $array[$k]['articul'] = $p->articul;
            $array[$k]['code'] = $p->code;
            $array[$k]['price'] = $p->price;
            $array[$k]['room_image'] = $p->room_image;
            $array[$k]['quality_image'] = $p->quality_image;
            $array[$k]['description'] = $p->description;
            $array[$k]['parent_id'] = $p->parent_id;
            $array[$k]['quality_id'] = $p->quality_id;
            $array[$k]['room_id'] = explode(";", $p->room_id);
            $array[$k]['changed'] = $p->changed;
            $array[$k]['created_at'] = $p->created_at;
            $array[$k]['updated_at'] = $p->updated_at;
        }

        return view('catalog.room', compact('title', 'rooms', 'qualities', 'products', 'array', 'quality_id', 'room_id'));
    }


    public function quality($id)
    {
        $title = "Sifatlarga tegishli gilamlar";

        $rooms = RoomModel::all();

        $qualities = QualityModel::all();
        $quality_id = $id;

        $products = CatalogModel::where('quality_id', $quality_id)->orderBy('created_at', 'desc')->paginate(20);

        $array = array();
        foreach($products as $k => $p) {
            $array[$k]['id'] = $p->id;
            $array[$k]['articul'] = $p->articul;
            $array[$k]['code'] = $p->code;
            $array[$k]['price'] = $p->price;
            $array[$k]['room_image'] = $p->room_image;
            $array[$k]['quality_image'] = $p->quality_image;
            $array[$k]['description'] = $p->description;
            $array[$k]['parent_id'] = $p->parent_id;
            $array[$k]['quality_id'] = $p->quality_id;
            $array[$k]['room_id'] = explode(";", $p->room_id);
            $array[$k]['changed'] = $p->changed;
            $array[$k]['created_at'] = $p->created_at;
            $array[$k]['updated_at'] = $p->updated_at;
        }

        return view('catalog.quality', compact('title', 'rooms', 'qualities', 'products', 'array', 'quality_id'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax_add(Request $request)
    {
        $rules = $this->validateDataAdd();

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $error->errors()->all(),
            ]);
        }
        else {

            $room_image = $request->file('room_image');
            if ($room_image) {
                $room_image_new_name = 'room_product'.rand() .'.'.$room_image->getClientOriginalExtension();
                $room_image->move(public_path('uploaded/product/'), $room_image_new_name);
            }


            $quality_image = $request->file('quality_image');
            $quality_image_new_name = 'quality_product'.rand() .'.'.$room_image->getClientOriginalExtension();
            $quality_image->move(public_path('uploaded/product/'), $quality_image_new_name);


            if ($request->room_id)
                $room_ids = implode(";", $request->room_id);
            else
                $room_ids = '';

            try {
                CatalogModel::create([
                    'articul'   => $request->articul,
                    'code'      => $request->code,
                    'price'     => $request->price,
                    'room_id'   => $room_ids,
                    'quality_id'=> $request->quality_id,
                    'description'=> '',
                    'changed'   => time(),
                    'room_image'=> isset($room_image_new_name) ? $room_image_new_name : '',
                    'quality_image'=> isset($quality_image_new_name) ? $quality_image_new_name : ''
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

        $room_image_name = $request->room_image_hidden;
        $room_image = $request->file('room_image');
        if ($room_image != '') {
//            $rules = $this->validateData();

            $room_old_image = CatalogModel::find($request->id);
            $room_image_old_path = public_path("uploaded/product/{$room_old_image->room_image}");
            if (file_exists($room_image_old_path)) {
                unlink($room_image_old_path);
            }

            $room_image_name = 'room_product'.rand().'.'.$room_image->getClientOriginalExtension();
            $room_image->move(public_path('uploaded/product/'), $room_image_name);
        }

        $quality_image_name = $request->quality_image_hidden;
        $quality_image = $request->file('quality_image');

        if ($quality_image != '') {
//            $rules = $this->validateData();

            $quality_old_image = CatalogModel::find($request->id);
            $quality_image_old_path = public_path("uploaded/product/{$quality_old_image->quality_image}");
            if (file_exists($quality_image_old_path)) {
                unlink($quality_image_old_path);
            }

            $quality_image_name = 'quality_product'.rand().'.'.$quality_image->getClientOriginalExtension();
            $quality_image->move(public_path('uploaded/product/'), $quality_image_name);
        }


        if ($request->room_id)
            $room_ids = implode(";", $request->room_id);
        else
            $room_ids = '';


        $form_data = array(
            'articul'   => $request->articul,
            'code'      => $request->code,
            'price'     => $request->price,
            'room_id'   => $room_ids,
            'quality_id'=> $request->quality_id,
            'changed'   => time(),
            'room_image'=> isset($room_image_name) ? $room_image_name : '',
            'quality_image'=> isset($quality_image_name) ? $quality_image_name : ''
        );

        CatalogModel::whereId($request->id)->update($form_data);

        return response()->json(['success' => 'successful', 'id' => $request->id, 'data' => $form_data]);

    }



    public function validateDataAdd()
    {
        return array(
            'articul'   => 'required|string',
            'code'      => 'required|string',
            'price'     => 'required|string',
            'quality_id'=> 'integer',
//            'room_image' => 'required|image|mimes:jpeg,png,jpg',
//            'quality_image' => 'required|image|mimes:jpeg,png,jpg'
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
        $product = CatalogModel::findOrFail($id);

        $room_image_path = public_path("uploaded/product/{$product->room_image}");
        if (file_exists($room_image_path)) {
            unlink($room_image_path);
        }

        $quality_image_path = public_path("uploaded/product/{$product->quality_image}");
        if (file_exists($quality_image_path)) {
            unlink($quality_image_path);
        }

        $product->delete();

        return response()->json(['status' => 'catalog' ,'id' => $id]);

    }


//    /** INDEX and ROOM **/
//    public function ajax_see_again_index_room(Request $request)
//    {
//        $qualities = QualityModel::all();
//        $rooms = RoomModel::all();
//
//        $product_id = $request->product_id;
//        $room_id = $request->sub_category_id ? $request->sub_category_id : 1;
//
//
//        $html = '';
//        $products = DB::table('products')
//            ->select('*')
//            ->orderBy('created_at', 'DESC')
////                ->where('room_id', $sub_category_id)
//            ->where('id', '<', $product_id)
//            ->skip(0)->take(12)
//            ->get();
//
//        $array = array();
//        foreach ($products as $k => $p) {
//            $array[$k]['id'] = $p->id;
//            $array[$k]['articul'] = $p->articul;
//            $array[$k]['code'] = $p->code;
//            $array[$k]['price'] = $p->price;
//            $array[$k]['image'] = $p->image;
//            $array[$k]['description'] = $p->description;
//            $array[$k]['parent_id'] = $p->parent_id;
//            $array[$k]['quality_id'] = $p->quality_id;
//            $array[$k]['room_id'] = explode(";", $p->room_id);
//            $array[$k]['changed'] = $p->changed;
//            $array[$k]['created_at'] = $p->created_at;
//            $array[$k]['updated_at'] = $p->updated_at;
//        }
//
//        foreach($array as $k => $p) {
//            if (in_array($room_id, $p['room_id'])) {
//                $html .= '<div class="catalog js_one_product" data-id="' . $p['id'] . '">
//                            <a class="image" data-fancybox="gallery" style="background-image: url(http://yec.almirab.uz/public/uploaded/product/' . $p['image'] . ')" href="http://yec.almirab.uz/public/uploaded/product/' . $p['image'] . '"></a>
//                            <div class="table-btns">
//                                <table class="table">
//                                    <tbody>
//                                        <tr>
//                                            <td width="25%">Articul:</td>
//                                            <td>' . $p['articul'] . '</td>
//                                        </tr>
//                                        <tr>
//                                            <td>Kod:</td>
//                                            <td>' . $p['code'] . '</td>
//                                        </tr>
//                                        <tr>
//                                            <td>Narx:</td>
//                                            <td>' . $p['price'] . '</td>
//                                        </tr>
//                                    </tbody>
//                                </table>
//                                <div class="edit-delete-btn">
//                                    <a href="" data-toggle="modal" data-target="#edit-model_' . $p['id'] . '" class="btn btn-sm btn-outline-info mr-2" title="Taxrirlash">
//                                        <svg class="c-icon">
//                                            <use xlink:href="http://yec.almirab.uz/public/icons/sprites/free.svg#cil-color-border"></use>
//                                        </svg>
//                                    </a>
//                                    <div class="modal fade" id="edit-model_' . $p['id'] . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
//                                        <div class="modal-dialog modal-lg">
//                                            <div class="modal-content">
//                                                <div class="modal-header">
//                                                    <h5 class="modal-title" id="add-model-Lavel">'.$p['articul'].'</h5>
//                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                                                        <span aria-hidden="true">×</span>
//                                                    </button>
//                                                </div>
//                                                <form method="post" action="' . route('catalog.ajax_edit', [$p['id']]) . '" class="js_edit_product_modal_form_index_room form-group" enctype="multipart/form-data">
//                                                    <input type="hidden" name="_token" value="'.csrf_token().'">
//                                                    <input type="hidden" name="id" value="' . $p['id'] . '">
//                                                    <div class="modal-body">
//                                                        <div class="row">
//                                                            <div class="col-md-8">
//                                                                <div class="row">
//                                                                    <div class="col-md-6 mb-2">
//                                                                        <label for="quality_id' . $p['id'] . '">Sifat</label>
//                                                                        <select type="text" name="quality_id" id="quality_id' . $p['id'] . '" class="form-control">
//                                                                               <option value="">---</option>';
//
//                                                                    foreach ($qualities as $q) {
//                                                                        if ($q['id'] == $p['quality_id'])
//                                                                            $html .= '<option value="' . $q['id'] . '" selected >' . $q['name'] . '</option>';
//                                                                        else
//                                                                            $html .='<option value="' . $q['id'] . '">' . $q['name'] . '</option>';
//                                                                    }
//
//                                                                $html .= '</select>
//                                                                        <span class="valid-feedback text-danger room_id_error"></span>
//                                                                    </div>
//                                                                    <div class="col-md-6 mb-2">
//                                                                        <label for="articul' . $p['id'] . '">Artikul</label>
//                                                                        <input type="text" name="articul" id="articul' . $p['id'] . '" class="form-control" value="' . $p['articul'] . '">
//                                                                        <span class="valid-feedback text-danger articul_error"></span>
//                                                                    </div>
//                                                                    <div class="col-md-6 mb-2">
//                                                                        <label for="code' . $p['id'] . '">Kodi</label>
//                                                                        <input type="text" name="code" id="code' . $p['id'] . '" class="form-control" value="' . $p['code'] . '">
//                                                                        <span class="valid-feedback text-danger code_error"></span>
//                                                                    </div>
//                                                                    <div class="col-md-6 mb-2">
//                                                                        <label for="price' . $p['id'] . '">Narx</label>
//                                                                        <input type="text" name="price" id="price' . $p['id'] . '" class="form-control" value="' . $p['price'] . '">
//                                                                        <span class="valid-feedback text-danger price_error"></span>
//                                                                    </div>
//                                                                    <div class="col-md-12 col-12">
//                                                                        <label for="image' . $p['id'] . '">Rasm</label>
//                                                                        <div class="custom-file">
//                                                                            <input type="hidden" name="image_hidden" value="' . $p['image'] . '">
//                                                                            <input type="file" class="custom-file-input" name="image" id="image' . $p['id'] . '">
//                                                                            <label class="custom-file-label" for="image' . $p['id'] . '">' . $p['image'] . '</label>
//                                                                        </div>
//                                                                        <span class="valid-feedback text-danger invalid_image">Rasmni yuklang</span>
//                                                                    </div>
//                                                                </div>
//                                                            </div>
//                                                            <div class="col-md-3 offset-md-1">
//                                                                <label for="rooms' . $p['id'] . '">Xonalar</label>
//                                                                <div class="room_checkbox">';
//                                                            foreach ($rooms as $r) {
//                                                                $html .= '<div class="form-check mb-1">
//                                                                                <input class="form-check-input" name="room_id[]" type="checkbox" ';
//                                                                    if(in_array($r['id'], $p['room_id'])) {
//                                                                       $html .='checked';
//                                                                    }
//                                                                    $html .= ' value="' . $r['id'] . '" id="room' . $r['id'] . $p['id'] . '">
//                                                                                <label class="form-check-label" for="room' . $r['id'] . $p['id'] . '">' . $r['name'] . '</label>
//                                                                            </div>';
//                                                            }
//                                                            $html .= '<span class="text-danger js_checkbox_error_room_id d-none"></span>
//                                                                </div>
//                                                            </div>
//                                                        </div>
//                                                    </div>
//                                                    <div class="modal-footer mt-3 pb-0">
//                                                        <button class="btn btn-success btn-square">Saqlash</button>
//                                                        <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
//                                                    </div>
//                                                </form>
//                                            </div>
//                                        </div>
//                                    </div>
//                                    <a href="#" data-url="' . route('catalog.ajax_delete') . '" data-name="' . $p['articul'] . '" data-id="' . $p['id'] . '" class="btn btn-sm js_delete_btn btn-outline-danger" title="O\'chirish" data-toggle="modal" data-target="#delete_notify">
//                                        <svg class="c-icon">
//                                            <use xlink:href="http://yec.almirab.uz/public/icons/sprites/free.svg#cil-trash"></use>
//                                        </svg>
//                                    </a>
//                                </div>
//                            </div>
//                        </div>';
//            }
//        }
//
//        return response()->json(['product' => $html]);
//    }
//
//    /** QUALITY **/
//    public function ajax_see_again_quality(Request $request)
//    {
//        $qualities = QualityModel::all();
//        $rooms = RoomModel::all();
//
//        $product_id = $request->product_id;
//        $sub_category_id = $request->sub_category_id;
//        $product_count = $request->product_count;
//
//
//        $products = DB::table('products')
//            ->select('*')
//            ->orderBy('created_at', 'DESC')
//            ->orderBy('code', 'ASC')
//            ->where('quality_id', $sub_category_id)
//            ->where('id', '<', $product_id)
//            ->offset(0)->limit(30)
//            ->get();
//
//        $array = array();
//        foreach ($products as $k => $p) {
//            $array[$k]['id'] = $p->id;
//            $array[$k]['articul'] = $p->articul;
//            $array[$k]['code'] = $p->code;
//            $array[$k]['price'] = $p->price;
//            $array[$k]['image'] = $p->image;
//            $array[$k]['description'] = $p->description;
//            $array[$k]['parent_id'] = $p->parent_id;
//            $array[$k]['quality_id'] = $p->quality_id;
//            $array[$k]['room_id'] = explode(";", $p->room_id);
//            $array[$k]['changed'] = $p->changed;
//            $array[$k]['created_at'] = $p->created_at;
//            $array[$k]['updated_at'] = $p->updated_at;
//        }
//
//        $html = '';
//        foreach($array as $k => $p) {
//
//            $html .= '<div class="catalog js_one_product" data-id="' . $p['id'] . '">
//                            <a class="image" data-fancybox="gallery" style="background-image: url(http://yec.almirab.uz/public/uploaded/product/' . $p['image'] . ')" href="http://yec.almirab.uz/public/uploaded/product/' . $p['image'] . '"></a>
//                            <div class="table-btns">
//                                <table class="table">
//                                    <tbody>
//                                        <tr>
//                                            <td width="25%">Articul:</td>
//                                            <td>' . $p['articul'] . '</td>
//                                        </tr>
//                                        <tr>
//                                            <td>Kod:</td>
//                                            <td>' . $p['code'] . '</td>
//                                        </tr>
//                                        <tr>
//                                            <td>Narx:</td>
//                                            <td>' . $p['price'] . '</td>
//                                        </tr>
//                                    </tbody>
//                                </table>
//                                <div class="edit-delete-btn">
//                                    <a href="" data-toggle="modal" data-target="#edit-model_' . $p['id'] . '" class="btn btn-sm btn-outline-info mr-2" title="Taxrirlash">
//                                        <svg class="c-icon">
//                                            <use xlink:href="http://yec.almirab.uz/public/icons/sprites/free.svg#cil-color-border"></use>
//                                        </svg>
//                                    </a>
//                                    <div class="modal fade" id="edit-model_' . $p['id'] . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
//                                        <div class="modal-dialog modal-lg">
//                                            <div class="modal-content">
//                                                <div class="modal-header">
//                                                    <h5 class="modal-title" id="add-model-Lavel">'.$p['articul'].'</h5>
//                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                                                        <span aria-hidden="true">×</span>
//                                                    </button>
//                                                </div>
//                                                <form method="post" action="' . route('catalog.ajax_edit', [$p['id']]) . '" class="js_edit_product_modal_form_quality form-group" enctype="multipart/form-data">
//                                                    <input type="hidden" name="_token" value="'.csrf_token().'">
//                                                    <input type="hidden" name="id" value="' . $p['id'] . '">
//                                                    <div class="modal-body">
//                                                        <div class="row">
//                                                            <div class="col-md-8">
//                                                                <div class="row">
//                                                                    <div class="col-md-6 mb-2">
//                                                                        <label for="quality_id' . $p['id'] . '">Sifat</label>
//                                                                        <select type="text" name="quality_id" id="quality_id' . $p['id'] . '" class="form-control">
//                                                                               <option value="">---</option>';
//                                                                foreach ($qualities as $q) {
//                                                                    if ($q['id'] == $p['quality_id'])
//                                                                        $html .= '<option value="' . $q['id'] . '" selected >' . $q['name'] . '</option>';
//                                                                    else
//                                                                        $html .='<option value="' . $q['id'] . '">' . $q['name'] . '</option>';
//                                                                }
//
//                                                                $html .= '</select>
//                                                                        <span class="valid-feedback text-danger room_id_error"></span>
//                                                                    </div>
//                                                                    <div class="col-md-6 mb-2">
//                                                                        <label for="articul' . $p['id'] . '">Artikul</label>
//                                                                        <input type="text" name="articul" id="articul' . $p['id'] . '" class="form-control" value="' . $p['articul'] . '">
//                                                                        <span class="valid-feedback text-danger articul_error"></span>
//                                                                    </div>
//                                                                    <div class="col-md-6 mb-2">
//                                                                        <label for="code' . $p['id'] . '">Kodi</label>
//                                                                        <input type="text" name="code" id="code' . $p['id'] . '" class="form-control" value="' . $p['code'] . '">
//                                                                        <span class="valid-feedback text-danger code_error"></span>
//                                                                    </div>
//                                                                    <div class="col-md-6 mb-2">
//                                                                        <label for="price' . $p['id'] . '">Narx</label>
//                                                                        <input type="text" name="price" id="price' . $p['id'] . '" class="form-control" value="' . $p['price'] . '">
//                                                                        <span class="valid-feedback text-danger price_error"></span>
//                                                                    </div>
//                                                                    <div class="col-md-12 col-12">
//                                                                        <label for="image' . $p['id'] . '">Rasm</label>
//                                                                        <div class="custom-file">
//                                                                            <input type="hidden" name="image_hidden" value="' . $p['image'] . '">
//                                                                            <input type="file" class="custom-file-input" name="image" id="image' . $p['id'] . '">
//                                                                            <label class="custom-file-label" for="image' . $p['id'] . '">' . $p['image'] . '</label>
//                                                                        </div>
//                                                                        <span class="valid-feedback text-danger invalid_image">Rasmni yuklang</span>
//                                                                    </div>
//                                                                </div>
//                                                            </div>
//                                                            <div class="col-md-3 offset-md-1">
//                                                                <label for="rooms' . $p['id'] . '">Xonalar</label>
//                                                                <div class="room_checkbox">';
//                                                                foreach ($rooms as $r) {
//                                                                    $html .= '<div class="form-check mb-1">
//                                                                                <input class="form-check-input" name="room_id[]" type="checkbox" ';
//                                                                            if(in_array($r['id'], $p['room_id'])) {
//                                                                                $html .='checked';
//                                                                            }
//                                                                                $html .= ' value="' . $r['id'] . '" id="room' . $r['id'] . $p['id'] . '">
//                                                                                <label class="form-check-label" for="room' . $r['id'] . $p['id'] . '">' . $r['name'] . '</label>
//                                                                            </div>';
//                                                                }
//                                                                $html .= '<span class="text-danger js_checkbox_error_room_id d-none"></span>
//                                                                </div>
//                                                            </div>
//
//                                                        </div>
//                                                    </div>
//                                                    <div class="modal-footer mt-3 pb-0">
//                                                        <button class="btn btn-success btn-square">Saqlash</button>
//                                                        <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
//                                                    </div>
//                                                </form>
//                                            </div>
//                                        </div>
//                                    </div>
//                                    <a href="#" data-url="' . route('catalog.ajax_delete') . '" data-name="' . $p['articul'] . '" data-id="' . $p['id'] . '" class="btn btn-sm js_delete_btn btn-outline-danger" title="O\'chirish" data-toggle="modal" data-target="#delete_notify">
//                                        <svg class="c-icon">
//                                            <use xlink:href="http://yec.almirab.uz/public/icons/sprites/free.svg#cil-trash"></use>
//                                        </svg>
//                                    </a>
//                                </div>
//                            </div>
//                        </div>';
//        }
//
//
//        return response()->json(['product' => $html]);
//    }

}
