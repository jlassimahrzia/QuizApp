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
                <h2><b>Liste du QCM</b></h2>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/choisir_matiere_niveau">QCM</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Consulter</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div>
                <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                onclick="javascript:history.go(-1)"
                    {{-- href="/choisir_matiere_niveau" --}}>
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
    <div class="clearfix">
        <div class="pull-left">
            @if(count($qcms) > 0)
            <h4>Matière : <span class="text-blue"> {{ $qcms[0]->niveau->matiere->nom}}</span> </h4>
            <h4>Niveau : <span class="text-blue"> {{ $qcms[0]->niveau->nom}}</span> </h4>
            @endif
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <div class="row">
        <table class="stripe hover multiple-select-row data-table-export nowrap">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Durée</th>
                    <th class="datatable-nosort">Voir Questions</th>
                    <th class="datatable-nosort">Ajouter Questions</th>
                    <th class="datatable-nosort">Modifier</th>
                    <th class="datatable-nosort">Supprimer</th>
                    <th class="datatable-nosort">Voir Resultat</th>
                </tr>
            </thead>
            <tbody>
                @if(count($qcms) > 0)
                @foreach($qcms as $qcm)
                <tr>
                    <td>
                        {{ $qcm->nom }}
                    </td>
                    <td>
                        {{ $qcm->duree }} mn
                    </td>
                    <td>
                        <a class="btn" data-bgcolor="#28a745" data-color="#ffffff"
                            href="{{ route('qcm.show',$qcm->id)}}">
                            <i class="icon-copy fa fa-external-link" aria-hidden="true"></i> Détailler</a>
                    </td>
                    <td>
                        <a class="btn btn-info"
                            href="{{ route('ajout_question',$qcm->id)}}">
                            <i class="icon-copy fa fa-plus-square" aria-hidden="true"></i> Ajouter Question </a>
                    </td>
                    <td>
                        <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                            href="{{ route('qcm.edit',$qcm->id)}}">
                            <i class="icon-copy fi-page-edit"></i> Modifier</a>
                    </td>
                    <td>
                        <form action="{{ route('qcm.destroy', $qcm->id)}}" id="myform" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn btn-danger" id="delete">
                            <i class="icon-copy fa fa-user-times" aria-hidden="true"></i> Supprimer
                        </button>
                    </td>
                    <td>
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown">
                            Liste Classes
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach($qcm->classes as $classe)
                            <a class="dropdown-item" href="/classe_resultat/{{$classe->id}}/{{$qcm->id}}" data-toggle="tooltip"
                                title="Voir Resultat">
                                {{ $classe->nom }}
                            </a>
                            @endforeach
                        </div>

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
                text: "QCM sera supprimé d'une façon permanente !",
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
