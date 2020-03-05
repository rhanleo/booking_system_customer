<?php
  use App\Vendors;
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
				

				<h2 style='padding: 10px'>History of Purchased</h2> 
				<a href='{{route("customer.index")}}' style='padding:10px;position: absolute;right: 0;'><button class='btn btn-success'><h6>Shope more</h6></button></a>

				<table>
				@if(count($orders) > 0)
					<tr>
						<th>Vendor Name</th>
						<th>Vendor Contact</th>
						<th>Vendor Email</th>
						<th>Order Status</th>
						<th>Payment Method</th>				
						<th>Added On</th>
						<th>Package Rates</th>
					</tr>
				
					@foreach( $orders as $order)
					<tr>
						<td>{{$order->vendor_name}} </td>
						<td>{{$order->vendor_contact}} </td>
						<td>{{$order->vendor_email}} </td>
						<td>{{$order->order_status}} </td>
						<td>{{$order->payment_method}} </td>
						<td>{{$order->created_at}}</td>
						<td>USD {{$order->order_amount}}</td>
										
					</tr>
					@endforeach
					
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Total amount</th>				
						<th>USD {{$total->total_amount}}</th>					
					</tr>
					
				@else
						<tr>
						<th>No purchase transaction yet.. </th>
					
						</tr>
				@endif
					</table>
					

				
				
				
				
@endsection

