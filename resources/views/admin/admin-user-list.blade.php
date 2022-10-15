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
						<th data-priority="1">ID</th>
						<th data-priority="2">Student ID</th>
						<th data-priority="3">Last Name</th>
						<th data-priority="4">First Name</th>
						<th data-priority="5">Email Address</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->student_id }}</td>
						<td>{{ $user->last_name }}</td>
						<td>{{ $user->first_name }}</td>
						<td>{{ $user->email }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!--/Card-->
	</div>
	<!--/container-->

@endsection