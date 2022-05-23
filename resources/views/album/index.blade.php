<x-app-layout>
	<style>
		* {
			box-sizing: border-box;
		}

		label{
		  display: inline-block;
		  background-color: #09BC92;
		  color: white;
		  padding: 0.5rem;
		  font-family: sans-serif;
		  border-radius: 0.3rem;
		  cursor: pointer;
		}

		.album {
		  width: 360px;
		  height: 250px;
		}

		.album:hover {
			cursor: pointer;
			border: 2px solid black;
		}
	</style>

	<section>
		<div class="container mt-5">
			<div class="row ">
				<div class="col-md-12">
					<div class="nav-align-top mb-4">
						<!-- {{-- <span style="float:right;" id="navs-pills-top-home">
							<input type="file" name="upload" id="upload" hidden/>
							<label for="upload">
								<img src="{{ asset('assets/img/icon-upload.svg') }}" alt="logo" width="20" height="20" class="me-2 " style="display: inline;">
								Upload
							</label>
						</span> --}}	 -->
	                    <ul class="nav nav-pills mb-3" role="tablist">
	                      	<li class="nav-item">
		                        <button
		                          type="button"
		                          class="nav-link active"
		                          role="tab"
		                          data-bs-toggle="tab"
		                          data-bs-target="#navs-pills-top-home"
		                          aria-controls="navs-pills-top-home"
		                          aria-selected="true"
		                        >
		                          Album Gallery
		                        </button>
	                      	</li>
	                      	<li class="nav-item">
		                        <button
		                          type="button"
		                          class="nav-link"
		                          role="tab"
		                          data-bs-toggle="tab"
		                          data-bs-target="#navs-pills-top-profile"
		                          aria-controls="navs-pills-top-profile"
		                          aria-selected="false"
		                        >
		                          Album Lokasi
		                        </button>
	                      	</li>
	                      	<li class="nav-item">
		                        <button
		                          type="button"
		                          class="nav-link"
		                          role="tab"
		                          data-bs-toggle="tab"
		                          data-bs-target="#create-album"
		                          aria-controls="create-album"
		                          aria-selected="false"
		                        >
		                          Upload Album
		                        </button>
	                      	</li>
	                    </ul>
	                </div>				
				</div>
			</div>

			<div class="row">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
						<div class="row">
							@foreach($album as $albums)
								@if(!is_null($albums['album']))
									<div class="col-md-4 mb-3" data-bs-toggle="modal"
										data-bs-target="#backDropModal">
										<img src="{{ asset('public/gambar_album/'.$albums->album) }}" alt="album" class="album" >
									</div>

									<!-- MODAL AlLBUM GALLERY -->

									<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
										<div class="modal-dialog">
											<form class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="backDropModalTitle">View & Edit Image</h5>
													<button
													type="button"
													class="btn-close"
													data-bs-dismiss="modal"
													aria-label="Close"
													></button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12 d-flex justify-content-center mb-5">
															<img src="{{ asset('public/gambar_album/'.$albums->album) }}" alt="album" class="album-image" >
														</div>
														<div class="row">
															<div class="col-d-12">
																<div class="nav-align-top ">
																	<ul class="nav nav-pills mb-3" role="tablist">
																		<li class="nav-item">
																			<button
																			type="button"
																			class="nav-link active"
																			role="tab"
																			data-bs-toggle="tab"
																			data-bs-target="#view"
																			aria-controls="view"
																			aria-selected="true"
																			>
																			Info
																			</button>
																		</li>
																		<li class="nav-item">
																			<button
																			type="button"
																			class="nav-link"
																			role="tab"
																			data-bs-toggle="tab"
																			data-bs-target="#view-edit"
																			aria-controls="view-edit"
																			aria-selected="false"
																			>
																			Edit
																			</button>
																		</li>
																	</ul>
																</div>		
															</div>
														</div>
														<div class="row">
															<div class="tab-content">
																<div class="tab-pane fade show active" id="view" role="tabpanel">
																	<p>Lokasi :</p>
																	<p>{{ $albums->lokasi }}</p>
																	<p>Deskripsi :</p>
																	<p>{{ $albums->deskripsi }}</p>
																</div>
																<div class="tab-pane fade" id="view-edit" role="tabpanel">
																	<div class="col-md-12 mb-3">
																		<label for="lokasi" class="col-sm-12 form-label" style="background-color: white;">Lokasi  </label>

																		<input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="isi lokasi kunjungan anda" value="{{ $albums->lokasi }}">
																	</div>
																	<div class="col-md-12 mb-3">
																		<label for="deskripsi" class="form-label" style="background-color: white;">Deskripsi</label>
																		<textarea class="form-control" id="deskripsi" name="deskripsi" rows="5">{{ $albums->deskripsi }}
																		</textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
													Close
													</button>
													<button type="button" class="btn text-white" style="background-color: #09BC92;">Save</button>
												</div>
											</form>
										</div>
									</div>
								@endif
							@endforeach
						</div>
					</div>

					<div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
						<div class="row">
							@foreach($catatan as $lokasi)
								@if(!is_null($lokasi['gambar_lokasi']))
									<div class="col-md-4 mb-3" data-bs-toggle="modal"
                          				data-bs-target="#lokasi{{ $lokasi->id }}">
										<img src="{{ asset('public/gambar_lokasi/'.$lokasi->gambar_lokasi) }}" alt="album" class="album" >
									</div>

									<!-- MODAL ALBUM LOKASI -->

									<div class="modal fade" id="lokasi{{ $lokasi->id }}" data-bs-backdrop="static" tabindex="-1">
										<div class="modal-dialog">
											<form class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="lokasi">View Image</h5>
													<button
													type="button"
													class="btn-close"
													data-bs-dismiss="modal"
													aria-label="Close"
													></button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12 d-flex justify-content-center mb-5">
															<img src="{{ asset('public/gambar_lokasi/'.$lokasi->gambar_lokasi) }}" alt="view-album" class="view-album" >
														</div>
														<p>Lokasi :</p>
														<p>{{ $lokasi->lokasi_kunjung }}</p>
														<p>Deskripsi :</p>
														<p>{{ $lokasi->deskripsi }}</p>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
													Close
													</button>
												</div>
											</form>
										</div>
									</div>
								@endif
							@endforeach
						</div>
					</div>
					<div class="tab-pane fade" id="create-album" role="tabpanel">
						<div class="row">
							<div class="card">
								<div class="card-body">
									<div class="col-md-12">
										<h5 class="mb-4">Upload Photo</h5>
				                        <form action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
				                            @csrf

				                           @if($errors->any())
				                           <div class="alert alert-danger">
				                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
				                                <ul>
				                                    @foreach ($errors->all() as $error)
				                                        <li>{{ $error }}</li>
				                                    @endforeach
				                                </ul>
				                            </div>
				                           @endif
				                            <div class="mb-3">
				                                <label for="uploadalbum" class="form-label" style="background-color: white;">Gambar Album</label>
				                                <input class="form-control" type="file" id="uploadalbum" name="uploadalbum" />
				                            </div>
											<div class="mb-3 mt-2">
												<label for="lokasi" class="col-sm-12 form-label" style="background-color: white;">Lokasi  </label>
												<input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="isi lokasi kunjungan anda">
											</div>
											<div class="col-md-12 mb-3">
												<label for="deskripsi" class="form-label" style="background-color: white;">Deskripsi</label>
												<textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
											</div>
											<div id="deskripsi" class="form-text">
												Kosongkan Saja Jika Tidak Ada
											</div>

				                            <button type="submit" class="btn text-white" style="background-color: #09BC92;">Tambah Album</button>
				                        </form>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>