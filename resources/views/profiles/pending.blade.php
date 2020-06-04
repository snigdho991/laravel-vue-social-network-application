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
              <h4 class="grey">Friend Requests ({{ $users->count() }})</h4>
              @if($users->count() > 0)
                @foreach($requests as $request)
                
                      <div class="feed-item">
                        <div class="live-activity">                   
                          <img src="{{ Storage::url($request->avatar) }}" alt="Image" class="profile-photo-md pull-left" style="margin-right: 10px;border: 1px solid #ddd;" />
                          <p><a href="{{ route('timeline', ['slug' => str_slug($request->firstname .'-'. $request->lastname) ]) }}" class="profile-link">{{ $request->firstname .' '. $request->lastname }}</a> <b>&rArr;</b> {{ \App\Friendship::where('requester', $request->id)->where('user_requested', Auth::id())->first()->created_at->diffForHumans() }}</p>
                          <friend :get_user_id="{{ $request->id }}"></friend>
                          <p class="text-muted"></p>
                          
                        </div>

                      </div>
                
                @endforeach
                         
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