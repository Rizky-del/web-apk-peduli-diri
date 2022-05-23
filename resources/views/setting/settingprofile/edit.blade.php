<x-app-layout>
	<style>
		.photo {
			border-color: #09BC92;
            background-color: #09BC92;
            color: white;
		}
		.save {
            border-color: #09BC92;
            background-color: #09BC92;
            color: white;
        }

        .active {
        	background-color: #09BC92;
        }

        .photo:hover {
        	border-color: #09BC92;
        	background-color: #09BC92;
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
	                      <a class="nav-link active" href="{{ route('set-profile') }}"><i class="bx bx-user me-1"></i> Account</a>
	                    </li>
                    <li class="nav-item">
	                    <a class="nav-link " href="{{ route('set-password') }}"
	                       ><i class="bx bx-bell me-1"></i> Ubah Password</a
	                    >
                    </li>
                  </ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<h5 class="card-header">Profile Avatar</h5>
						<div class="card-body text-center">
						<form action="{{ route('set-avatar-update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PATCH')

							@if(Auth::user()->avatar == 'default.png')
		                        <img src="{{ asset('assets/img/avatars/default.png') }}" alt="avatar" class="img-fluid mx-auto" id="uploadedAvatar"/>

		                        @else
		                        <img src="{{ asset('avatars/'.Auth::user()->avatar) }}" alt="avatar" class="img-fluid mx-auto" id="uploadedAvatar" />
	                      	@endif

	                      	<label for="upload" class="btn btn-primary me-2 mb-4 mt-4 photo" tabindex="0">
                            	<span class="d-none d-sm-block">Upload new photo</span>
                            	<i class="bx bx-upload d-block d-sm-none"></i>
	                            <input type="file" id="upload" class="account-file-input" hidden name="avatar"  />
                          	</label>
	                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4 mt-4">
	                            <i class="bx bx-reset d-block d-sm-none"></i>
	                            <span class="d-none d-sm-block">Reset</span>
	                        </button>
	                        <button type="submit" class="btn save">Save</button>
						</form>
                          	<p class="text-muted mb-0 mt-2">Allowed JPG, PNG, JPEG. Max size of 800K</p>
                    	</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<h5 class="card-header">Data Profile</h5>
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
							<form action="{{ route('set-profile-update') }}" method="POST">
								@csrf
								@method('PATCH')

								<div class="mb-3"> 
		                            <label for="nik" class="col-sm-2 form-label">NIK</label>
		                            <input type="number" class="form-control" id="nik" name="nik" value="{{ Auth::user()->nik }}" >
	                        	</div>
		                        <div class="mb-3">
		                            <label for="nama_lengkap" class="col-sm-2 form-label">Nama Lengkap</label>
		                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ Auth::user()->nama_lengkap }}">
		                        </div>
		                        <div class="mb-3">
		                            <label for="email" class="col-sm-2 form-label">Email Saya</label>
		                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
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