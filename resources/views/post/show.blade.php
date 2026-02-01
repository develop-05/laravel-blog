@extends('layouts.default')

@section('title', "Markedia :: {$post->title}")
@section('meta_desc', $post->meta_desc)

@push('scripts')
<script src="{{asset('assets/iziModal/js/iziModal.min.js')}}"></script>
@endpush

@push('styles') 
    <link rel="stylesheet" href="{{asset('assets/iziModal/css/iziModal.min.css')}}">
@endpush


@section('content')

    <div class="page-wrapper">
        <div class="blog-title-area">
            <ol class="breadcrumb hidden-xs-down">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('categories.single', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $post->title }}</li>
            </ol>

            <span class="color-yellow"><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                    title="">{{ $post->category->title }}</a></span>

            <h3>{{ $post->title }}</h3>

            <div class="blog-meta big-meta">
                <small>{{ $post->getPostDate() }}</small>
                <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
            </div><!-- end meta -->

            <div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span
                                class="down-mobile">Share on Facebook</span></a></li>
                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span
                                class="down-mobile">Tweet on Twitter</span></a></li>
                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div><!-- end post-sharing -->
        </div><!-- end title -->

        <div class="single-post-media">
            <img src="{{ $post->getPostThumb() }}" alt="" class="img-fluid">
        </div><!-- end media -->

        <div class="blog-content">
            <div class="pp">
                {!! $post->content !!}
            </div><!-- end pp -->
        </div><!-- end content -->

        <div class="blog-title-area">
            @if (!$post->tags->isEmpty())
                <div class="tag-cloud-single">
                    <span>Tags</span>
                    @foreach ($post->tags as $tag)
                        <small><a href="{{route('tags.single', ['slug' => $tag->slug])}}" title="">{{ $tag->title }}</a></small>
                    @endforeach
                </div><!-- end meta -->
            @endif

            <div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span
                                class="down-mobile">Share on Facebook</span></a></li>
                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span
                                class="down-mobile">Tweet on Twitter</span></a></li>
                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div><!-- end post-sharing -->
        </div><!-- end title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="banner-spot clearfix">
                    <div class="banner-img">
                        <img src="{{ asset('assets/front/upload/banner_01.jpg') }}" alt="" class="img-fluid">
                    </div><!-- end banner-img -->
                </div><!-- end banner -->
            </div><!-- end col -->
        </div><!-- end row -->

        <hr class="invis1">

        <div class="custombox authorbox clearfix">
            <h4 class="small-title">About author</h4>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <img src="upload/author.jpg" alt="" class="img-fluid rounded-circle">
                </div><!-- end col -->

                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <h4><a href="#">Jessica</a></h4>
                    <p>Quisque sed tristique felis. Lorem <a href="#">visit my website</a> amet, consectetur
                        adipiscing
                        elit. Phasellus quis mi auctor, tincidunt nisl eget, finibus odio. Duis tempus elit quis risus
                        congue feugiat. Thanks for stop Markedia!</p>

                    <div class="topsocial">
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i
                                class="fa fa-facebook"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i
                                class="fa fa-youtube"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i
                                class="fa fa-pinterest"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i
                                class="fa fa-twitter"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i
                                class="fa fa-instagram"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Website"><i
                                class="fa fa-link"></i></a>
                    </div><!-- end social -->

                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end author-box -->

        <hr class="invis1">

        @if (!$related_posts->isEmpty())
            <div class="custombox clearfix">
                <h4 class="small-title">You may also like</h4>
                <div class="row">
                    @foreach ($related_posts as $related_post)
                        <div class="col-lg-6">
                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="{{ route('posts.single', ['slug' => $related_post->slug]) }}"
                                        title="">
                                        {{-- <img src="{{ $related_post->getPostThumb() }}" alt="" class="img-fluid"> --}}
                                        <div class="hovereffect">
                                            <span class=""></span>
                                        </div><!-- end hover -->
                                    </a>
                                </div><!-- end media -->
                                <div class="blog-meta">
                                    <h4><a href="{{ route('posts.single', ['slug' => $related_post->slug]) }}"
                                            title="">{{ $related_post->title }}</a></h4>
                                    <small><a
                                            href="{{ route('categories.single', ['slug' => $related_post->category->slug]) }}"
                                            title="">{{ $related_post->category->title }}</a></small>
                                    {{-- <small>{{ $related_post->getPostDate() }}</small> --}}
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->
                        </div><!-- end col -->
                    @endforeach

                </div><!-- end row -->
            </div><!-- end custom-box -->
        @endif

        <hr class="invis1">

        <div class="custombox clearfix">
            <h4 class="small-title" id="comments">{{ $comments->total() }} Comments</h4>
            <div class="row">
                <div class="col-lg-12">
                    @if (!$comments->isEmpty())
                        <div class="comments-list">
                            @foreach ($comments as $comment)
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img src="{{ asset('assets/front/upload/author.jpg') }}" alt=""
                                            class="rounded-circle">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading user_name">{{ $comment->name }}
                                            <small>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->diffForHumans() }}</small>
                                        </h4>
                                        <p>{!! nl2br(e($comment->comment)) !!}</p>
                                        <a href="#" class="btn btn-primary btn-sm">Reply</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <nav aria-label="Page navigation">
                        {{ $comments->links('vendor.pagination.bootstrap-5-front') }}
                    </nav>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end custom-box -->

        <hr class="invis1">

        <div class="custombox clearfix">
            <h4 class="small-title">Leave a Reply</h4>
            <div class="row">
                <div class="col-lg-12">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-wrapper comment-form" method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <input name="name" type="text" class="form-control" placeholder="Your name">
                        <textarea name="comment" class="form-control" placeholder="Your comment"></textarea>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end page-wrapper -->

@endsection
