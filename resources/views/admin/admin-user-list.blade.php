@extends('admin.admin-master')
@section('admin')

	<!--Container-->
	<div class="container w-full md:w-4/5 xl:w-4/5 mx-auto px-2">

		<!--Title-->
		<h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
			User List
		</h1>


		<!--Card-->
		<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

			<table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
				<thead>
					<tr>
						<th data-priority="1">Name</th>
						<th data-priority="2">Student ID</th>
						<th data-priority="3">Office</th>
						<th data-priority="4">Age</th>
						<th data-priority="5">Start date</th>
						<th data-priority="6">Email Address</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Tiger Nixon</td>
						<td>System Architect</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>2011/04/25</td>
						<td>$320,800</td>
					</tr>

					<!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->

					<tr>
						<td>Donna Snider</td>
						<td>Customer Support</td>
						<td>New York</td>
						<td>27</td>
						<td>2011/01/25</td>
						<td>$112,000</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!--/Card-->
	</div>
	<!--/container-->

@endsection