@extends('base')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top:12px;">
        <div class="col-sm-6">
            <h2>List User</h2>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $val)
                    <tr>
                      <th scope="row">{{ $key + 1 }}</th>
                      <td>{{ $val->name }}</td>
                      <td>{{ $val->email }}</td>
                      <td>{{ $val->role->name }}</td>
                      @if($val->role_id == 1)
                      <td></td>
                      @else
                      <td>Rp. {{ number_format($val->balance['balance'] ,0, '.', '.') }}</td>
                      @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection