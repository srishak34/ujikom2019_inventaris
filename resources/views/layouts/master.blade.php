<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title')</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bst.css') }}">
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/bst.js') }}"></script>
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{ asset('js/jquery.slidereveal.js') }}"></script>
	@stack('dashboard')

	<style>
		html, body {
			height: 100%;
		}
		td {
			font-size: 1.1rem;
		}
	</style>
</head>
<body>
	

	@if (Request::is('loginPage') || Request::is('registerPage'))
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="container-fluid">
			<ul class="m-0">
				<div class="bg-white d-inline">
					<a class="navbar-brand mx-0 p-2" href="{{ url('/') }}">
              		<img alt="" src="{{ asset('img/logo.png') }}">
	            	</a>	            	
				</div>				
				<a class="navbar-brand ml-2" href="{{ url('/') }}">
					Inventaris SMK Pasundan 2 Cianjur
				</a>
			</ul>
			
					
		</div>
	</nav>
	@else
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="container">
			<button class="btn btn-sm btn-info float-left" id="trigger">Menu</button>
			
			
			@if (Auth::user()->level_id == 1)
			<a class="navbar-brand" href="/admin">
				Inventaris SMK Pasundan 2 | Dashboard Admin
			</a>				
			@elseif(Auth::user()->level_id == 2)			
			<a class="navbar-brand" href="/operator">
				Inventaris SMK Pasundan 2 | Dashboard Operator
			</a>
			
			@else
			<a class="navbar-brand" href="/dashboard">
				Inventaris SMK Pasundan 2 | Dashboard Peminjam
			</a>
			@endif
			<ul class="nav navbar">
				<li class="nav-item"><a class="btn btn-sm btn-outline-secondary" href="/logout">Logout</a></li>
			</ul>
		</div>
	</nav>
	<div style="overflow: scroll;" class="bg-light" id="slider">
		<div class="container-fluid mb-1 p-2">
			<div class="row justify-content-center" style="width: 240px;"">
				<div class="w-75 h-75">
					<img class="img-thumbnail" src="{{ asset('img/admin.png') }}">
					<h4 class="text-center">{{ (Auth::user()->nama_petugas) }}</h4>
				</div>
				<span>Tekan <kbd>ESC</kbd> untuk tutup</span>
			</div>
		</div>		
		<ul class="list-group list-group-flush">
			@if(Auth::user()->level_id == 1)
			<a class="list-group-item {{Request::is('admin')?'active':''}}" href="/admin">Dashboard</a>

			<li class="list-group-item text-center p-2"><strong>Inventarisir</strong></li>
			<a class="list-group-item {{Request::is('admin/dataInventaris')?'active':''}}" href="/admin/dataInventaris">Inventarisir</a>

			<li class="list-group-item text-center p-2"><strong>Menu Data</strong></li>
			<a class="list-group-item {{Request::is('admin/dataPetugas')?'active':''}}" href="/admin/dataPetugas">Data Petugas</a>
			<a class="list-group-item {{Request::is('admin/dataPegawai')?'active':''}}" href="/admin/dataPegawai">Data Pegawai</a></li>
			{{-- <a class="list-group-item" href="#">Data Level</a></li> --}}
			<a class="list-group-item {{Request::is('admin/dataRuang')?'active':''}}" href="/admin/dataRuang">Data Ruang</a></li>
			<a class="list-group-item {{Request::is('admin/dataJenis')?'active':''}}" href="/admin/dataJenis">Data Jenis</a></li>

			<li class="list-group-item text-center p-2"><strong>Menu Transaksi</strong></li>
			<a class="list-group-item {{Request::is('admin/trans_peminjaman')?'active':''}}" href="/admin/trans_peminjaman">Transaksi Peminjaman</a></li>
			<a class="list-group-item {{Request::is('admin/trans_pengembalian')?'active':''}}" href="/admin/trans_pengembalian">Transaksi Pengembalian</a></li>

			<li class="list-group-item text-center p-2"><strong>Menu Laporan</strong></li>
			<a class="list-group-item {{Request::is('admin/laporan_peminjaman')?'active':''}}" href="/admin/laporan_peminjaman">Laporan Peminjaman</a></li>
			<a class="list-group-item {{Request::is('admin/laporan_pengembalian')?'active':''}}" href="/admin/laporan_pengembalian">Laporan Pengembalian</a></li>

			@elseif(Auth::user()->level_id == 2)
			<li class="list-group-item text-center p-2"><strong>Menu Transaksi</strong></li>
			<a class="list-group-item {{Request::is('operator')?'active':''}}" href="/operator">Transaksi Peminjaman</a>
			<a class="list-group-item {{Request::is('operator/trans_pengembalian')?'active':''}}" href="/operator/trans_pengembalian">Transaksi Pengembalian</a></li>

			@else
			<li class="list-group-item text-center p-2"><strong>Menu Transaksi</strong></li>
			<a class="list-group-item {{Request::is('peminjam')?'active':''}}" href="/peminjam">Transaksi Peminjam</a>
			@endif
		</ul>
	</div>
	@endif

	


	<main class="py-4">
		@yield('content')
	</main>

	<script>
		$('#slider').slideReveal({
			trigger : $('#trigger'),
			push: false,
			overlay: true
		});
	</script>
</body>
</html>