@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    <table id="dataTable_staff" class="display bg-info" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="text-left" width="3%">№</th>
                            <th class="text-center" width="20%">Nomi</th>
                            <th class="text-center" width="30%">Foizi</th>
                            <th class="text-right">Harakat</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($term_payment as $tp)
                            <tr class="term_tr">
                                <td class="text-center js_term_check_td" data-id="{{ $tp->id }}" data-active="{{ $tp->active }}">
                                    <span>
                                        @if($tp->active)
                                            <svg class="c-icon c-icon-xl term_payment_check_ok js_term_check_icon">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-check-alt') }}"></use>
                                            </svg>
                                        @else
                                            <svg class="c-icon c-icon-xl term_payment_check_no js_term_check_icon">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-x') }}"></use>
                                            </svg>
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">{{ $tp->name }}</td>
                                <td class="text-center">
                                    <span class="js_term_payment_percent room-name">{{ $tp->percent }} %</span>

                                    <form method="post" action="{{ route('termPayment.ajax_edit') }}" class="js_term_edit_from room-form-edit form-group d-none mb-0">

                                        @csrf
                                        <input type="hidden" name="id" value="{{ $tp->id }}" >
                                        <input type="text" name="percent" value="{{ $tp->percent }}" class="form-control col-md-4"/>

                                        <button class="js_term_edit_btn_save btn btn-success btn-sm btn-square ml-3" title="Saqlash">
                                            <svg class="c-icon c-icon-lg" title="Saqlash">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-check') }}"></use>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                        <a href="" class="js_term_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>
                                        <a href="" class="js_term_edit_btn_back d-none btn btn-secondary btn-square btn-sm" title="Bekor qilish">
                                            <svg class="c-icon c-icon-lg" title="Bekor qilish">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-action-undo') }}"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
