<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-sm-4 footer-contact">
                    <h3>ArkManager.app</h3>
                    <p>
                        <strong>Discord:</strong> <a href="https://discord.gg/HGUaYb8v">https://discord.gg/HGUaYb8v</a><br>
                        <strong>Email:</strong> <a href="mailto:arkmanagerofficial@gmail.com">arkmanagerofficial@gmail.com</a><br>
                    </p>
                </div>

                <div class="col-sm-4 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('terms') }}">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('privacy') }}">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-sm-4 text-center">
                    <p>Data Secured Via <a href="https://letsencrypt.org/repository/">SSL Encryption</a></p>
                    <img src="/images/app/data-security.png" class="w-25" alt="Secure Data Via SSL Encryption">
                    <a href="https://stripe.com/about"><img src="/images/app/secure-payments.png" class="w-50" alt="Secure Payments By Stripe"></a>

                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="mr-md-auto text-center text-md-left">
            <div class="copyright">
                &copy; {{ \Carbon\Carbon::now()->year }} Copyright <strong><span>ArkManager.app</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="https://twitter.com/arkmanager" class="twitter"><i class="fab fa-twitter"></i></a>
            <a href="https://www.youtube.com/channel/UCs32-MrxbxAaSYJlqfqBD_Q" class="youtube"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->
