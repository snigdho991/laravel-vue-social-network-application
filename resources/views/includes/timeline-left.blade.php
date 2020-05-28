	<div class="col-md-3">             
      <!--Edit Profile Menu-->
	    <ul class="edit-menu">
	      	<li class="@if (url()->current() == route('timeline.basic', ['slug' => $user->slug ])) active @endif"><i class="icon ion-ios-information-outline"></i><a href="{{ route('timeline.basic', ['slug' => $user->slug ]) }}">Basic Information</a></li>
	      	<li class="@if (url()->current() == route('timeline.background', ['slug' => $user->slug ])) active @endif"><i class="icon ion-ios-briefcase-outline"></i><a href="{{ route('timeline.background', ['slug' => $user->slug ]) }}">Education and Work</a></li>
	      	<li><i class="icon ion-ios-heart-outline"></i><a href="edit-profile-interests.html">My Interests</a></li>
	      	@if(Auth::check())
	      		@if(Auth::id() == $user->id)
			        <li><i class="icon ion-ios-settings"></i><a href="edit-profile-settings.html">Account Settings</a></li>
			      	<li><i class="icon ion-ios-locked-outline"></i><a href="edit-profile-password.html">Change Password</a></li>
		   		@endif
		    @endif
	    </ul>
    </div>