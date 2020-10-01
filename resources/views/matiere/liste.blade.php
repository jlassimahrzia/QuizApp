@extends('layouts.app')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/jquery.dataTables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/responsive.dataTables.css')}}">
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h2><b>Liste des matiéres</b></h2>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/matiere">Matiére</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Consulter</li>
                </ol>
            </nav>
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
    <div class="clearfix">
        <div class="pull-left">
            <h4>Enseignant : <span class="text-blue">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span> </h4>
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <div class="row">
        <table class="stripe hover multiple-select-row data-table-export nowrap">
            <thead>
                <tr>
                    <th>Matiere</th>
                    <th>Classes</th>
                    <th class="datatable-nosort">Liste Niveaux</th>
                    <th class="datatable-nosort">Mettre à jour</th>
                    <th class="datatable-nosort">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @if(count($matieres) > 0)
                @foreach($matieres as $matiere)
                <tr>
                    <td>
                        {{ $matiere->nom }}
                    </td>
                    <td>
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown">
                            Liste Classes
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach($matiere->classes as $classe)
                            <a class="dropdown-item" href="/liste_etudiant/{{$classe->id}}" data-toggle="tooltip"
                                title="Voir Liste des étudiants">
                                {{ $classe->nom }}
                            </a>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown">
                            Liste Niveaux
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach($matiere->niveaux as $niveau)
                            <a class="dropdown-item" href="{{ route('niveau.show',$matiere->id)}}" data-toggle="tooltip"
                                title="Voir QCMs">
                                {{ $niveau->nom }}
                            </a>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                            href="{{ route('matiere.edit',$matiere->id)}}">
                            <i class="icon-copy fi-page-edit"></i> Mettre A jour</a>
                    </td>
                    <td>
                        <form action="{{ route('matiere.destroy', $matiere->id)}}" id="myform" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn btn-danger" id="delete">
                            <i class="icon-copy fa fa-user-times" aria-hidden="true"></i> Supprimer
                        </button>
                    </td>
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
<script src="{{asset('src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/sweetalert2/sweetalert2.css')}}">
{{-- <script src="{{asset('src/plugins/sweetalert2/sweet-alert.init.js')}}"></script> --}}
<script>
    $('button#delete').on('click', function(){
            swal({
            title: 'Vous êtes sûr ?',
            text: "Matiére sera supprimé ainsi que tous les niveaux et les qcms qu\'il appartient!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Supprimer'
            }).then((result) => {
                if (result.value) {
                    $("#myform").submit();
                }
            });
        });
</script>
@endsection
@endsection
