<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="userSidebar">

            @include('components.sidebar.userStaticLinks')

            @include('components.sidebar.tribe')

            @include('components.sidebar.dino')

            @include('components.sidebar.trade')

            {{--            @include('components.sidebar._deepmenu')--}}

        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->
