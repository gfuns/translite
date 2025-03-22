@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Settings / Webhooks')

<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Settings / Webhooks</h6>
                        <div class="custom-alert fade show custom-alert-primary">
                            <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                            &nbsp;Your Business is under Review!
                        </div>
                        <div class="element-content mt-5 ">
                            <h5>Listen to TransLite Events </h5>
                            <p style="font-size: 12px">Set up your webhook endpoint to receive live events from Credo or
                                learn more about Webhooks.</p>

                            <div class="mt-5 row">
                                <div class="col-12 col-md-6">
                                    <form method="post" action="">
                                        @csrf
                                        <div class="form-group" style="margin-bottom: 30px">
                                            <label for=""><strong>Callback URL <span
                                                        style="color:red">*</span></strong></label>
                                            <input type="text" name="callback_url" value=""
                                                placeholder="www.website.com" class="form-control" required />
                                            <small>A POST request will be sent to this URL every time an event is
                                                triggered
                                                in TransLite.</small>
                                        </div>

                                        <div class="form-group mt-2" style="margin-bottom: 30px">
                                            <label for=""><strong>Token <span
                                                        style="color:red">*</span></strong></label>
                                            <input type="text" name="token" value=""
                                                placeholder="Secret Token" class="form-control" required />
                                            <small>A secret that will be used to sign each request. Used to verify the
                                                webhook is sent from TransLite via the X-Signature header</small>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for=""><strong>Select Events to listen to </strong></label>

                                            <div class="checkbox-container mt-3">
                                                <input class="custom-checkbox" type="checkbox" id="transactionFailed"
                                                    checked>
                                                <div>
                                                    <div class="event-title">transaction.failed</div>
                                                    <div class="event-description">Customer payment declined—possible
                                                        issues
                                                        with payment method or insufficient funds.</div>
                                                </div>
                                            </div>

                                            <div class="checkbox-container">
                                                <input class="custom-checkbox" type="checkbox"
                                                    id="transactionTransferReverse" checked>
                                                <div>
                                                    <div class="event-title">transaction.transfer.reverse</div>
                                                    <div class="event-description">This event occurs when a user either
                                                        underpays or overpays during a transaction. The system
                                                        automatically
                                                        detects the discrepancy and reverses the fund transfer,
                                                        returning
                                                        the amount to the user’s account.</div>
                                                </div>
                                            </div>

                                            <div class="checkbox-container">
                                                <input class="custom-checkbox" type="checkbox" id="settlementSuccess"
                                                    checked>
                                                <div>
                                                    <div class="event-title">transaction.settlement.success</div>
                                                    <div class="event-description">Merchants settlement from a
                                                        transaction
                                                        have been made.</div>
                                                </div>
                                            </div>

                                            <div class="checkbox-container">
                                                <input class="custom-checkbox" type="checkbox"
                                                    id="transactionSuccessful">
                                                <div>
                                                    <div class="event-title">transaction.successful</div>
                                                    <div class="event-description">The payment made by the customer was
                                                        successfully processed and accepted by the payment system.</div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-4"
                                                style="font-size: 14px">Save
                                                changes</button>



                                        </div>
                                    </form>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="code-box">
                                        <pre>
    {
        "event": "transaction.successful",
        "data": {
            "businessCode": "700607002190001",
            "transRef": "cl9H0ON2AB02Qb0s69Mj",
            "businessRef": "PL1683423455304ATm",
            "debitedAmount": 1000.0,
            "transAmount": 1000.0,
            "transFeeAmount": 15.0,
            "settlementAmount": 985.0,
            "customerId": "larrie4christ@gmail.com",
            "transactionDate": "May 7, 2023, 1:37:53 AM",
            "channelId": 1,
            "currencyCode": "NGN",
            "status": 0,
            "paymentMethodType": "MasterCard",
            "paymentMethod": "Card",
            "customer": {
                "customerEmail": "john.wick@yahoo.com",
                "firstName": "John",
                "lastName": "Wick",
                "phoneNo": "23470122199999"
            }
        }
    }
<pre>

                                    </div>
                                    <p class="footer-text">Sample response from transactions webhook</p>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('customjs')

@endsection
