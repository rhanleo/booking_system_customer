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
				</head>
				<body>

				<h2>Check out</h2>

				<table>
				<tr>
					<th>Vendor Name</th>
					<th>Added On</th>
					<th>Package Rates</th>
					
				</tr>
				@foreach( $baskets as $basket)
				<tr>
					<td>{{$basket->vendor_name}} </td>
					<td>{{$basket->created_at}} </td>
					<td>USD {{$basket->package_rates}}</td>
					
					
									
				</tr>
				@endforeach
				<hr/>
				<tr>					
					<th></th>				
					<th><h4>Total amount: USD {{$total->total_rates}}.00</h4></th>	
					<th><div id="paypal-button-container"><h5>Payment</h5></div></th>
										
				</tr>
				<tr>					
					<th></th>
					<th></th>		
					
										
				</tr>
				</table>
			<script
				src="https://www.paypal.com/sdk/js?client-id=Adn_RelyCRRwAvXmVSt6f3svwgdoReV9PvqL-IU9TRpt3RxtcSKgH1-Q_stvnEtcLsNzzEuvZ7p3Ntg8"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
				
			</script>
				
				<script>
				var total = "{{$total->total_rates}}";
				var successRoute = "{{route('customer.checkout.success', $basket->customer_uuid )}}";
				
				paypal.Buttons({
				createOrder: function(data, actions) {
				// This function sets up the details of the transaction, including the amount and line item details.
				return actions.order.create({
					purchase_units: [{
					amount: {
						value: total
					}
					}]
				});
				},
				onApprove: function(data, actions) {
				// This function captures the funds from the transaction.
				return actions.order.capture().then(function(details) {
					// This function shows a transaction success message to your buyer.					
					console.log(data);
					location.replace(successRoute);
					alert('Transaction completed by ' + details.payer.name.given_name);
					
				});
				}
			}).render('#paypal-button-container');
				</script>

@endsection

