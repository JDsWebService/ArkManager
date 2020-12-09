<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="adminSidebar">

            @include('components.sidebar.adminStaticLinks')

            @include('components.sidebar.adminChangelog')

            @include('components.sidebar.adminDocumentation')

        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->
