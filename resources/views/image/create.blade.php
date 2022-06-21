@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">subir nueva imagen</div>
            
                <div class="card-body">
                    <form method="post" action="{{ route('image.save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class=" form-group row">
                            <div class="mb-3 row">    
                                <label for="image_path" class="col-md-3 form-label text-md-right">imagen</label>
                                    <div class="col-md-6">
                                     <input id="image_path" type="file" name="image_path" class="form-control" required autocomplete="image_path" autofocus>
                                        @if($errors->has('image_path'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$errors->first('image_path')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                        </div>
                        <div class=" form-group row">    
                            <div class="mb-3 row">
                                 <label for="description" class="col-md-3 form-label text-md-right">descripcion</label>
                                 <div class="col-md-6">
                                     <textarea id="description" name="description" class="form-control" rows="3" required autocomplete="description" autofocus></textarea>
                                         @if($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                        </div>

                        <div class="from-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-primary btn-sm" value="publicar">
                            </div>             
                        </div>    

                        

                    </from>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection