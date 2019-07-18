@extends('layouts.home')
@section('title','Duyurular')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">

                            <ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
                                @foreach($categories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->first === true ? "active" : "" }}" data-toggle="tab" href="#{{$category->slug}}"
                                           role="tablist">
                                            <i class="{{$category->icon}}"></i> {{$category->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content">
                                @foreach($categories as $category )
                                    <div class="tab-pane {{ $loop->first === true ? "active" : "" }}" id="{{$category->slug}}">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">{{$category->title}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="accordion-{{$category->slug}}" role="tablist">
                                                    <div class="card-collapse">
                                                        @foreach($category->posts as $post)
                                                        <div class="card-header" role="tab" id="heading-{{$post->slug}}">
                                                            <h5 class="mb-0">
                                                                <a data-toggle="collapse" href="#{{$post->slug}}"
                                                                   aria-expanded="{{ $loop->first === true ? "true" : "false" }}" aria-controls="collapse-{{$post->slug}}"
                                                                   class="collapsed">
                                                                    {{$post->title}}
                                                                    <i class="{{$post->icon}}"></i>
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="{{$post->slug}}" class="collapse {{ $loop->first ===  true ? "show" : "" }}" role="tabpanel"
                                                             aria-labelledby="heading-{{$post->slug}}" data-parent="#accordion-{{$category->slug}}"
                                                             style="">
                                                            <div class="card-body">
                                                                {{$post->content}}
                                                            </div>
                                                        </div>
                                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
@endsection
