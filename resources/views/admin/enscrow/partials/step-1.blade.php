<h4 class="text-center my-4">Acknowledge Coin</h4>
@if($trade->transaction_status == "cancelled")
    <div class="text-center">
        <strong class="text-danger" style="font-size: 23px">Trade Cancelled, Close Trade Window</strong>
        <img width="50px" src="{{ asset('assets/img/cancel.gif') }}" alt="cancel">
    </div>
@else
    @if($trade->is_special == 1)
        <div class="text-center">
            <strong class="text-danger" id="info-1-text" style="font-size: 21px">Buyer Cancelled Trade, Click Button Below to Settle Seller on Trades Page</strong>
            <img width="50px" id="info-1-img" src="{{ asset('assets/img/cancel.gif') }}" alt="cancel">
        </div>
    @else
        @if(($trade->buyer_transaction_stage <= 2 && $trade->seller_transaction_stage < 2))
            <div class="text-center">
                <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Seller to Deposit Coin </strong>
                <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
            </div>
        @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
            <div class="text-center">
                <strong class="text-success" id="info-1-text" style="font-size: 23px">Coin Deposited, Verify Coin and Proceed</strong>
                <img width="100px" id="info-1-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
            </div>
        @elseif(($trade->buyer_transaction_stage < 3 && $trade->seller_transaction_stage < 3 && $trade->ace_transaction_stage == 2) || ($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage < 3 && $trade->ace_transaction_stage == 2) || ($trade->buyer_transaction_stage < 3 && $trade->seller_transaction_stage == 3 && $trade->ace_transaction_stage == 2))
            <div class="text-center">
                <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting for Traders to Settle Payment</strong>
                <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="proceed">
            </div>
        @elseif($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 3 && $trade->ace_transaction_stage == 2)
            <div class="text-center">
                <strong class="text-success" id="info-1-text" style="font-size: 23px">Payment Settled, Proceed and Settle</strong>
                <img width="100px" id="info-1-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
            </div>
        @endif
    @endif
@endif

<p>Acknowledge Coin of <strong class="text-success">{{ $trade->coin_amount }} <span class="text-uppercase">{{ $trade->coin->abbr }}</span></strong> in company's <span class="text-uppercase font-weight-bold">@if($trade->seller_wallet_company == "others") Blockchain @else {{ $trade->seller_wallet_company }} @endif</span> wallet, once you receive the coin from <strong>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}</strong>. Please ensure that your coin is received before you proceed, as the transaction will continue between buyer and seller.</p>
<div class="text-center mx-auto mt-4" id="function-button">
    @if($trade->transaction_status == "cancelled")
        <a href="{{ route('admin.transactions.enscrow') }}"  class="btn btn-info px-5">Close Trade Window</a>
    @else
        @if($trade->is_special == 1)
            <a href="{{ route('admin.trade.accept.buy', $trade) }}" class="btn btn-primary p-2">Settle In Trade</a>
        @else
            @if($trade->buyer_transaction_stage <= 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
                <button id="step-1-proceed" class="btn btn-special p-2" type="button">I Have Received Coin</button>
            @else
                <button id="step-2-nav" class="btn btn-special py-2 px-4" type="button">Proceed</button>
            @endif
        @endif
    @endif
</div>
