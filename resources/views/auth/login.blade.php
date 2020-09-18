@extends('admin._master')

@section('title')
    Login
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container mt-5" style="height:80%">
        <div class="row pt-4 d-flex justify-content-center align-content-center" style="height:100%">
            <div class="col-lg-4">
                <div class="card shadow mb-5 bg-white rounded" style="height:auto">
                    <form action="{{url('login')}}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h5 class="mb-0 text-blue">Login Admin</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control {{ \Session::has('auth-error') ? ' is-invalid' : '' }}" required placeholder="email@email.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control {{ \Session::has('auth-error') ? ' is-invalid' : '' }}" required placeholder="password">
                                <div class="invalid-feedback mt-3">
                                    <b>Error :</b> <br/>
                                    Email dan/atau password salah!
                                </div>
                            </div>
                            @if ($errors->has('nidn'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nidn') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="{{url('admin/artikel')}}" class="btn btn-light mr-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection