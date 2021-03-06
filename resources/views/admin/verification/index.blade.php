@extends('layouts.admin')

@section('content')
    <h3 class="text-dark mb-4">Verification</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">Verifications</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive-lg">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Verification</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    @if(count($verifications) > 0)
                        @foreach($verifications as $key=>$verification)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $verification->user->display_name }}</td>
                                <td>{{ $verification->user->email }}</td>
                                <td>
                                    <i class="fa fa-circle @if($verification->is_email_verified) text-success @else text-danger @endif icon"></i>
                                    <i class="fa fa-circle @if($verification->is_phone_verified) text-success @else text-danger @endif icon"></i>
                                    <i class="fa fa-circle @if($verification->is_document_verified) text-success @elseif($verification->document_verification_status == "pending") text-warning  @else text-danger @endif icon"></i>
                                </td>
                                <td>{{ $verification->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.verifications.show', $verification) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td>
                            @if($search)
                                <h5 class="font-italic small">No search result for <span class="font-weight-bold">'{{ $val }}'</span></h5>
                            @else
                                <h5 class="font-italic small">No Verification(s) yet</h5>
                            @endif
                        </td>
                    @endif
                    </tbody>
                </table>
                <div class="col-md-8 ml-auto">
                    {{ $verifications->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
