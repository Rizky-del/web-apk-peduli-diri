<x-app-layout>
	<style>
		.save {
            border-color: #09BC92;
            background-color: #09BC92;
            color: white;
        }
        .save:hover {
            color: white;
        }	
	</style>
	<section class="mb-5">
		<div class="container">
			<div class="row pt-5 pb-4">
				<div class="col-md-12">
					<ul class="nav nav-pills flex-column flex-md-row mb-3">
	                    <li class="nav-item">
	                      <a class="nav-link" href="{{ route('set-profile') }}"><i class="bx bx-user me-1"></i> Account</a>
	                    </li>
                    <li class="nav-item">
	                    <a class="nav-link active" href="{{ route('set-password') }}"
	                       ><i class="bx bx-bell me-1"></i> Ubah Password</a
	                    >
                    </li>
                  </ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<h5 class="card-header">Change Password</h5>
						<div class="card-body">
							@if(count($errors) > 0)
							<div class="alert alert-danger alert-dismissible" role="alert">
								<strong>
									<ul>
										@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</ul>
								</strong>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							@endif 
							@if($message = Session::get('success'))
								<div class="alert alert-success alert-dismissible" role="alert">
									<strong>{{ $message }}</strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							@endif

							<form action="{{ route('set-password') }}" method="POST">
								@csrf
								@method('PATCH')

								<div class="mb-3">
		                            <label for="current_password" class="col-sm-2 form-label">Password Saat Ini</label>
		                            <input type="password" class="form-control" id="current_password" name="current_password" >
	                        	</div>
		                        <div class="mb-3">
		                            <label for="password" class="col-sm-2 form-label">Password Baru</label>
		                            <input type="password" class="form-control" id="password" name="password">
		                        </div>
		                        <div class="mb-3">
		                            <label for="confirm_password" class="col-sm-2 form-label">Konfirmasi Password</label>
		                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
		                        </div>
	                        	<button type="submit" class="btn save">Save</button>
	                        	<a href="{{ route('catatan.index') }}">
	                            	<button type="button" class="btn btn-info">Kembali</button>
	                        	</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>