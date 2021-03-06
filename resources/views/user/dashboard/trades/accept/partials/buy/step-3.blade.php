<h4 class="text-center my-4">Step 3</h4>
@if($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 3)
    <div class="text-center" id="transaction-message-waiting">
        <strong class="text-info" id="info-3-text" style="font-size: 23px">Waiting For Seller to Verifiy Payment</strong>
        <img width="50px" id="info-3-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
    </div>
@elseif($trade->seller_transaction_stage == 3 && $trade->buyer_transaction_stage == 3)
    <div class="text-center" id="transaction-message-proceed">
        <strong class="text-success" id="info-3-text" style="font-size: 23px">Payment Verified, Proceed with Trade Below </strong>
        <img width="100px" id="info-3-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
    </div>
@endif
<form class="mb-4">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="transactionID">Transaction ID</label>
                        <div class="d-flex ">
                <input type="text" name="transactionID" id="transactionID" value="{{ $trade->transaction_id }}" class="form-control col-sm-11 col-10" readonly>
                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                <a onclick="copyText('transactionID')" class="col-sm-1 m-0 col-2 btn text-white btn-secondary"><i class="fas fa-copy"></i></a>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Coin Volume</label>
            <input type="text" name="volume" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
        </div>
        <div class="form-group col-md-6">
            <label>Amount in NGN</label>
            <div class="d-flex ">
                <input type="text" name="amountNGN" id="amountNGN" value="{{ round($trade->coin_amount_ngn, 2) }}" class="form-control col-10" readonly>
                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                <a onclick="copyText('amountNGN')" class="col-2 btn text-white m-0 btn-secondary"><i class="fas fa-copy"></i></a>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="address">You are required to transfer a total of <strong>NGN {{ number_format($trade->coin_amount_ngn, 2) }}</strong> to the account details below.</label>
                                   <input type="text" name="bankName" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->bank_name }}" class="form-control" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="address">Account Name</label>
                                   <input type="text" name="accountName" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->account_name }}" class="form-control" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="address">Account Number</label>
            <div class="d-flex ">
                <input type="text" name="accountNumber" id="accountNumber" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->account_number }}" class="form-control col-sm-11 col-10" readonly>
                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                <a onclick="copyText('accountNumber')" class="col-sm-1 col-2 btn text-white m-0 btn-secondary"><i class="fas fa-copy"></i></a>
            </div>
        </div>
        <div class="mx-auto mt-4 text-center">
            <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn m-2 px-4 btn-danger">Cancel Trade</button>
            @if($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 2)
                @if($trade->is_dispute == 1)
                    <button type="button" disabled class="btn btn-info m-2 p-2">Dispute Trade</button>
                @else
                    <a href="{{ route('trade.dispute', $trade) }}" class="btn m-2 btn-info p-2">Dispute Trade</a>
                @endif
            @else
                <button type="button" disabled class="btn btn-info m-2 p-2">Dispute Trade</button>
            @endif
            @if($trade->buyer_transaction_stage == 2)
                <button type="submit" id="step-3-proceed" class="btn btn-special m-2">I Have Made Payment</button>
            @else
                <button type="submit" id="step-4-nav" class="btn btn-special m-2">Proceed</button>
            @endif
        </div>
    </div>
</form>
