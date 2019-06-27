@extends('base')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top:12px;">
        <div class="col-sm-6">
            <h2>List Admin</h2>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $val)
                    <tr>
                      <th scope="row">{{ $key + 1 }}</th>
                      <td>{{ $val->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection