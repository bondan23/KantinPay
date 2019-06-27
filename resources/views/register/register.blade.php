@extends('base')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class ="row" style="margin-top:12px">
        <div class="col-sm-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success Register!</strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    @if(session('errors'))
    <div class ="row" style="margin-top:12px">
        <div class="col-sm-6">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.
            </div>
        </div>
    </div>
    @endif
    <div class="row" style="margin-top:12px;">
        <div class="col-sm-6">
            <h2>Register Admin</h2>
            <form role="form" method="POST" action="{{ url('register') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Nama</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Nama">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password Confirmation</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" name="c_password" placeholder="Password Confirmation">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection