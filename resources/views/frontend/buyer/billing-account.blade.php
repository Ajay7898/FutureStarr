@extends('layouts.talent')
@section('title', 'Future Starr | Buyer Dashboard')

@section('content')

<style>
.account-info-section {
    padding: 30px 0 !important;
    background: #fff;
}

.heading-card-dd {
    font-weight: 700 !important;
    background: #ebebeb;
    padding: 10px;
}

.master-card-dd {
    display: flex;
    justify-content: space-between;
}

.master-card-dd div i {
    color: #333333;
    font-size: 24px;
}

.cart-sec-new p:after {
    border: 2px solid grey;
    padding: 1px 7px 0 7px;
    font-family: 'FontAwesome';
    content: "\f068";
    float: right;
}

.cart-sec-new p.collapsed:after {
    border: 2px solid grey;
    padding: 1px 7px 0 7px;
    content: "\f067";
}

.cart-sec-new {
    position: relative;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    padding: 10px 10px 3px 10px;
}

.cart-sec-new a:after {
    content: '';
    width: 100%;
    height: 1px;
    background: #ccc;
    display: block;
    position: absolute;
    left: 0;
    max-width: 100%;
    top: 47px;
}

.foot-buttons {
    float: right;
}

button.save-btn {
    border: 1px solid #c9302c;
    padding: 6px 30px;
    background: #fff;
    font-weight: 600;
}

button.conti-btn {
    border: 1px solid #c9302c;
    padding: 6px 30px;
    background: #c9302c;
    color: #fff;
    font-weight: 600;
}

.wd-50-dd {
    margin: 0;
}

.card-num {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

@media (min-width: 768px) {
    .max-width-50 {
        max-width: 50%
    }
}

.wd-50-dd select {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 6px 12px;
    height: 34px;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- banner start -->
<section class="wow fadeIn cover-background account-info-section-banner"
    style="background-image:url({{ asset('assets/images/account-info.png')}});">
</section>
<!--SideBar-Start---->
<section class="account-info-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <h1>Billing & Payment</h1>

                <div class="cart-sec">
                    <p>Due Balance <b>$0.00</b></p>
                    <p class="heading-card-dd">Billing methods</p>

                    <!-- <p>Primary</p> -->
                    @if(count($cards) > 0)
                        @foreach($cards as $card )
                        <div class="master-card-dd">
                            <div style="display: -webkit-inline-box;"><img src="/assets/images/cart/2.png"
                                    alt="Credit Card">
                                <p style="margin-left:10px">({{$card->brand}}) ending in
                                    {{($card->last4)? $card->last4: '****'}}</p>
                            </div>
                            <div><a href="javascript:void(0)" class="edit-card" data-card="{{$card->id}}"><i class="fa fa-pencil-square-o"
                                        aria-hidden="true"></i></a></div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <div class="cart-sec" style="    padding: 20px 20px 10px 20px;">
                    <p class="heading-card-dd">Add a billing method</p>
                    <div class="cart-sec-new">
                        <p data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                            aria-controls="collapseExample"><a class="btn-billing-method"><input type="radio"
                                    name="payment_method" style="width: auto;"> Bank account</a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <!-- <div class="card-body">
                                <div class="form-row row">
                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label">Account Holder</label>
                                        <input autocomplete="off" class="form-control card-cvc" placeholder="" size="4"
                                            type="text">
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label">Account Type</label>
                                        <select>
                                            <option value="Type1">Type 1</option>
                                            <option value="Type2">Type 2</option>
                                            <option value="Type3">Type 3</option>
                                            <option value="Type4">Type 4</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label">Routing Number</label> <input
                                            class="form-control card-expiry-year" placeholder="" size="4" type="text">
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label">Account Number</label> <input
                                            class="form-control card-expiry-year" placeholder="" size="4" type="text">
                                    </div>

                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label">Note: Your payment information is stored
                                            securely</label>
                                        <img src="/assets/images/card-format.png" alt="Credit Card">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="cart-sec-new">
                    <button class="btn btn-primary btn-md btn-block" id="add-card" type="submit"
                                    data-toggle="modal" data-target="#myModal1">Add Card</button>
                        <!-- <p data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false"
                            aria-controls="collapseExample"><a class="btn-billing-method"><input type="radio"
                                    name="payment_method" style="width: auto;"> Payment Card</a>
                        </p> -->
                        <div class="collapse" id="collapseExample1">
                        
                            
                            
                            <!-- <div class="card-body max-width-50">
                                <div class="form-row row">
                                    <div class="col-xs-12 col-md-12 form-group wd-50-dd">
                                        <div class="card-num">
                                            <div><label class="control-label required">Card Number</label></div>
                                            <div><img src="/assets/images/discover.png"
                                                    alt="Credit Card">
                                                <img src="/assets/images/amex.png"
                                                    alt="Credit Card">
                                                <img src="/assets/images/mastercard.png"
                                                    alt="Credit Card">
                                                <img src="/assets/images/visa.png"
                                                    alt="Credit Card">
                                            </div>
                                        </div>
                                        <input autocomplete="off" class="form-control card-cvc" placeholder="" size="4"
                                            type="text">
                                    </div>

                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label required">First Name</label>
                                        <input autocomplete="off" class="form-control card-cvc" placeholder="First Name"
                                            size="4" type="text">
                                    </div>

                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label required">Last Name</label>
                                        <input class="form-control card-expiry-month" placeholder="Last Name" size="2"
                                            type="text">
                                    </div>

                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label required">Expiration (MM/YY)</label> <input
                                            class="form-control card-expiry-year" placeholder="MM/YY" size="4"
                                            type="text">
                                    </div>

                                    <div class="col-xs-12 col-md-6 form-group wd-50-dd">
                                        <label class="control-label required">Card Security Code</label> <input
                                            class="form-control card-expiry-year" placeholder="1453" size="4"
                                            type="text">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                </div>
                <!-- <div class="foot-buttons">
                    <button class="save-btn">Save</button>
                    <button class="conti-btn">Continue</button>
                </div> -->
            </div>
        </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="{{route('buyer.billing.account.post')}}" method="post"
                        class="require-validation" data-cc-on-file="false"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY_PK_LIVE') }}" id="payment-form">
                <div class="modal-body">
                    <div class="card-body inner" id="update_card_form">
                        @csrf
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group cvc'>
                                <label class='control-label required'>Card Number</label>
                                <input autocomplete='off' class='form-control card-number'
                                    name="card_number" maxlength="16" size='20' type='text'
                                    placeholder='1234 1234 1234 1234'
                                    aria-label="Credit or debit card number">
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc'>
                                <label class='control-label required'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' maxlength="3"
                                    placeholder='ex. 311' size='4' type='text'>
                                <input type="hidden" name="actionType" value="addCard">
                                <input type="hidden" name="card_id" value="" >
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration'>
                                <label class='control-label required'>Expiration Month</label>
                                <input class='form-control card-expiry-month' placeholder='MM' maxlength="2"
                                    size='2' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration'>
                                <label class='control-label required'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' maxlength="4"
                                    size='2' type='text'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-md btn-block" type="submit"
                                    data-toggle="modal" data-target="#myModal1">Update Card</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="update-card-form" action="{{route('buyer.billing.account.post')}}" method="post"
                        class="require-validation-update" data-cc-on-file="false"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY_PK_LIVE') }}" id="payment-form">
                <div class="modal-body">
                    <div class="card-body inner" id="update_card_form">
                        @csrf
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group cvc'>
                                <label class='control-label required'>Card Number</label>
                                <input autocomplete='off' id="card-number" class='form-control'
                                    maxlength="16" size='20' type='text'
                                    placeholder='1234 1234 1234 1234'
                                    aria-label="Credit or debit card number">
                                <input type="hidden" name="actionType" value="">
                                <input type="hidden" id="card_id" name="card_id" value="" >
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group expiration'>
                                <label class='control-label required'>Expiration Month</label>
                                <input class='form-control' name="exp_month" id="expiry-month" placeholder='MM' maxlength="2"
                                    size='2' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration'>
                                <label class='control-label required'>Expiration Year</label> <input
                                    class='form-control' name="exp_year" id="expiry-year" placeholder='YY' maxlength="4"
                                    size='4' type='text'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-md btn-block" type="submit">Update Card</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $('#add-card').on('click', function(e) {
        $('#actionType').val("addCard");
        $('#exampleModal').modal('show');
    });
    $('.edit-card').on('click', function(e) {
        const card_id = $(this).attr('data-card');
        $.ajax({
            method: "GET",
            url: '/buyer/card-details/'+card_id,
            data: null
        }).done(function (data) {
            $('#expiry-year').val(data.exp_year);
            $('#expiry-month').val(data.exp_month);
            $('#card_id').val(card_id);
            $('#card-number').val("**** **** **** "+data.last4);
            $('#card-number').attr("disabled", true);
        });

        $('#actionType').val("");
        $('#exampleModal1').modal('show');
    });

    $(document).on('submit', "#update-card-form", function (e) {
        e.preventDefault();
        $.ajax({
            url: "/buyer/billing-account",
            type: "POST",
            data: $(this).serialize(),
            beforeSend: function () {},
            success: function (data) {
                location.reload();
            },
            error: function (e) {}
        });
    });


    // $('.edit-card').on('click', function(e) {
    //     const card_id = $(this).attr('data-card');
    //     $.ajax({
    //         method: "GET",
    //         url: '/buyer/card-details/'+card_id,
    //         data: null
    //     }).done(function (data) {
    //         $('#expiry-year').val(data.exp_year);
    //         $('#expiry-month').val(data.exp_month);
    //         $('#card-number').val("**** **** **** "+data.last4);
    //         $('#card-number').attr("disabled", true);
    //     });

    //     $('#actionType').val("");
    //     $('#exampleModal').modal('show');
    // });
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });

    function stripeResponseHandler(status, response) {

        if (response.error) {
            toastr.error(response.error.message);
        } else {
            // $("#myModal").modal('hide');
            var sellers = [];
            $('[id^="sub_total"]').each(function() {
                sellers.push($(this).data('seller-id') + '-' + $(this).data('sub-total'));
            });
            var talentId = [];
            $('[id^="talent_id"]').each(function() {
                talentId.push($(this).data('talent-id'));
            });
            // token contains id, last4, and card type
            var token = response['id'];
            var totalAmount = 0;
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.append("<input type='hidden' name='sellers' value='" + sellers + "'/>");
            $form.append("<input type='hidden' name='talent_id' value='" + talentId + "'/>");
            $form.get(0).submit();
        }
    }
});
</script>

@endsection