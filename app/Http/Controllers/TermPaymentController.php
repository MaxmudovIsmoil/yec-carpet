<?php

namespace App\Http\Controllers;

use App\Models\TermPaymentModel;
use Illuminate\Http\Request;

class TermPaymentController extends Controller
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

    public function index()
    {

        $title = "Muddatli to'lovlar";
        $term_payment = TermPaymentModel::all();

        return view('termpayment.index', compact('title', 'term_payment'));

    }
}
