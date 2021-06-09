@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    <table id="term_payments_table" class="display bg-info" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="text-center">Nomi</th>
                            <th class="text-center">Foizi</th>
                            <th class="text-right">Harakat</th>
                        </tr>
                        </thead>
                        <tbody>

                    @foreach($term_payment as $tp)
                        <tr>
                            <td class="text-center">{{ $tp->name }}</td>
                            <td class="text-center">{{ $tp->percent }} %</td>
                            <td class="text-right">{{ $tp->percent }} %</td>
                        </tr>
{{--                            <input type="checkbox"--}}
{{--                                   name="term_payment"--}}
{{--                                   checked--}}
{{--                                   data-toggle="toggle"--}}
{{--                                   data-on="{{ $tp->name }}"--}}
{{--                                   data-off="{{ $tp->name }}"--}}
{{--                                   data-onstyle="success"--}}
{{--                                   data-offstyle="secondary"--}}
{{--                            />--}}


                        @endforeach
                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>

@endsection
