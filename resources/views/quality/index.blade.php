@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>
                    {{-- Add Modal--}}
                    @include('quality.addModal')

                    <table id="dataTable_staff" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="6%">№</th>
                                <th width="30%">Rasm</th>
                                <th>Nomi</th>
                                <th>Narx</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($quality as $q)
                                <tr class="js_this_tr" data-id="{{ $q->id }}">
                                    <td class="text-center">{{ ++$loop->index }}</td>
                                    <td class="js_td_image dataTable-td-image">
                                        <a data-fancybox="gallery" style='background: url("{{ asset('uploaded/quality/'.$q->image) }}")' href="{{ asset('uploaded/quality/'.$q->image) }}"></a>
                                    </td>
                                    <td>{{ $q->name }}</td>
                                    <td class="text-center">{{ $q->price }}</td>
                                    <td class="text-right">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            <a href="" class="btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit-model{{ $q->id }}">
                                                <svg class="c-icon c-icon-lg">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                </svg>
                                            </a>

                                            <button type="button" data-url="{{ route('quality.ajax_delete') }}" data-name="{{ $q->name }}" data-id="{{ $q->id }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                <svg class="c-icon c-icon-lg" title="O'chirish">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @include('quality.editModal')

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection
