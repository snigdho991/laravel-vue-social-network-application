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
  
    
      <div id="page-contents">
        <div class="container">
          <div class="row">
            @include('includes.left-sidebar')

            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-7">
              <h4 class="grey">All Notifications ({{ Auth::user()->notifications->count() }})</h4>
        @if(Auth::user()->notifications->count() > 0)
          @foreach($nots as $not)
          
                <div class="feed-item">
                  <div class="live-activity">                   
                    <img src="{{ $not->notifiable_type::where('slug', str_slug($not->data['name']))->first()->avatar }}" alt="Image" class="profile-photo-md pull-left" style="margin-right: 10px;border: 1px solid #ddd;" />
                    <p><a href="{{ route('timeline', ['slug' => str_slug($not->data['name']) ]) }}" class="profile-link">{{ $not->data['name'] }}</a> {{ $not->data['message'] }}</p>
                    <p class="text-muted">{{ $not->created_at->diffForHumans() }}</p>
                  </div>
                </div>
          
          @endforeach
              <div class="text-center"> {{ $nots->links() }} </div>
        @else 

            <div class="feed-item">
              <div class="live-activity">
                <p>You don't have any notification to display.</p>
                
              </div>
            </div>

        @endif
            </div>

            @include('includes.right-sidebar')
          </div>
        </div>
      </div>

@endsection