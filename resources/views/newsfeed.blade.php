@extends('layouts.frontend')

@section('content')

    <div id="page-contents">
      <div class="container">
        <div class="row">

          <!-- Newsfeed Common Side Bar Left
          ================================================= -->
          @include('includes.left-sidebar')
          <div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->
            <post :user="{{ Auth::user() }}"></post>
            
            <audio id="noty_audio">
                <source src="{{ asset('audio/notify.mp3') }}">
                <source src="{{ asset('audio/notify.oog') }}">
                <source src="{{ asset('audio/notify.wav') }}">
            </audio>
            <!-- Post Create Box End-->
            
            <feed></feed>
            
          </div>

          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
          @include('includes.right-sidebar')
        </div>
      </div>
    </div>

@endsection