@extends('base')

@section('content')
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