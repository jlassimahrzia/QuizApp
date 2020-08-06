@extends('layouts.app')
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Matière</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Ajouter</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Matière</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue">Entrer un matière </h4>
                <p class="mb-30 font-14"></p>
            </div>
            <div class="pull-right">
                <a href="#basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                    data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>
            </div>
        </div>
        <form>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Nom de matière</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" placeholder="S'il vous plais entrer un matière">

                </div>
            </div>

            <button type="button" class="btn btn-info" style="margin-left:80%;"><i class="icon-copy fa fa-plus-square"
                    aria-hidden="true"></i>&nbsp;Ajouter</button>

        </form>






        <div class="collapse collapse-box" id="basic-form1">
            <div class="code-box">
                <div class="clearfix">
                    <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
                        data-clipboard-target="#copy-pre"><i class="fa fa-clipboard"></i> Copy Code</a>
                    <a href="#basic-form1" class="btn btn-primary btn-sm pull-right" rel="content-y"
                        data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
                </div>
                <pre><code class="xml copy-pre" id="copy-pre">
                            <form>
						       <div class="form-group row">
							      <label class="col-sm-12 col-md-2 col-form-label">Nom de matière</label>
							      <div class="col-sm-12 col-md-10">
								     <input class="form-control" type="text" placeholder="S'il vous plais entrer un matière" placeholder>

							        </div>
						        </div>

					          <button type="button" class="btn btn-info" style="margin-left:80%;"><i class="icon-copy fa fa-plus-square" aria-hidden="true"></i>&nbsp;Ajouter</button>

                             </form>
                            </code></pre>

            </div>
        </div>
    </div>
</div>
@endsection
