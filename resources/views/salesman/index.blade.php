@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="text-center" style="width: 35%">Login</th>
                                <td class="text-center">{{ $user[0]->username }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Parol</th>
                                <td class="text-center">{{ $user[0]->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="" class="btn btn-info btn-block btn-square btn-sm" data-toggle="modal" data-target="#edit_model">
                        <svg class="c-icon c-icon-lg">
                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                        </svg> O'zgartirish
                    </a>
                    @include('salesman.editModal')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.js_salesman_update').on('submit', function(e) {
                e.preventDefault();

                var url = $(this).attr('action')
                var model = $('#edit_model')

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "json",
                    data: $(this).serialize(),
                    success: (response) => {

                        if(response.success == true) {
                            location.reload();
                        }
                    },
                    error: (error) => {
                        console.log('error: ', error)
                    }
                })
            });
        });
    </script>
@endsection
