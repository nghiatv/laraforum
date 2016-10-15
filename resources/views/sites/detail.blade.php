@extends('sites.layouts.app')
@section('title','Detail')

@section('main-content')
        <!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url( {{ url($data->banner) }} )">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1>{{ $data->title }}</h1>
                    <h2 class="subheading">{{ substr(strip_tags($data->body),0,100) }}</h2>
                    <span class="meta">Đăng bởi <a href="#">{{ $data->user->name }}</a> trong {{ $data->category->name }}  {{ $data->created_at }}</span>
                </div>
            </div>
        </div>
    </div>
</header>
        <!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                {!! $data->body !!}
            </div>
        </div>
    </div>
</article>

<hr>
@endsection