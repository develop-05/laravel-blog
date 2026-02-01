@extends('layouts.default')

@section('title', "Markedia :: Contact")
@section('meta_desc', "Markedia contact page")

@section('content')

    <div class="page-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <h4>Who we are</h4>
                <p>Markedia is a personal blog for handcrafted, cameramade photography content, fashion styles from
                    independent creatives around the world.</p>
            </div>

            <div class="col-lg-6">
                <h4>How we help?</h4>
                <p>If you’d like to write for us, <a href="#">advertise with us</a> or just say hello, fill out the form
                    below and we’ll get back to you as soon as possible.</p>
            </div>
        </div><!-- end row -->

        <hr class="invis">

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

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="form-wrapper" method="post" action="{{ route('contact.send') }}">
                    <h4>Contact form</h4>
                    @csrf
                    <input name="name" type="text" class="form-control" placeholder="Your name">
                    <input name="email" type="text" class="form-control" placeholder="Email address">
                    <input name="phone" type="text" class="form-control" placeholder="Phone">
                    <input name="subject" type="text" class="form-control" placeholder="Subject">
                    <textarea name="message" class="form-control" placeholder="Your message"></textarea>
                    <button type="submit" class="btn btn-primary">Send <i class="fa fa-envelope-open-o"></i></button>
                </form>
            </div>
        </div>
    </div><!-- end page-wrapper -->

@endsection
