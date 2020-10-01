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
                <h2><b>Liste des Niveaux</b></h2>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/choisir_matiere">Niveau</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Consulter</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div>
                <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                    href="/choisir_matiere">
                    <i class="icon-copy fa fa-angle-double-left" aria-hidden="true"></i>
                    Retour</a>
            </div>
        </div>
    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">
        <div class="pull-left">
            @if(count($niveaux) > 0)
            <h4>Matière : <span class="text-blue">{{ $niveaux[0]->matiere->nom }}</span> </h4>
            @endif
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <div class="row">
        <table class="stripe hover multiple-select-row data-table-export nowrap">
            <thead>
                <tr>
                    <th>Niveau</th>
                    <th class="datatable-nosort">Liste QCMs</th>
                    <th class="datatable-nosort">Mettre à jour</th>
                    <th class="datatable-nosort">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @if(count($niveaux) > 0)
                @foreach($niveaux as $niveau)
                <tr>
                    <td>{{ $niveau->nom }}</td>
                    <td>
                        <a class="btn btn-outline-primary dropdown-toggle" role="button" data-toggle="dropdown">
                            Liste QCMs
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach($niveau->qcms as $qcm)
                            <a class="dropdown-item" href="{{route('qcm.show',$qcm->id)}}" data-toggle="tooltip" title="Voir QCMs">
                                {{ $qcm->nom }}
                            </a>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                            href="{{ route('niveau.edit',$niveau->id)}}">
                            <i class="icon-copy fi-page-edit"></i> Mettre A jour</a>
                    </td>
                    <td>
                        <form action="{{ route('niveau.destroy', $niveau->id)}}" id="myform" method="post">
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
            text: "Niveau sera supprimé ainsi que tous les QCMs qu'il appartient d'une façon permanente !",
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
