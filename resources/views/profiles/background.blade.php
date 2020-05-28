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

              <!-- Edit Work and Education
              ================================================= -->
          @if(Auth::check())
            @if(Auth::id() == $user->id)
              <div class="edit-profile-container">
                <form name="education" action="{{ route('timeline.background.update') }}" method="post" id="education" class="form-inline">
                  {{ csrf_field() }}
                  <div class="block-title">
                    <h4 class="grey"><i class="icon ion-ios-book-outline"></i>My education</h4>
                    <div class="line"></div>
                    
                  </div>
                  <div class="edit-block">
                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="university">My university</label>
                          <input id="university" class="form-control input-group-lg" type="text" name="university" title="Enter University" placeholder="My University" value="{{ $user->profile->university }}" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="subject">Subject</label>
                          <input id="subject" class="form-control input-group-lg" type="text" name="subject" title="Enter Subject" placeholder="My Subject" value="{{ $user->profile->subject }}" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-xs-6">
                          <label for="date-from">From</label>
                          <input id="date-from" class="form-control input-group-lg" type="text" name="uni_from" title="Enter a Date" placeholder="From" value="{{ $user->profile->uni_from }}" />
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="date-to" class="">To </label> <b>-</b> Type <b>present</b> if you are in it now.
                          <input id="date-to" class="form-control input-group-lg" type="text" name="uni_to" title="Enter a Date" placeholder="To" value="{{ $user->profile->uni_to }}" />
                        </div>
                      </div>
                      
                  </div>
                  <div class="block-title">
                    <h4 class="grey"><i class="icon ion-ios-briefcase-outline"></i>Work Experiences</h4>
                    <div class="line"></div>
                    
                  </div>
                  <div class="edit-block">
                    
                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="company">Company</label>
                          <input id="company" class="form-control input-group-lg" type="text" name="company" title="Enter Company" placeholder="Company name" value="{{ $user->profile->company }}" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="designation">Designation</label>
                          <input id="designation" class="form-control input-group-lg" type="text" name="designation" title="Enter designation" placeholder="Designation Title" value="{{ $user->profile->designation }}" />
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="form-group col-xs-6">
                          <label for="from-date">From</label>
                          <input id="from-date" class="form-control input-group-lg" type="text" name="from" title="Enter a Date" placeholder="from" value="{{ $user->profile->from }}" />
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="to-date" class="">To </label> <b>-</b> Type <b>present</b> if you are in it now.
                          <input id="to-date" class="form-control input-group-lg" type="text" name="to" title="Enter a Date" placeholder="to" value="{{ $user->profile->to }}" />
                        </div>
                      </div>
                      
                    </div>

                  <div class="block-title">
                    <h4 class="grey"><i class="icon ion-ios-location-outline"></i>Current Location</h4>
                    <div class="line"></div>
                    <div class="edit-block">
                    
                      <div class="row">
                        <div class="form-group col-xs-12{{ $errors->has('location') ? ' has-error' : '' }}">
                          <label for="location">Current Address</label> (required)
                          <input id="location" class="form-control input-group-lg" type="text" name="location" title="Enter Current Address" placeholder="Enter Current Address" value="{{ $user->profile->location }}" />
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="location">Google Maps</label>
                          <iframe width="600" height="300" frameborder="0" style="border:1px; border-radius: 4px;" src="https://www.google.com/maps/embed/v1/search?q=@if($user->profile->location === NULL) Dhaka @else {{ $user->profile->location }} @endif&key=AIzaSyAaq3FKOs2YlksAR3LzmBI5uwu89CK1BCI" allowfullscreen></iframe>
                        </div>
                      </div>
                      <button class="btn btn-primary">Save Changes</button>
                    
                    </div>
                    
                  </div>
                </form>
              </div>
            @else
              <div class="edit-profile-container">
                
                  <div class="block-title">
                    <h4 class="grey"><i class="icon ion-ios-book-outline"></i>{{ $user->firstname }}'s Education</h4>
                    <div class="line"></div>
                    
                  </div>
                  <div class="edit-block">
                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="university">University</label>
                          <input id="university" readonly="" class="form-control input-group-lg" type="text" name="university" placeholder="University" value="{{ $user->profile->university }}" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="subject">Subject</label>
                          <input id="subject" readonly="" class="form-control input-group-lg" type="text" name="subject" placeholder="Subject" value="{{ $user->profile->subject }}" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-xs-6">
                          <label for="date-from">From</label>
                          <input id="date-from" readonly="" class="form-control input-group-lg" type="text" name="uni_from" placeholder="From" value="{{ $user->profile->uni_from }}" />
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="date-to" class="">To </label>
                          <input id="date-to" readonly="" class="form-control input-group-lg" type="text" name="uni_to" placeholder="To" value="{{ $user->profile->uni_to }}" />
                        </div>
                      </div>
                      
                  </div>
                  <div class="block-title">
                    <h4 class="grey"><i class="icon ion-ios-briefcase-outline"></i>Work Experiences</h4>
                    <div class="line"></div>
                    
                  </div>
                  <div class="edit-block">
                    
                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="company">Company</label>
                          <input id="company" readonly="" class="form-control input-group-lg" type="text" name="company" placeholder="Company name" value="{{ $user->profile->company }}" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="designation">Designation</label>
                          <input id="designation" readonly="" class="form-control input-group-lg" type="text" name="designation" placeholder="Designation Title" value="{{ $user->profile->designation }}" />
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="form-group col-xs-6">
                          <label for="from-date">From</label>
                          <input id="from-date" readonly="" class="form-control input-group-lg" type="text" name="from" placeholder="from" value="{{ $user->profile->from }}" />
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="to-date" class="">To </label>
                          <input id="to-date" readonly="" class="form-control input-group-lg" type="text" name="to" placeholder="to" value="{{ $user->profile->to }}" />
                        </div>
                      </div>
                      
                    </div>

                  <div class="block-title">
                    <h4 class="grey"><i class="icon ion-ios-location-outline"></i>Current Location</h4>
                    <div class="line"></div>
                    <div class="edit-block">
                    
                      <div class="row">
                        <div class="form-group col-xs-12{{ $errors->has('location') ? ' has-error' : '' }}">
                          <label for="location">Current Address</label>
                          <input id="location" readonly="" class="form-control input-group-lg" type="text" name="location" placeholder="Current Address" value="{{ $user->profile->location }}" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-xs-12">
                          <label for="location">Google Maps</label>
                          <iframe width="600" height="300" frameborder="0" style="border:1px; border-radius: 4px;" src="https://www.google.com/maps/embed/v1/search?q=@if($user->profile->location === NULL) Dhaka @else {{ $user->profile->location }} @endif&key=AIzaSyAaq3FKOs2YlksAR3LzmBI5uwu89CK1BCI" allowfullscreen></iframe>
                        </div>
                      </div>
                      
                    </div>
                    
                  </div>
                
              </div>
            @endif
          @endif
            </div>
            <div class="col-md-2 static">
              
              <!--Sticky Timeline Activity Sidebar-->
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