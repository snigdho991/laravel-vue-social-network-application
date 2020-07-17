<style type="text/css">
  .tab-content{
    width: 337.28px;
    height: 535px;
    padding: 10px;
    overflow: hidden;
    overflow-y: scroll;
    margin-top: -35px;
  }

  .contact-list{
    width: 235px;
    height: 500px;
    padding: 10px;
    overflow: hidden;
    overflow-y: scroll;
  }

  .chat-room ul.contact-list li {
    width: 106% !important;
    margin-bottom: 0;
  }

  .chat-room ul.contact-list li.selected {
    background: #edf2fa;
  }

  .nav-tabs {
    border-bottom: 0px !important;
  }

  .panel-default>.panel-heading::before{
    content: "" !important;    
  }

</style>

@extends('layouts.frontend')

@section('content')

    <div id="page-contents">
    	<div class="container">
    		<div class="row">

    			<!-- Newsfeed Common Side Bar Left
          ================================================= -->
    			@include('includes.left-sidebar')

    			<div class="col-md-7">
            <h4 class="grey text-center">Messenger</h4>
            <!-- Chat Room
            ================================================= -->
            <div class="chat-room">
              <div class="row">
                <chat :auth="{{ Auth::user() }}"></chat>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>

    			<!-- Newsfeed Common Side Bar Right
          ================================================= -->
    			@include('includes.right-sidebar')
    		</div>
    	</div>
    </div>

@endsection