@section('title', 'Detail Peminjam')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-1">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/operator') }}">Kembali</a>				
		</div>
		<div class="col-sm-11">			
			<h4 class="float-left">Detail Pengembalian</h4>				
		</div>
	</div>
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
	<div class="row">
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
					<tr class="table-info">
						<td>Tanggal Dikembalikan</td>
						<td><strong>{{ date('d-m-Y', strtotime($pn->tgl_kembali)) }}</strong></td>
					</tr>
					<tr class="table-primary">
						<td>Status Pinjam</td>
						<td><strong>{{ $pn->status_peminjaman }}</strong></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-striped">
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
</div>
@stop