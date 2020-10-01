@extends('layouts.app')
@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>QCM</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">QCM</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Afficher</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue">Qcm</h4>
            <p class="mb-30 font-14"></p>
        </div>
    </div>
        <div class="form-group">
            <label>Choisissez une Matière</label>
            <select class="custom-select2 form-control" name="matiere" id="matiere" style="width: 100%; height: 38px;">
                <option value="null" selected>Sélectionnez matière</option>
                @if(count($matieres) > 0)
                @foreach($matieres as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label>Choisissez Le Niveau</label>
            <select class="custom-select2 form-control" name="niveau" id="niveau" style="width: 100%; height: 38px;">
                <option value="null" selected>Sélectionnez Niveau</option>
            </select>
        </div>
</div>
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#niveau').bind("change",function()
    {
        window.location = '/afficher_qcm/'+$(this).val();
    });
    $(document).ready(function () {

        $('#matiere').on('change',function(e) {

         var matiere_id = e.target.value;

         $.ajax({

               url:"{{ route('matiere_niveau') }}",
               type:"POST",
               data: {
                matiere_id: matiere_id
               },

               success:function (data) {

                //$('#niveau').empty();


                $.each(data.matiere[0].niveaux,function(index,niveau){

                    $('#niveau').append('<option value="'+niveau.id+'">'+niveau.nom+'</option>');
                });

               }
           });
        });

    });
</script>
@endsection
@endsection
