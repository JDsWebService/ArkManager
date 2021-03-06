<!-- ======= Beta Access Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <h3>Welcome to <strong>ArkManager</strong></h3>
        <h1>An Ark Management Tool</h1>
        <h2>We make keeping track of anything Ark: Survival Evolved related easy!</h2>
        @guest
            <a href="{{ route('login.discord') }}" class="btn-get-started">Login Sign Up For BETA Access</a>
        @endguest
        @auth
            <a href="https://discord.gg/qPgdqfFTgm" class="btn-get-started">BETA Access Approved! Come join our Discord! Click here!</a>
        @endauth
    </div>
</section>
<!-- End Hero -->
