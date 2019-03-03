@section('title', 'Transaksi Peminjaman')
@extends('layouts.master')
@section('content')
<div class="container-fluid">	
	<div class="row justify-content-center">
		<div class="col-sm-10">			
			<h4>Transaksi Peminjaman</h4>
			<hr>
			<div class="row">
				<div class="col-sm-9">
					<a class="btn btn-sm btn-success" href="operator/create">Tambah Transaksi Peminjaman Baru</a>
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
		<div class="col-sm-11">
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
			@if(count($d) < 1)
			<div class="text-center">
				<h4 class="text">Data Tidak ada atau Kosong</h4>
			</div>			
			@else
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Nama Inventaris</th>
							<th>Status Peminjaman</th>
							<th>Jumlah</th>
							<th>Tanggal Dipinjam</th>
							<th>Nama Pegawai</th>
							<th colspan="3">Tanggal Transaksi Dibuat</th>
						</tr>
					</thead>
					<tbody>
						@foreach($d as $data)
						@if($data->peminjaman_id == "Pending" || $data->peminjaman_id == "pending")
						<tr class="table-info">
							@else
							<tr>
								@endif
								<td class="text-center">{{ $no++ }}</td>
								<td>{{ $data->inventaris_id }}</td>
								<td>{{ $data->peminjaman_id }}</td>
								<td>{{ $data->jumlah }}</td>
								<td>{{ date('d-m-Y',strtotime($data->tgl_pinjam)) }}</td>
								<td>{{ $data->pegawai_id }}</td>
								<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
								@if($data->peminjaman_id == "Pending" || $data->peminjaman_id == "pending")
								<td class="text-center"><form action="operator/{{ $data->id }}/izinkan" method="POST">
									@csrf
									@method('patch')
									<input class="btn btn-sm btn-success" type="submit" name="" value="Izinkan">
								</form></td>								
								@else
								<td class="text-center"><a class="btn btn-sm btn-warning" href="operator/{{ $data->id }}/kembalikan">Kembalikan</a></td>
								@endif

								<td class="text-center"><a class="btn btn-sm btn-info" href="operator/{{ $data->id }}/detail">Detail</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>			
				@endif
			</div>
		</div>
	</div>
	@endsection

