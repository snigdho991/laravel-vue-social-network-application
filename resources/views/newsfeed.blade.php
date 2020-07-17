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
            <!-- Post Create Box End-->
            
            <!-- Notification Tone -->
            <audio id="noty_audio">
                <source src="{{ asset('audio/notify.mp3') }}">
                <source src="{{ asset('audio/notify.ogg') }}">
                <source src="{{ asset('audio/notify.wav') }}">
            </audio>

            <!-- Message Tone -->
            <audio id="message_audio">
                <source src="{{ asset('message/message_tone.mp3') }}">
                <source src="{{ asset('message/message_tone.ogg') }}">
                <source src="{{ asset('message/message_tone.wav') }}">
            </audio>
            
            <feed :auth="{{ Auth::user() }}"></feed>
            
          </div>

          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
          @include('includes.right-sidebar')
        </div>
      </div>
    </div>

@endsection