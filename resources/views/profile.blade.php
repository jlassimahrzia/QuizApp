@extends('layouts.app')
@section('head')
<link rel="stylesheet" type="text/css" href="src/plugins/cropperjs/dist/cropper.css">
<style>
    .details-left {
        margin-top: 20px;
        margin-left: 50px;
    }

    .details-left li {
        font-weight: bold;
    }

    .details-left li {
        font-weight: bold;
    }

    ul {
        list-style: none;
    }

    .detail-right {
        margin-left: 300px;
        margin-top: -122px;
    }

    ul li:nth-child(4) {
        color: #C62828;
        font-weight: bold;
    }

    ul li:nth-child(3) {
        color: #C62828;
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
                <br>
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
<div class="row">
    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow">
            <div class="profile-photo">
                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar">
                    <i class="icon-copy fi-zoom-in"></i></a>
                <img src="/storage/image/{{Auth::user()->photo}}" alt="" class="avatar-photo">
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body pd-5">
                                <div class="img-container">
                                    <img id="image" src="/storage/image/{{Auth::user()->photo}}" alt="Picture">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="text-center">{{Auth::user()->nom}} {{Auth::user()->prenom}}</h5>
            <p class="text-center text-muted">
                @if(Auth::user()->role === '1')
                Administrateur
                @elseif(Auth::user()->role === '2')
                Enseignant
                @endif
            </p>
            <div class="profile-info">
                <h5 class="mb-20 weight-500">Informations</h5>
                <ul>
                    <li>
                        <span>Adresse Email:</span>
                        {{Auth::user()->email}}
                    </li>
                </ul>
                <br><br><br><br><br><br>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="bg-white border-radius-4 box-shadow height-100-p">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Modification </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Timeline Tab start -->
                        <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                            <div class="profile-setting">
                                <form method="post" action="{{ route('update_profile', Auth::user()->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="classe" value="{{Auth::user()->classe_id}}">
                                    <ul class="profile-edit-list row">
                                        <li class="weight-500 col-md-6">
                                            <h4 class="text-blue mb-20">Modifier votre information </h4>
                                            <div class="form-group">
                                                <label>Nom de la famille</label>
                                                <input class="form-control form-control-lg" @error('nom') is-invalid
                                                    @enderror placeholder="Entrer votre nom de famille" type="text"
                                                    name="nom" value="{{Auth::user()->nom}}">
                                                @error('nom')
                                                <div class="form-control-feedback has-danger">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Prenom</label>
                                                <input class="form-control form-control-lg" @error('prenom') is-invalid
                                                    @enderror placeholder="Entrer votre nom de famille" type="text"
                                                    name="prenom" value="{{Auth::user()->prenom}}">
                                                @error('prenom')
                                                <div class="form-control-feedback has-danger">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Photo</label>
                                                <input
                                                    class="form-control-file form-control form-control-lg @error('image') is-invalid @enderror"
                                                    value="" name="image" type="file">
                                                @error('image')
                                                <div class="form-control-feedback has-danger">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" class="btn btn-primary"
                                                    value="Enregistrer & modifier">
                                            </div>
                                        </li>
                                        <li class="weight-500 col-md-6">
                                            <h4 class="text-blue mb-20">Modifier votre login</h4>
                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input class="form-control form-control-lg" @error('email') is-invalid
                                                    @enderror placeholder="nom@example.com" type="email" name="email"
                                                    value="{{ Auth::user()->email }}">
                                                @error('email')
                                                <div class="form-control-feedback has-danger">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Mot de passe Courant:</label>
                                                <input class="form-control form-control-lg" @error('password')
                                                    is-invalid @enderror type="password"
                                                    placeholder="Donner le mot de passe courant pour avoir modifier le mot de passe"
                                                    name="old_password" value="{{ old('old_password') }}">
                                                @if (session('error'))
                                                <div class="form-control-feedback col-sm-12 col-md-10 has-danger"
                                                    style="padding-left: 18%">
                                                    {{ session('error') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Nouveau Mot de passe:</label>
                                                <input class="form-control form-control-lg" @error('password')
                                                    is-invalid @enderror type="password"
                                                    placeholder="Nouveau Mot de passe" name="new_password"
                                                    value="{{ old('new_password') }}">
                                                @error('password')
                                                <div class="form-control-feedback col-sm-12 col-md-10 has-danger"
                                                    style="padding-left: 18%">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>

                        </div>
                        <!-- Setting Tab End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')


<script src="src/plugins/cropperjs/dist/cropper.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
</script>
@endsection
@endsection
