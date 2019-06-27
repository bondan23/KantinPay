@extends('base')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top:12px;">
        <div class="col-sm-6">
            <h2>Transaction History</h2>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Transaction Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $key => $val)
                    <tr>
                      <th scope="row">{{ $key + 1 }}</th>
                      <td>{{ $val->name }}</td>
                      <td>{{ $val->type }}</td>
                      <td>Rp. {{ number_format($val->amount ,0, '.', '.') }}</td>
                      <td>{{ $val->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-end">
              <div class="col-4 auto-mr">
                {{ $history->links() }}
              <div>
            </div>
        </div>
    </div>
</div>
@endsection