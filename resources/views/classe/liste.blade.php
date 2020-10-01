@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Liste Des Classes</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/classe">Classe</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Liste</li>
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
    <ul class="list-group">
        @if(count($classes) > 0)
        @foreach($classes as $classe)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{$classe->nom}}
            <div class="dropdown">
                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-h"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('classe.show',$classe->id)}}"><i class="fa fa-eye"></i> Liste Etudiants</a>
                    <a class="dropdown-item" href="{{ route('classe.edit',$classe->id)}}"><i class="fa fa-pencil"></i> Modifier</a>
                    <form action="{{ route('classe.destroy', $classe->id)}}" id="form" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button class="dropdown-item" id="del">
                        <i class="fa fa-trash"></i> Supprimer
                    </button>
                    {{-- <a class="dropdown-item" id="delete" href="{{ route('classe.destroy', $classe->id)}}">
                        <i class="fa fa-trash"></i> Supprimer</a> --}}
                </div>
            </div>
        </li>
        @endforeach
        @endif
    </ul>
</div>
@section('script')
<!-- add sweet alert js & css in footer -->
<script src="{{asset('src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/sweetalert2/sweetalert2.css')}}">
{{-- <script src="{{asset('src/plugins/sweetalert2/sweet-alert.init.js')}}"></script> --}}
<script>
    $('button#del').on('click', function(){
        swal({
        title: 'Vous êtes sûr ?',
        text: "Classe sera supprimé d'une façon permanente !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Supprimer'
        }).then((result) => {
            if (result.value) {
                $("#form").submit();
            }
        });
    });
</script>
@endsection
@endsection
