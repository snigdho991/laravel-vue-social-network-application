@extends('layouts.frontend')

@section('content')

<style type="text/css">
  .timeline-cover .timeline-nav-bar .profile-info img.profile-photo {
      height: 202px;
      width: 202px;
      border-radius: 50%;
      border: 10px solid #FFF;
  }

</style>

    <div class="container">

      <!-- Timeline
      ================================================= -->
      <div class="timeline">
        @include('includes.timeline-cover')
        <div id="page-contents">
          <div class="row">
            @include('includes.timeline-left')
            <div class="col-md-7">
              <div class="block-title">
                
                @if(Auth::id() === $user->id)
                    <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i> My Uploads - <span class="badge" style="margin-top: -6px;">{{ $result->count() }}</span></h4>
                @else
                    <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i> {{ $user->firstname }}'s Uploads - <span class="badge" style="margin-top: -6px;">{{ $result->count() }}</span></h4>
                @endif
                  
                  <div class="line"></div>
              </div>

              <!-- Photo Album
              ================================================= -->
              <images :user="{{ $user }}"></images>
            </div>
            <div class="col-md-2 static">
              <div id="sticky-sidebar">
                <h4 class="grey">Sarah's activity</h4>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Commended on a Photo</p>
                    <p class="text-muted">5 mins ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Has posted a photo</p>
                    <p class="text-muted">an hour ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Liked her friend's post</p>
                    <p class="text-muted">4 hours ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> has shared an album</p>
                    <p class="text-muted">a day ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection