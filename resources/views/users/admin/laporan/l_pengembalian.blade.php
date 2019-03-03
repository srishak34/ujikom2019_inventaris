@section('title', 'Laporan Transaksi Pengembalian')
@extends('layouts.master')
@section('content')
<div class="container-fluid">	
	<div class="row justify-content-center">
		<div class="col-sm-10">			
			<h4 class="text-center">Laporan Data Transaksi Pengembalian</h4>
			<hr>
			<div class="row">
				<div class="col-sm-9">
					<a class="btn btn-sm btn-dark" href="export_to_pdf_tpengembalian" target="_BLANK">Print Laporan Transaksi Pengembalian</a>
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
							<th>Tanggal Dikembalikan</th>
							<th>Nama Pegawai</th>
							<th colspan="3">Tanggal Transaksi Dibuat</th>
						</tr>
					</thead>
					<tbody>
						@foreach($d as $data)
						<tr>
							<td class="text-center">{{ $no++ }}</td>
							<td>{{ $data->inventaris_id }}</td>
							<td>{{ $data->peminjaman_id }}</td>
							<td>{{ $data->jumlah }}</td>
							<td>{{ date('d-m-Y',strtotime($data->tgl_pinjam)) }}</td>
							<td>{{ date('d-m-Y',strtotime($data->tgl_kembali))}}</td>
							<td>{{ $data->pegawai_id }}</td>
							<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
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

