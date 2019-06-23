@extends('base')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Welcome, {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
    <div class="row" style="margin-top:12px;">
        <div class="col-sm-6">
            <h2>Request Top Up List</h2>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Request Balance</th>
                    <th scope="col">Status</th>
                    <th scope="col"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topup as $key => $val)
                    <tr>
                      <th scope="row">{{ $key + 1 }}</th>
                      <td>{{ $val->users->name }}</td>
                      <td>Rp. {{ number_format($val->request_balance ,0, '.', '.') }}</td>
                      <td>{{ $val->confirmed ? "Confirmed" : "Waiting Approval"}}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="{{ route('action_topup', ['type'=> 1, 'id' => $val->id]) }}" role="button" class="btn btn-success">Approve</a>
                          <a href="{{ route('action_topup', ['type'=> 2, 'id' => $val->id]) }}" role="button" class="btn btn-danger">Decline</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <h2>Request Withdraw List</h2>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Request Balance</th>
                    <th scope="col">Status</th>
                    <th scope="col"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraw as $key => $val)
                    <tr>
                      <th scope="row">{{ $key + 1 }}</th>
                      <td>{{ $val->users->name }}</td>
                      <td>Rp. {{ number_format($val->request_balance ,0, '.', '.') }}</td>
                      <td>{{ $val->confirmed ? "Confirmed" : "Waiting Approval"}}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="{{ route('action_withdraw', ['type'=> 1, 'id' => $val->id]) }}" role="button" class="btn btn-success">Approve</a>
                          <a href="{{ route('action_withdraw', ['type'=> 2, 'id' => $val->id]) }}" role="button" class="btn btn-danger">Decline</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection