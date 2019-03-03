@section('title', 'Data Pegawai')
@extends('layouts.master')
@section('content')
<div class="container-fluid">	
	<div class="row justify-content-center">
		<div class="col-sm-10">			
			<h4>Data Pegawai</h4>
			<hr>
			<div class="row">
				<div class="col-sm-9">
					<a class="btn btn-sm btn-success" href="dataPegawai/create">Buat Data Pegawai Baru</a>
				</div>
				<div class="col-sm-3">
					<form action="/search" method="POST">
						@csrf
						<div class="input-group">
							<input name="path" class="form-control form-control-sm" value="{{ Request::path() }}" hidden>
							<input type="text" name="search" class="form-control form-control-sm" placeholder="Pencarian" required>&nbsp;
							<span class="input-group-btn">
								<input class="btn btn-sm btn-info" type="submit" name="" value="Cari">
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center mt-2">
		<div class="col-sm-10">
			@if(Session::has('notif_danger'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				{!! session('notif_danger') !!}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@if(Session::has('notif_success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{!! session('notif_success') !!}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@if(count($pegawai) < 1)
			<div class="text-center">
				<h4 class="text">Data Tidak ada atau Kosong</h4>
			</div>			
			@else
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Nama Pegawai</th>
							<th>NIP</th>
							<th>Alamat</th>
							<th colspan="3">Tanggal Dibuat</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pegawai as $data)
						@if($data->nip == null || $data->alamat == null)
						<tr class="table-danger">
							@else
							<tr>
								@endif
								<td class="text-center">{{ $no++ }}</td>
								<td>{{ $data->nama_pegawai }}</td>
								<td>{{ $data->nip == null ? 'DATA TIDAK LENGKAP!!!' : $data->nip }}</td>
								<td>{{ $data->alamat == null ? 'DATA TIDAK LENGKAP!!!' : $data->alamat }}</td>
								<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
								<td class="text-center"><a class="btn btn-sm btn-primary" href="dataPegawai/{{ $data->id }}/update">Edit</a></td>
								<td class="text-center">
									<form class="c_del" action="dataPegawai/{{ $data->id}}/delete" method="post">
										@csrf
										<input type="hidden" name="_method" value="DELETE">
										<input type="submit" name="" onclick="confirmDelete()" class="btn btn-sm btn-danger" value="Hapus">
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>			
				@endif
			</div>
		</div>
	</div>

	<script>
		function confirmDelete() {
			swal({
				title: "Apakah Anda Yakin?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					swal("Proses Penghapusan Akan Di Proses", {
						icon: "success",
					});
				} else {
					swal("Your imaginary file is safe!");
					
				}
			});
		}
	</script>
	@endsection

