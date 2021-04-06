<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="logo" onclick="location.href='../'" style="cursor:pointer"><img src="assets/img/logo.png"></div>
           <a class="btn btn-navbar visible-phone" data-toggle="collapse" data-target=".nav-collapse">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </a>
           <a class="btn btn-navbar slide_menu_left visible-tablet">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
            </a>

          <div class="top-menu visible-desktop">
            <!--
                <ul class="pull-left">
            </ul>
            -->
            <ul class="pull-right">  
              <li><a id="messages" data-notification="168" href="#"><i class="icon-envelope"></i></a></li>
              <li><a id="notifications" data-notification="3" href="#"><i class="icon-globe"></i></a></li>
              <li onclick="logoff();"><a href="#"><i class="icon-off"></i> Logout</a></li>
            </ul>
          </div>

          <div class="top-menu visible-phone visible-tablet">
            <ul class="pull-right">  
              <li><a title="link to View all Messages page, no popover in phone view or tablet" href="#"><i class="icon-envelope"></i></a></li>
              <li><a title="link to View all Notifications page, no popover in phone view or tablet" href="#"><i class="icon-globe"></i></a></li>
              <li><a href="?login"><i class="icon-off"></i></a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>