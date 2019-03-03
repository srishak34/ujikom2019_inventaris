@section('title', 'Inventarisir')
@extends('layouts.master')
@section('content')
<div class="container-fluid">	
	<div class="row justify-content-center">
		<div class="col-sm-10">			
			<h4>Inventarisir</h4>
			<hr>
			<div class="row">
				<div class="col-sm-9">
					<a class="btn btn-sm btn-success" href="dataInventaris/create">Tambah Inventaris Baru</a>	
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
		<div class="col-sm-12">
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
			@if(count($inventaris) < 1)
			<div class="text-center">
				<h4 class="text">Data Tidak ada atau Kosong</h4>
			</div>			
			@else
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Kondisi</th>
							<th>Keterangan</th>
							<th>Jumlah</th>
							<th>Jenis</th>
							<th>Ruang</th>
							<th>Kode</th>
							<th>Petugas</th>
							<th colspan="3">Tanggal Dibuat</th>
						</tr>
					</thead>
					<tbody>
						@foreach($inventaris as $data)
						<tr>
							<td class="text-center">{{ $no++ }}</td>
							<td>{{ $data->nama }}</td>
							<td>{{ $data->kondisi }}</td>
							<td>{{ $data->keterangan }}</td>
							<td>{{ $data->jumlah }}</td>
							<td>{{ $data->jenis_id }}</td>
							<td>{{ $data->ruang_id }}</td>
							<td>{{ $data->kode_inventaris }}</td>
							<td>{{ $data->petugas_id }}</td>
							<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
							<td class="text-center"><a class="btn btn-sm btn-primary" href="dataInventaris/{{ $data->id }}/update">Edit</a></td>
							<td class="text-center">
								<form action="dataInventaris/{{ $data->id}}/delete" method="post">
									@csrf
									<input type="hidden" name="_method" value="DELETE">
									<input type="submit" name="" class="btn btn-sm btn-danger" value="Hapus">
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
@stop