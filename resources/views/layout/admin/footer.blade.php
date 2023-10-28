    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script> 
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let danger_message;
        let success_message;
        function successAlert(params) {
            toastr.options = {
                'progressBar' : true,
                'closeButton' : true,
                'closeMethod' : 'fadeOut',
                'closeEasing' : 'swing',
                'closeDuration' : 300
            }
            toastr.success(params)
        }
    
        function dangerAlert(params) {
            toastr.options = {
                'progressBar' : true,
                'closeButton' : true,
                'closeMethod' : 'fadeOut',
                'closeEasing' : 'swing',
                'closeDuration' : 300
            }
            toastr.error(params)
        }
    </script>
    @stack('additional-script')

</body>

</html>