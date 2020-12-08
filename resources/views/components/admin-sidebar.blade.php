<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="adminSidebar">

            @include('components.sidebar.adminDashboard')

            @include('components.sidebar.dashboard')

            @include('components.sidebar.adminChangelog')

        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->
