    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <h2 class="text-primary mb-4">SISTEM INFORMASI PERTANIAN DESA KALINGANYAR</h2>
                    <p class="text-primary text-justify">Sistem Informasi Pertanian Desa Kalinganyar adalah suatu platform yang
                        digunakan untuk
                        mengumpulkan, mengelola, dan menyebarkan
                        informasi terkait pertanian.</p>
                </div>
                <div class="col-lg-3 col-md-6 ms-auto">
                    <h4 class="text-primary mb-4">Contact Us</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>info@example.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="/">Home</a>
                    <a class="btn btn-link" href="/news">News</a>
                    <a class="btn btn-link" href="/about">About Us</a>
                    <a class="btn btn-link" href="/contact">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="fw-medium" href="#">Sistem Informasi Pertanian Desa Kalinganyar 2023</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a class="fw-medium" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="fw-medium" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        var botmanWidget = {
            title: 'Helpdesk',
            introMessage: 'Selamat Datang di Helpdesk , ketik mulai sebelum bertanya',
            mainColor: '#409150',
            bubbleAvatarUrl: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpiE_JYmQt-t_EEwJKK5JUBQ50PnCfFMmccw&usqp=CAU',
        };
    </script>
    <script src='{{ asset('js/widget.js') }}'></script> 
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('additional-script')
</body>

</html>