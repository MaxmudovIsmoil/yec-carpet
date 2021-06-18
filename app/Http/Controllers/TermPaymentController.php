<?php

namespace App\Http\Controllers;

use App\Models\RoomModel;
use App\Models\TermPaymentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermPaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Muddatli to'lovlar";

        $rooms = RoomModel::all();
        $room_id = $rooms[0]->id;

        $term_payment = TermPaymentModel::all();
        $i = 1;
        return view('termpayment.index', compact('title', 'term_payment', 'i', 'room_id'));
    }


    public function ajax_edit(Request $request)
    {
        $rules = array(
            'percent' => 'required|string',
        );
        $error = Validator::make($request->all(), $rules);

        if (!$error) {
            return response()->json(['error' => $error->errors()->all()]);
        }
        else{

            $form_data = array(
                'percent'      => $request->percent,
            );

            TermPaymentModel::whereId($request->id)->update($form_data);
        }

        return response()->json(['message' => 'successfully']);
    }


    public function term_payment_active(Request $request) {

        $id = $request->get('id');

        $form_data = array(
            'active' => $request->get('active')
        );

        try {
            TermPaymentModel::whereId($id)->update($form_data);

            return response()->json([
                'message' => 'Successfully updated',
            ]);
        }
        catch (\Exception $exception) {
            return response()->json([
                'message' => $exception,
            ]);
        }

    }

}
