@extends('layouts.admin')

@section('content')

            <h3 class="text-dark mb-4">Create Market</h3>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif

                @if(!Auth::user()->bankaccount)
                    <div class="alert col-12 alert-warning text-left" role="alert">You need to update bank details before creating a market</div>
                @else()
                    @if(!Auth::user()->bankaccount->bank_name || !Auth::user()->bankaccount->account_name || !Auth::user()->bankaccount->account_number)
                        <div class="alert col-12 alert-warning text-left" role="alert">You need to update bank details before creating a market</div>
                    @endif
                @endif
            </div>
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3">
                    <p class="text-primary m-0 font-weight-bold">Market Details</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.markets.store') }}">
                        @csrf
                        <div class="form-row profile-row my-2">
                            <div class="col-md-12 mx-auto">
                                <div class="form-row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group text-left">
                                            <label class="text-justify">Select Coin</label>
                                            <select name="coin" id="coin" class="form-control @error('coin') is-invalid @enderror text-capitalize" required>
                                                <option value="">Select Coin</option>
                                                @foreach($coins as $coin)
                                                    <option class="text-capitalize" value="{{ $coin->id }}">{{ $coin->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('coin')
                                            <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group text-left">
                                            <label>Select Market Type </label>
                                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                                <option value="">Market Type</option>
                                                <option value="buy" class="text-success font-weight-bold">I want to buy</option>
                                                <option value="sell" class="text-danger font-weight-bold">I want to sell</option>
                                            </select>
                                            @error('type')
                                            <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group text-left">
                                            <label>Minimum Trade</label>
                                            <input type="text" class="form-control @error('min') is-invalid @enderror" name="min" value="{{ old('min') }}" autocomplete="off" required />
                                            @error('min')
                                            <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group text-left">
                                            <label>Maximun Trade</label>
                                            <input type="text" class="form-control @error('max') is-invalid @enderror" name="max" value="{{ old('max') }}" autocomplete="off" required />
                                            @error('max')
                                            <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <div class="form-group text-left">
                                            <label>USD/NGN Rate</label>
                                            <input type="text" class="form-control @error('rate') is-invalid @enderror" placeholder="e.g 420" value="{{ old('rate') }}" name="rate" autocomplete="off" required />
                                            @error('rate')
                                            <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-5 text-right">
                                    @if(!Auth::user()->bankaccount)
                                        <button class="btn btn-primary form-btn" type="submit" disabled>Create Market </button>
                                    @else()
                                        @if(!Auth::user()->bankaccount->bank_name || !Auth::user()->bankaccount->account_name || !Auth::user()->bankaccount->account_number)
                                            <button class="btn btn-primary form-btn" type="submit" disabled>Create Market </button>
                                        @else
                                            <button class="btn btn-primary form-btn" type="submit">Create Market </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@endsection
