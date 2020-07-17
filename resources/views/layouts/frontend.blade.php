<!DOCTYPE html>
<html lang="en">
	
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>News Feed | Check what your friends are doing</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="{{ asset('app/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('app/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/css/font-awesome.min.css') }}" />
    <link href="{{ asset('app/css/emoji.css') }}" rel="stylesheet">
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('app/images/fav.png') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" />
    
    </head>
  
  <body>

  <div id="app">
  <init></init>

    <!-- Header
    ================================================= -->
	@include('includes.header')
    <!--Header End-->

    @yield('content')

    <!-- Footer
    ================================================= -->
    @include('includes.footer')
  </div>  
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>
    <!--Buy button-->
    <a href="https://themeforest.net/cart/add_items?item_ids=18711273&amp;ref=thunder-team" target="_blank" class="btn btn-buy"><span class="italy">Buy with:</span><img src="images/envato_logo.png" alt="" /><span class="price">Only $20!</span></a>
    
    <!-- Scripts
    ================================================= -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&amp;callback=initMap"></script>
    <script src="{{ asset('app/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('app/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app/js/jquery.sticky-kit.min.js') }}"></script>
    <script src="{{ asset('app/js/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('app/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>        
        @if(Session::has('success')) new Noty({ 
                type:'success', 
                layout:'bottomLeft', 
                text: '{{ Session::get('success') }}', 
                timeout: 3000
            }).show(); 
        @endif
    </script>

    <script type="text/javascript">
        +function ($) {
          'use strict';

          // DROPDOWN CLASS DEFINITION
          // =========================

          var backdrop = '.dropdown-backdrop'
          var toggle   = '[data-toggle="dropdown"]'
          var Dropdown = function (element) {
            $(element).on('click.bs.dropdown', this.toggle)
          }

          Dropdown.VERSION = '3.4.1'

          function getParent($this) {
            var selector = $this.attr('data-target')

            if (!selector) {
              selector = $this.attr('href')
              selector = selector && /#[A-Za-z]/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
            }

            var $parent = selector !== '#' ? $(document).find(selector) : null

            return $parent && $parent.length ? $parent : $this.parent()
          }

          function clearMenus(e) {
            if (e && e.which === 3) return
            $(backdrop).remove()
            $(toggle).each(function () {
              var $this         = $(this)
              var $parent       = getParent($this)
              var relatedTarget = { relatedTarget: this }

              if (!$parent.hasClass('open')) return

              if (e && e.type == 'click' && /input|textarea/i.test(e.target.tagName) && $.contains($parent[0], e.target)) return

              $parent.trigger(e = $.Event('hide.bs.dropdown', relatedTarget))

              if (e.isDefaultPrevented()) return

              $this.attr('aria-expanded', 'false')
              $parent.removeClass('open').trigger($.Event('hidden.bs.dropdown', relatedTarget))
            })
          }

          Dropdown.prototype.toggle = function (e) {
            var $this = $(this)

            if ($this.is('.disabled, :disabled')) return

            var $parent  = getParent($this)
            var isActive = $parent.hasClass('open')

            clearMenus()

            if (!isActive) {
              if ('ontouchstart' in document.documentElement && !$parent.closest('.navbar-nav').length) {
                // if mobile we use a backdrop because click events don't delegate
                $(document.createElement('div'))
                  .addClass('dropdown-backdrop')
                  .insertAfter($(this))
                  .on('click', clearMenus)
              }

              var relatedTarget = { relatedTarget: this }
              $parent.trigger(e = $.Event('show.bs.dropdown', relatedTarget))

              if (e.isDefaultPrevented()) return

              $this
                .trigger('focus')
                .attr('aria-expanded', 'true')

              $parent
                .toggleClass('open')
                .trigger($.Event('shown.bs.dropdown', relatedTarget))
            }

            return false
          }

          Dropdown.prototype.keydown = function (e) {
            if (!/(38|40|27|32)/.test(e.which) || /input|textarea/i.test(e.target.tagName)) return

            var $this = $(this)

            e.preventDefault()
            e.stopPropagation()

            if ($this.is('.disabled, :disabled')) return

            var $parent  = getParent($this)
            var isActive = $parent.hasClass('open')

            if (!isActive && e.which != 27 || isActive && e.which == 27) {
              if (e.which == 27) $parent.find(toggle).trigger('focus')
              return $this.trigger('click')
            }

            var desc = ' li:not(.disabled):visible a'
            var $items = $parent.find('.dropdown-menu' + desc)

            if (!$items.length) return

            var index = $items.index(e.target)

            if (e.which == 38 && index > 0)                 index--         // up
            if (e.which == 40 && index < $items.length - 1) index++         // down
            if (!~index)                                    index = 0

            $items.eq(index).trigger('focus')
          }


          // DROPDOWN PLUGIN DEFINITION
          // ==========================

          function Plugin(option) {
            return this.each(function () {
              var $this = $(this)
              var data  = $this.data('bs.dropdown')

              if (!data) $this.data('bs.dropdown', (data = new Dropdown(this)))
              if (typeof option == 'string') data[option].call($this)
            })
          }

          var old = $.fn.dropdown

          $.fn.dropdown             = Plugin
          $.fn.dropdown.Constructor = Dropdown


          // DROPDOWN NO CONFLICT
          // ====================

          $.fn.dropdown.noConflict = function () {
            $.fn.dropdown = old
            return this
          }


          // APPLY TO STANDARD DROPDOWN ELEMENTS
          // ===================================

          $(document)
            .on('click.bs.dropdown.data-api', clearMenus)
            .on('click.bs.dropdown.data-api', '.dropdown form', function (e) { e.stopPropagation() })
            .on('click.bs.dropdown.data-api', toggle, Dropdown.prototype.toggle)
            .on('keydown.bs.dropdown.data-api', toggle, Dropdown.prototype.keydown)
            .on('keydown.bs.dropdown.data-api', '.dropdown-menu', Dropdown.prototype.keydown)

        }(jQuery);
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

    @yield('scripts')

  </body>

<!-- Mirrored from mythemestore.com/friend-finder/newsfeed.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 May 2020 13:11:43 GMT -->
</html>
