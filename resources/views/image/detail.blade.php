@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card pub-image pub_image_detail">
                <div class="card-header">
                    @if($image->user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" >
                        </div>
                    @endif
                    
                    <div class="data-user">
                        {{ $image->user->nick  }}
                    </div>
                </div>        
                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route('image.file',['filename' => $image->image_path]) }}">
                    </div>
                    
                       

                    <div class="description">
                        <span class="nickname"> {{ '@'.$image->user->nick }} {{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }} </span>
                        <p>{{ $image->description }}</p>
                    </div> 

                    <div class="likes">
                        <img src="{{asset('img/heart-black.png')}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="comment">
                        <h2>comentarios({{ count($image->comment) }})</h2> 
                        <hr>
                        @foreach($image->comment as $comment)
                            
                                <div class="description">
                                    <span class="nickname"> {{ '@'.$comment->user->nick }} </span>
                                    <p>{{ $comment->content }}</p>
                                    <span class="nickname date"> {{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }} </span><br>
                                    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                    <a href="{{ route('comment.delete',['id'=>$comment->id]) }}" class="btn btn-sm btn-danger">eliminar</a><br>
                                    @endif
                                </div>      
                                
                            
                        @endforeach
                        <br>
                        <form method="POST" action="{{ route('comment',['id'=> $image->id ]) }}">
                            @csrf
                            <input type="hidden" name = "image_id" value="{{ $image->id }}">
                            <p>
                            <textarea class="form-control" name="content" {{ $errors->has('content')? 'is_invalid' : '' }} placeholder=" add coments" required></textarea>
                            @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('content')}}</strong>
                                </span>
                            @endif
                            </p>

                            <button class="btn btn-success" type="submit">enviar</button>
                        </form>
                        
                        
                    </div> 
                </div>
                
            </div>
            
                       
            
    
        </div>
        
    </div>
</div>
@endsection
