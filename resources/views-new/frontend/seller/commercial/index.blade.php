@extends('layouts.seller') @section('content')
<div id="seller-header">
   <div id="sub-header" class="container-fluid">
      <div class="row">
         <div class="col-sm-12 top-cls top-cls-l"></div>
      </div>
   </div>
</div>
<section class="buyer-con-section">
   <div class="container">
   <div class="row">
      
     @include('frontend.sidebar.seller')

      <div class="col-md-8 col-sm-8 col-xs-12">
         <div class="buyer-form commercial-sec update">
            
             <div class="row">
                  <div class="col-md-6">
                      <h4>Purchase Commercial Ads</h4>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.index')}}" class="pull-right back-btn seller-graph-back-btn"  title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
                </div>
            <div class="row new-update">
               @if(!empty($plans))
               @foreach($plans as $plan)
               <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="dash-box-sec commercila update">
                     <div class="img-box">
                        <h4>{{$plan->plan_name}}</h4>
                        <p>{{$plan->description}}</p>
                        <h2>${{$plan->price}}</h2>
                        <a href="#" data-toggle="modal" data-target="#myModal-checkout{{$plan->id}}">Buy Now</a>
                     </div>
                  </div>
               </div>
               <div class="modal fade trophy-mod" id="myModal-checkout{{$plan->id}}" role="dialog">
                  <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content checkout">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">×</button> 
                           <h4 class="modal-title">Checkout</h4>
                        </div>
                        <div class="modal-body">
                           <div class="table-responsive">
                              <table class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th>Plan</th>
                                       <th>Details</th>
                                       <th>Price</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr style="height: 150px;">
                                       <td>{{$plan->plan_name}}</td>
                                       <td>{{$plan->description}}</td>
                                       <td>${{$plan->price}}</td>
                                    </tr>
                                    <tr>
                                       <td style="border-bottom:1px solid #ddd";></td>
                                       <td style="border-bottom:1px solid #ddd;">Grand Total</td>
                                       <td style="border-bottom:1px solid #ddd";> ${{$plan->price}}</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <form action ="{{route('addmoney.paypal')}}" method="POST">
                              @csrf;
                              <input type="hidden" name="amount" value="{{$plan->price}}">
                              <input type="hidden" name="plan_id" value="{{$plan->id}}">
                              <input type="hidden" name="title" value="{{$plan->plan_name}}">
                              <input type="hidden" name="quantity" value="1">
                              <!--  <a href="javascript:void(0)" data-dismiss="modal" onclick="payWithPaypal('{{$plan->id}}','{{$plan->plan_name}}','{{$plan->price}}','1')">
                                 <img src="{{asset('assets/images/seller/checkout-paypal.png')}}"></a> -->
                              <input class="paypal" type="image" value="submit" src="{{asset('assets/images/seller/checkout-paypal.png')}}" width="300"  name="submit" onMouseOver="this.src='{{asset('assets/images/seller/checkout-paypal.png')}}'">
                           </form>
                           <!--       <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">
                              <input type="hidden" name="business" value="karanparihar5-facilitator@gmail.com">
                              <input type="hidden" name="cmd" value="_xclick">
                               <input type="hidden" name="item_name" value="{{$plan->plan_name}}">
                              <input type="hidden" name="item_number" value="{{$plan->id}}">
                              <input type="hidden" name="amount" value="{{$plan->price}}">   
                              <input type="hidden" name="currency_code" value="USD">   
                              <input type="hidden" name="cancel_return" value="{{route('seller.paypalSuccess')}}">
                              <input type="hidden" name="return" value="{{route('seller.paypalCancel')}}">
                               <input type="submit" name="submit" value="Pay">
                              </form> -->
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
               @endif 
               <form>
               @csrf;
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="img-box message-sec">
                     <div class="md-form">
                        <label for="message">Send us a message for general questions about FutureStarr's custom package</label>
                        <textarea id="custom_plan" name="custom_plan" rows="2" class="form-control md-textarea"></textarea>
                        <span>Purchase Commercial Ads for users to see on FutureStarr! Your ad will appear on the Talent Mall page <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal-product">Contact Us</a></span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="update-btn">
               <a href="javascript:void();" onclick="postCustomPlan('seller');">Send</a>
               <a href="#" data-dismiss="modal">Cancel</a>
            </div>
            <form>
         </div>
      </div>
   </div>
</section>
<!-- all models -->
<div class="modal fade trophy-mod" id="myModal-product" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content buyer-form product customer-sec">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button> 
            <h4 class="modal-title">Customer Service</h4>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <input type="text" class="form-control" placeholder="Name" name="name" id="name">
               <span class="invalid-feedback" id="nameError"></span>
            </div>
            <div class="form-group">
               <input type="email" class="form-control" placeholder="Email" name="email" id="seller_email">
               <span class="invalid-feedback" id="emailError"></span>
            </div>
            <div class="form-group">
               <textarea name="message" id="seller_message" placeholder="Product Information" required=""></textarea>
               <span class="invalid-feedback" id="messageError"></span>
            </div>
         </div>
         <div class="modal-footer sec-btn">
            <a href="javascript:void(0)" onclick="postSellerContact('seller');">Send</a>
            <a href="#" data-dismiss="modal">Cancel</a>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Redirecting...</h4>
         </div>
         <div class="modal-body">
            <p>Please wait while redirecting you to paypal.</p>
         </div>
         <div class="modal-footer">
           
         </div>
      </div>
   </div>
</div>
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
@endsection
@section('javascript')
<script>
   document.frmTransaction.submit();
</script>
<script type="text/javascript">
   $(document).ready(function(){
        $(".paypal").click(function(){
            setTimeout(function () {
                 $("#myModal").modal('show');
                 $('[id^="myModal-checkout"]').modal('hide');
            }, 2000);
        });
   });
</script>
@endsection

