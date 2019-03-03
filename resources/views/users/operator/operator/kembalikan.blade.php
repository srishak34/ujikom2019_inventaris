@section('title', 'Detail Peminjam')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		@if(Session::has('notif_danger'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			{!! session('notif_danger') !!}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
	</div>
	<hr>
	<div class="row" style="opacity: 0.6;">
		<div class="col-sm-6">
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th colspan="2">Inventaris</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Nama Inventaris</td>
							<td>{{ $inv->nama }}</td>
						</tr>
						<tr>
							<td>Kondisi</td>
							<td>{{ $inv->kondisi }}</td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td>{{ $inv->keterangan }}</td>
						</tr>
						<tr>
							<td>Jenis</td>
							<td>{{ $inv->jenis_id }}</td>
						</tr>
						<tr>
							<td>Ruang</td>
							<td>{{ $inv->ruang_id }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			
		</div>
		<div class="col-sm-6">
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th colspan="2">Peminjam</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Nama Pegawai</td>
							<td>{{ $pn->pegawai_id }}</td>
						</tr>
						<tr>
							<td>Tanggal Dipinjam</td>
							<td>{{ date('d-m-Y', strtotime($pn->tgl_pinjam)) }}</td>
						</tr>
						<tr class="table-danger">
							<td>Status Pinjam</td>
							<td><strong>{{ $pn->status_peminjaman }}</strong></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<thead class="thead-dark">
						<tr>
							<th colspan="2">Jumlah Yang Dipinjam</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Jumlah</td>
							<td>{{ $d->jumlah }}</td>
						</tr>
					</tbody>
				</table>
			</div>			
		</div>		
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-10 text-center">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td>Status Peminjaman</td>
						<td><s><strong>{{ $pn->status_peminjaman }}</strong></s> <ins><strong>Dikembalikan</strong></ins></td>
					</tr>
				</tbody>
			</table>
			<h4 class="d-inline">Apakah Anda yakin untuk Mengembalikan Inventaris si Peminjam Ini?</h4>
			<a class="btn btn-lg btn-info" href="/operator">Tidak</a>
			<form class="d-inline" action="kembalikan" method="post">
				@csrf
				@method('patch')
				<input class="btn btn-lg btn-danger" type="submit" value="Ya">
			</form>
		</div>
	</div>
</div>
@stop