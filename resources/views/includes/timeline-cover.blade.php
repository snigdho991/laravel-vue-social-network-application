<style type="text/css">
    .timeline-cover {
      background-position: center !important;
      background-size: cover !important;
      min-height: 360px;
      border-radius: 0 0 4px 4px;
      position: relative;
  }
</style>

    <div class="timeline-cover" style="background: url({{ Storage::url($user->cover) }}) no-repeat;">

          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                  <img src="{{ Storage::url($user->avatar) }}" alt="Profile Picture" class="img-responsive profile-photo" />
                  <h3>{{ $user->firstname.' '.$user->lastname }}</h3>
                  <p class="text-muted"></p>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="timeline.html" class="active">Timeline</a></li>
                  <li><a href="timeline-about.html">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="timeline-friends.html">Friends</a></li>
                </ul>
                <ul class="follow-me list-inline">
                  <!-- <li>1,299 people following her</li> -->
                    @if(Auth::check())
                      @if(Auth::id() !== $user->id)
                        <li><div id="app"><friend :get_user_id="{{ $user->id }}"></friend></div></li>
                      @endif
                    @endif 
                </ul>
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
              <img src="{{ Storage::url($user->avatar) }}" alt="Profile Picture" class="img-responsive profile-photo" />
              <h4>{{ $user->firstname.' '.$user->lastname }}</h4>
              <p class="text-muted">Creative Director</p>
            </div>

            <div class="mobile-menu">
              <ul class="list-inline">
                <li><a href="timline.html" class="active">Timeline</a></li>
                <li><a href="timeline-about.html">About</a></li>
                <li><a href="timeline-album.html">Album</a></li>
                <li><a href="timeline-friends.html">Friends</a></li>
              </ul>

              @if(Auth::check())
                @if(Auth::id() !== $user->id)
                  <div id="app"><friend :get_user_id="{{ $user->id }}"></friend></div>
                @endif
              @endif
              
            </div>
          </div><!--Timeline Menu for Small Screens End-->

    </div>
