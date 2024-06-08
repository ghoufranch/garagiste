@extends('admin.layouts.app')

@section('content')



		<!-- Site wrapper -->
<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="col-md-4">
							@if(Session::has('success'))
							<div class="alert alert-succes" role="alert">
								{{Session::get('success')}}
							</div>
							@endif
						</div>
						<form action="{{route('users.import_data')}}" class="row g-3" method="post" enctype="multipart/form-data">
							@csrf
							<div class="d-flex">
								<input type="file" name="excel_file" class="form-control">
								<button type="submit" class="btn btn-primary"><svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="M5 12V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-4m5-13v4a1 1 0 0 1-1 1H5m0 6h9m0 0-2-2m2 2-2 2"/>
								  </svg>
								  </button>
							</div>
							@error('excel_file')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</form>
						<div class="row mb-4">
							
							<div class="col-sm-6">
								<h1>Users</h1>
							</div>
							<div class="col-sm-12 text-right ">
								<a href="{{route('users.create')}}" class="btn btn-primary">Add User</a>
								<a href="{{route('users.export_data')}}" class=""> export data <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="M19 10V4a1 1 0 0 0-1-1H9.914a1 1 0 0 0-.707.293L5.293 7.207A1 1 0 0 0 5 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2M10 3v4a1 1 0 0 1-1 1H5m5 6h9m0 0-2-2m2 2-2 2"/>
								  </svg>
								</a>

								<a href="{{route('users.export_pdf')}}"><svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
									<path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z" clip-rule="evenodd"/>
								  </svg>
								  </a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class=" ">
					<!-- Default box -->
					<div class="">
                        @include('admin.message')
						<div class="card">
                            <form action="" method="get">
								
							<div class="card-header">
                
								<div class="card-tools">
									<div class="input-group input-group" style="width: 250px;">
										<input value="{{ Request::get('keyword')}}" type="text" name="table_search" class="form-control float-right" placeholder="Search">
					
										<div class="input-group-append">
										  <button type="submit" class="btn btn-default" type="button" onclick="window.location.href='{{route('users.index')}}'" >
											<i class="fas fa-search"></i>
										  </button>
										</div>
									  </div>
								</div>
							</div>
                            </form>

							<div class="card-body table-responsive p-0">								
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">id</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
                                            <th>Address</th>
											<th width="100">Actions</th>
										</tr>
									</thead>
									<tbody>
                                        @if($users ->isNotEmpty())
                                            @foreach($users as $user )
										<tr>
											<td>{{$user->id}}</td>												
                                            <td>{{$user->name}}</td>	
                                            <td>{{$user->email}}</td>
											<td>{{$user->phone}}</td>
											<td>{{$user->address}}</td>
											<td>
                                                <a href="{{route('users.edit', $user->id)}}">
													<svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
													</svg>
												</a>
												<a href="#" onclick="deleteUser({{$user->id}})" class="text-danger w-4 h-4 mr-1">
													<svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
												  	</svg>
												</a> 
                                               
                                            </td>
										</tr>
										@endforeach
                                        @else
                                        <tr>
                                            <td colspan="5">Record not found</td>
                                        </tr>
                                        @endif
									</tbody>
								</table>
								<div class="pagination " >{{$users->links()}}</div>	
                                </div>	
                               
                                
						</div>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
               
            </div>
        </div>
 @endsection
@section('customJs')

<script>
    function deleteUser(id) {
        var url = '{{ route("users.delete", ":id") }}';
        var newUrl = url.replace(":id", id);

        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status) {
                        window.location.href = "{{ route('users.index') }}";
                    } else {
                        alert(response.message);
                    }
                },
                error: function(response) {
                    alert("An error occurred while deleting the user.");
                }
            });
        }
    }
</script>


@endsection
			

