@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @foreach($images as $image)
            <div class="card pub-image">
                <div class="card-header">
                    @if($image->user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" >
                        </div>
                    @endif
                    
                    <div class="data-user">
                        <a href="{{route('image.detail',['id'=> $image->id])}}">
                        {{ $image->user->nick  }}
                    </div>
                </div>        
                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route('image.file',['filename' => $image->image_path]) }}">
                    </div>
                    
                       

                    <div class="description">
                        <span class="nickname"> {{ '@'.$image->user->nick }} </span>
                        <span class="nickname date"> {{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }} </span>
                        <p>{{ $image->description }}</p>
                    </div> 

                    <div class="likes">
                        <?php $user_like = false; ?>
                        @foreach($image->like as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                        @if($user_like)
                            <img src="{{asset('img/heart-red.png')}} " class="btn-dislike">
                        @else
                            <img src="{{asset('img/heart-black.png')}} " class="btn-like">
                        @endif
                        <span class="number_likes"> {{ count($image->like)}}</span>

                    </div>
                     
                    <div class="comment">
                        <h2 class="btn btn-sm btn-warning btn-coments">comentarios({{ count($image->comment) }})</h2>  
                    </div> 
                </div>
                
            </div>
            @endforeach
            <!-- PAGINACION -->
			<div class="clearfix"></div>
			{{$images->links()}}
           
            
    
        </div>
        
    </div>
</div>
@endsection
