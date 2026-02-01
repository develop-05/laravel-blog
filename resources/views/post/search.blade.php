@extends('layouts.default')

@section('title', 'Markmedia :: Search')
@section('meta_desc', 'Markmedia search page')


@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">

            @forelse ($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">
                            <img src="{{ $post->getPostThumb() }}" max alt="{{ $post->title }}" class="img-fluid">
                            <div class="hovereffect">
                                <span></span>
                            </div>
                            <!-- end hover -->
                        </a>
                    </div>
                    <!-- end media -->
                    <div class="blog-meta big-meta text-center">
                        <div class="post-sharing">
                        </div><!-- end post-sharing -->
                        <h4><a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                                title="">{{ $post->title }}</h4>
                        <p>{{ $post->excerpt }}</p>
                        <small><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                                title="">{{ $post->category->title }}</a></small>
                        <small><span>{{ $post->getPostDate() }}</span></small>
                        <small><span><i class="fa fa-eye"></i> {{ $post->views }}</span></small>
                    </div><!-- end meta -->
                </div>

                @empty
                    <p>No posts found...</p>
                @endforelse

            </div>
        </div>

        <hr class="invis">

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="Page navigation">
                    {{ $posts->links('vendor.pagination.bootstrap-5-front') }}

                </nav>
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
