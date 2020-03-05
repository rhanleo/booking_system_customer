<?php
  use App\Vendors;
?>
@extends('customers.app')

@section('content')
@include('common.success')
      @include('common.error')
      @include('common.errorsession')
			@foreach($vendors as $vendor)
					<div class="col-xs-6 col-sm-4 col-md-3" style='margin-top: 1%;margin-top: 5%;'>
						<div class="product-imagewrapper">
							
							<?php  
							$full_img = Vendors::getLogo($vendor->vendor_logo);
							?>
							
							
							<img src="{{$full_img}}" class="img-responsive" ></a>
						</div>

						<div class="product-content-wrapper" style='text-align:left;'>
							<h5>
									{{$vendor->package_name}}</h5>
							
							<span>PHP {{$vendor->rates}}  </span>
							
							
							<form name="add-to-cart" action="{{route('customer.basket.add')}}" method="post" style="margin-top:5px;clear:both;margin-right: 5px;">
								{!! csrf_field() !!}
								<p  class="btn btn-default addcard-new">
								<input type="hidden" value="1" name="quantity"  />
								<input type="hidden" value="{{$vendor->package_uuid}}" name="package_uuid" />
								<input type="hidden" value="{{$vendor->uuid}}" name="vendor_uuid"  />
								<input type="hidden" value="{{$vendor->rates}}" name="rates" />
								@csrf
								<span class="item-count"></span>
								<input class='btn-success btn' type="submit" value="Add to Cart" name="add_to_cart" class="add" />
								</p>
							</form>
							<form name="add-to-cart" action="{{route('customer.basket.add')}}" method="post">
								{!! csrf_field() !!}
								<p  class="btn btn-default addcard-new">
								<input type="hidden" value="1" name="quantity"  />
								<input type="hidden" value="{{$vendor->package_uuid}}" name="package_uuid" />
								<input type="hidden" value="{{$vendor->uuid}}" name="vendor_uuid"  />
								<input type="hidden" value="{{$vendor->rates}}" name="rates" />
								@csrf
								<span class="item-count"></span>
								<input class='btn-success btn' type="submit" value="BUY NOW" name="book_now" class="book" />
								
								</p>
							</form>	
							
							<br/>				
						</div>  
					</div>
				@endforeach
@endsection
