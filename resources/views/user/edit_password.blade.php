@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-secondary">
                <div class="card-header">
                    <a href="{{ route('catalog.index') }}" class="btn btn-info">Orqaga qaytish</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update_password') }}" method="POST" id="js_update_password_form" class="form-group">
                        @csrf
                        <label for="username" class="mt-2">Login</label>
                        <input type="text" name="username" id="username" readonly class="form-control" value="{{ $username }}">
                        <p class="text-danger username"></p>

                        <label for="password" class="mt-2">Parol</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <p class="text-danger password"></p>

                        <label for="password_confirm" class="mt-2">Parolni tasdiqlash</label>
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                        <p class="text-danger password_confirm"></p>

                        <button class="btn btn-success mt-3">saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
