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

				<h2 class='text-success' style='margin-top: 5%;'>Successfull!  - Thank you for visiting us and making your purchase!
				<a href='{{route("customer.index")}}'><button class='btn btn-success'><h6>Shope more?</h6></button></a>
				</h2> 
				
				

@endsection

