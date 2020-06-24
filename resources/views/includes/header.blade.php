<header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index-register.html"><img src="{{ asset('app/images/logo.png') }}" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- <ul class="nav navbar-nav navbar-right main-menu">
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Timeline <span><img src="{{ asset('app/images/down-arrow.png') }}" alt="" /></span></a>
                <ul class="dropdown-menu login">
                  @if(Auth::check())
                    <li><a href="{{ route('timeline', ['slug' => Auth::user()->slug ]) }}">Timeline</a></li>
                  @endif
                  <li><a href="timeline-about.html">Timeline About</a></li>
                  <li><a href="timeline-album.html">Timeline Album</a></li>
                  <li><a href="timeline-friends.html">Timeline Friends</a></li>
                  @if(Auth::check())
                    <li><a href="{{ route('timeline.basic', ['slug' => Auth::user()->slug ]) }}">Basic Info</a></li>
                  @endif
                  <li><a href="edit-profile-work-edu.html">Edit: Work</a></li>
                  <li><a href="edit-profile-interests.html">Edit: Interests</a></li>
                  <li><a href="edit-profile-settings.html">Account Settings</a></li>
                  <li><a href="edit-profile-password.html">Change Password</a></li>
                </ul>
              </li> -->
              
          @if(Auth::check())

              <notification :id="{{ Auth::id() }}" :unreads="{{ auth()->user()->unreadNotifications }}" :unseen="{{ \App\Friendship::where('user_requested', Auth::id())->where('status', 0)->get() }}" :unreadfri="{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\NewFriendRequest') }}"></notification>
              
                <audio id="noty_audio">
                    <source src="{{ asset('audio/notify.mp3') }}">
                    <source src="{{ asset('audio/notify.oog') }}">
                    <source src="{{ asset('audio/notify.wav') }}">
                </audio>              
          
          @endif 
              <!-- <li class="dropdown"><a href="contact.html">Contact</a></li>
              <li class="dropdown"><a href="{{ url('/logout') }}">Logout ({{Auth::user()->firstname}})</a></li>
                          </ul> -->
            <form class="navbar-form navbar-right hidden-sm">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="Search friends, photos, videos">
              </div>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>