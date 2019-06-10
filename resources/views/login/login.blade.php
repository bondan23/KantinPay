@extends('base')

@section('content')
<div class="container" style="margin-top:10px;">
    <div class="row">
        <aside class="offset-sm-4 col-sm-4">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title mb-4 mt-1">Sign in</h4>
                    <form role="form" method="POST" action="{{ url('login')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>Your email</label>
                            <input name="email" class="form-control" placeholder="Email" type="email">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Your password</label>
                            <input name="password" class="form-control" placeholder="******" type="password">
                        </div> <!-- form-group// --> 
                        <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                        </div> <!-- form-group// -->                                                           
                    </form>
                </article>
            </div> <!-- card.// -->
        </aside> <!-- col.// -->
    </div> <!-- row.// -->
</div> 
<!--container end.//-->
@endsection