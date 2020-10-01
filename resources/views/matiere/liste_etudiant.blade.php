@extends('layouts.app')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/jquery.dataTables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/responsive.dataTables.css')}}">
<style>
    h1 {
        font-family: "Comic Sans MS", cursive, sans-serif;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Liste des etudiants de la classe {{$classe->nom}}</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/matiere">Matiére</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Classe</li>
                    <li class="breadcrumb-item active" aria-current="page">Liste Etudiants</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div>
                <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                onclick="javascript:history.go(-1)">
                    <i class="icon-copy fa fa-angle-double-left" aria-hidden="true"></i>
                    Retour</a>
            </div>
        </div>
    </div>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="row">
        <table class="stripe hover multiple-select-row data-table-export nowrap">
            <thead>
                <tr>
                    <th class="datatable-nosort">Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Classe</th>
                </tr>
            </thead>
            <tbody>
                @if(count($classe->etudiants) > 0)
                @foreach($classe->etudiants as $etudiant)
                <tr>
                    <td>
                        <div class="notification-list">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="/storage/image/{{$etudiant->photo}}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td class='table-plus'> {{ $etudiant->nom }} </td>
                    <td class='table-plus'> {{ $etudiant->prenom }} </td>
                    <td class='table-plus'> {{ $etudiant->email }} </td>
                    <td class='table-plus'> {{ $etudiant->classe->nom }} </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@section('script')
<script src="{{asset('src/plugins/highcharts-6.0.7/code/highcharts.js')}}"></script>
<script src="{{asset('src/plugins/highcharts-6.0.7/code/highcharts-more.js')}}"></script>


<script src="{{asset('src/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/dataTables.responsive.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/responsive.bootstrap4.js')}}"></script>
<!-- buttons for Export datatable -->
<script src="{{asset('src/plugins/datatables/media/js/button/dataTables.buttons.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/button/buttons.bootstrap4.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/button/buttons.print.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/button/buttons.html5.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/button/buttons.flash.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/button/pdfmake.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/media/js/button/vfs_fonts.js')}}"></script>
<script>
    $('document').ready(function(){
			$('.data-table').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
			});
			$('.data-table-export').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
				dom: 'Bfrtip',
				buttons: [
				'copy', 'csv', 'pdf', 'print'
				]
			});
			var table = $('.select-row').DataTable();
			$('.select-row tbody').on('click', 'tr', function () {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				}
				else {
					table.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
			});
			var multipletable = $('.multiple-select-row').DataTable();
			$('.multiple-select-row tbody').on('click', 'tr', function () {
				$(this).toggleClass('selected');
			});
		});
</script>
@endsection
@endsection
