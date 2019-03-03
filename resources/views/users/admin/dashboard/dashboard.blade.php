@section('title', 'Dashboard')
@extends('layouts.master')
@push('dashboard')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/chart.css') }}" />
@endpush 
@section('content')
<div class="container-fluid">
	<h2 class="text-center">Inventarisir</h2>
	<div class="row justify-content-center">

		<div class="col-md-3">
			<a href="admin/dataInventaris">
			<div class="card-counter success">
				<i class="fa fa-database"></i>
				<span class="count-numbers">{{ $inv }}</span>
				<span class="count-name">Data Inventarisir</span>
			</div>
			</a>
		</div>

	</div>

	<h2 class="text-center">Data - Data</h2>
	<div class="row justify-content-center">

		<div class="col-md-3">
			<a href="admin/dataPetugas">
			<div class="card-counter bg-primary text-white">
				<i class="fas fa-key"></i>
				<span class="count-numbers">{{ $d_petugas }}</span>
				<span class="count-name">Data Petugas</span>
			</div>
			</a>
		</div>

		<div class="col-md-3">
			<a href="admin/dataPegawai">
			<div class="card-counter text-white" style="background-color: #23CDBC">
				<i class="fa fa-users"></i>
				<span class="count-numbers">{{ $d_pegawai }}</span>
				<span class="count-name">Data Pegawai</span>
			</div>
			</a>
		</div>

		<div class="col-md-3">
			<a href="admin/dataRuang">
			<div class="card-counter text-white" style="background-color: #EE6EF0">
				<i class="fas fa-door-open"></i>
				<span class="count-numbers">{{ $d_ruang }}</span>
				<span class="count-name">Data Ruang</span>
			</div>
			</a>
		</div>

		<div class="col-md-3">
			<a href="admin/dataJenis">
			<div class="card-counter text-white" style="background-color: #D9DA20">
				<i class="fas fa-tags"></i>
				<span class="count-numbers">{{ $d_jenis }}</span>
				<span class="count-name">Data Jenis</span>
			</div>
			</a>
		</div>

	</div>

	<h2 class="text-center">Transaksi</h2>
	<div class="row justify-content-center">

		<div class="col-md-3">
			<a href="admin/trans_peminjaman">
			<div class="card-counter bg-info text-white">
				<i class="fa fa-exchange-alt"></i>
				<span class="count-numbers">{{ $t_pm }}</span>
				<span class="count-name">Transaksi Peminjaman</span>
			</div>
			</a>
		</div>

		<div class="col-md-3">
			<a href="admin/trans_peminjaman">
			<div class="card-counter bg-danger text-white">
				<i class="fas fa-hourglass"></i>
				<span class="count-numbers">{{ $t_pd }}</span>
				<span class="count-name">Transaksi Pending</span>
			</div>
			</a>
		</div>

		<div class="col-md-3">
			<a href="admin/trans_pengembalian">
			<div class="card-counter bg-secondary text-white">
				<i class="fa fa-exchange-alt"></i>
				<span class="count-numbers">{{ $t_pg }}</span>
				<span class="count-name">Transaksi Pengembalian</span>
			</div>
			</a>
		</div>

	</div>
</div>
@stop