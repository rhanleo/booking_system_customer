<?php
  use App\Vendors;
  use Illuminate\Support\Facades\Auth; 
?>
@extends('customers.app')

@section('content')
@include('common.success')
      @include('common.error')
      @include('common.errorsession')
	  			<style>
					table {
					font-family: arial, sans-serif;
					border-collapse: collapse;
					width: 100%;
					}

					td, th {
					border: 1px solid #dddddd;
					text-align: left;
					padding: 8px;
					}

					tr:nth-child(even) {
					background-color: #dddddd;
					}
				</style>
				
				

				<h2 style='padding: 10px'>Shopping Basket</h2>
				<a href='{{route("customer.index")}}' style='padding:10px;position: absolute;right: 0;'><button class='btn btn-success'><h6>Shope more</h6></button></a>
				<a href='{{route("customer.checkout", Auth::user()->uuid)}}' style='padding:10px;position: absolute;right: 130px;'><button class='btn btn-info'><h6>Check out</h6></button></a>
				<table>
				@if(count($baskets) > 0)
					<tr>
						<th>Vendor Name</th>
						<th>Vendor Contact</th>
						<th>Vendor Email</th>					
						<th>Added On</th>
						<th>Package Rates</th>
						<th>Action</th>
					</tr>
				
					@foreach( $baskets as $basket)
					<tr>
						<td>{{$basket->vendor_name}} </td>
						<td>{{$basket->vendor_contact}} </td>
						<td>{{$basket->vendor_email}} </td>
						<td>{{$basket->created_at}}</td>
						<td>USD {{$basket->package_rates}}</td>
						<td><a href='{{route("customer.basket.remove", $basket->basket_uuid)}}'>Remove</a></td>
										
					</tr>
					@endforeach
					
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th>Total amount</th>				
						<th>USD {{$total->total_rates}}</th>
						<th></th>					
					</tr>
					
				@else
						<tr>
						<th>Your basket was empty!</th>
						
						</tr>
				@endif
					</table>
				

				
				
				
				
@endsection

