@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- ddd user modal--}}
                    <div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add-model-Lavel">{{ 'Menejer qo\'shish' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="{{ route('user.ajax_add') }}" method="POST" class="js_user_add_modal_form form-group">

                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                <label for="last_name">Familiya</label>
                                                <input type="text" name="last_name" id="last_name" class="form-control">
                                                <span class="valid-feedback d-block text-danger last_name_error">

                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <label for="first_name">Ism</label>
                                                <input type="text" name="first_name" id="first_name" class="form-control">
                                                <span class="valid-feedback d-block text-danger first_name_error">

                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <label for="phone">Telefon nomer</label>
                                                <input type="text" name="phone" id="phone" class="form-control">
                                                <span class="valid-feedback d-block text-danger phone_error">

                                                </span>
                                            </div>

                                            <div class="col-md-4 col-12 mt-3">
                                                <label for="dob">Tug'ilgan sana</label>
                                                <input type="text" name="dob" id="dob" class="form-control">
                                                <span class="valid-feedback d-block text-danger dob_error">

                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12 mt-3">
                                                <label for="dob">Manzil</label>
                                                <input type="text" name="address" id="address" class="form-control">
                                                <span class="valid-feedback d-block text-danger address_error">

                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12 mt-3">
                                                <label for="address">Jins</label>
                                                <div class="d-flex mt-2">
                                                    <div class="form-check mr-5">
                                                        <input class="form-check-input" type="radio" name="gender" id="male" value="1" checked>
                                                        <label class="form-check-label" for="male">
                                                            Erkak
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="female" value="2">
                                                        <label class="form-check-label" for="female">
                                                            Ayol
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12 mt-4">
                                                <label for="username">Login</label>
                                                <input type="text" name="username" id="username" class="form-control">
                                                <span class="valid-feedback d-block text-danger username_error">

                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12 mt-4">
                                                <label for="password">Parol</label>
                                                <input type="password" name="password" id="password" class="form-control">
                                                <span class="valid-feedback d-block text-danger password_error">

                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12 mt-4">
                                                <label for="password_confirm">Parolni tasdiqlang</label>
                                                <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                                                <span class="valid-feedback d-block text-danger password_confirm_error">

                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer mt-3 pb-0">
                                        <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
                                        <button class="btn btn-danger btn-square">Saqlash</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table id="dataTable_staff" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="6%">№</th>
                                <th>Login</th>
                                <th>Familiya</th>
                                <th>Ism</th>
                                <th>Telefon</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $u)
                                <tr class="js_user_this_tr">
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td><b>{{ $u['username'] }}</b></td>
                                    <td>{{ $u['first_name'] }}</td>
                                    <td>{{ $u['last_name'] }}</td>
                                    <td>{{ $u['phone'] }}</td>
                                    <td class="text-right">
                                        <div class="btn-group js_btn_group" role="group">
                                            <a href="" class="js_eye_btn btn btn-warning btn-square btn-sm" title="Ko'rish">
                                                <svg class="c-icon c-icon-lg" title="Ko'rish">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-low-vision') }}"></use>
                                                </svg>
                                            </a>

                                            <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш">
                                                <svg class="c-icon c-icon-lg">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                </svg>
                                            </a>

                                            <button type="button" class="btn btn-danger btn-square btn-sm" data-toggle="modal" data-target="#delete-model_{{$i}}" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                <svg class="c-icon c-icon-lg" title="O'chirish">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        {{-- Delete modal--}}
                                        <div class="modal fade" id="delete-model_{{$i}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="delete-model_{{$i}}_Lavel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-model_{{$i}}_Lavel">{{ $u['username'] }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        <p style="background: #f8d7da; color: darkred; padding: 5px 7px; border-radius: 5px;line-height: 1.5;">
                                                            Barcha ma'lumotlar qayta tiklanmaydigan bo'lib o'chadi. Siz rosdan ham o'chirmoqchimisiz ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Yo'q</button>
                                                        <form action="{{ route('room.destroy', [$u['id']]) }}" method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <input type="submit" value="Xa" class="btn btn-danger btn-square">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
