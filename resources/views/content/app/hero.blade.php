<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <h3>Welcome to <strong>ArkManager</strong></h3>
        <h1>An Ark Management Tool</h1>
        <h2>We make keeping track of anything Ark: Survival Evolved related easy!</h2>
        @guest
            <a href="{{ route('login.discord') }}" class="btn-get-started scrollto">Login To Get Started</a>
        @endguest
        @auth
            <a href="{{ route('user.dashboard') }}" class="btn-get-started scrollto">Go To Your Dashboard</a>
        @endauth
    </div>
</section>
<!-- End Hero -->
