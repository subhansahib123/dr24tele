    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- JQUERY JS -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- SHOW PASSWORD JS -->
    <script src="{{asset('assets/js/show-password.min.js')}}"></script>
    <!-- BOOTSTRAP JS -->
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- SPARKLINE JS-->
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script>

    <!-- Sticky js -->
    <script src="{{asset('assets/js/sticky.js')}}"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>

    <!-- PIETY CHART JS-->
    <script src="{{asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
    <script src="{{asset('assets/plugins/peitychart/peitychart.init.js')}}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/plugins/p-scroll/pscroll.js')}}"></script>
    <script src="{{asset('assets/plugins/p-scroll/pscroll-1.js')}}"></script>

    <!-- INTERNAL CHARTJS CHART JS-->
    <script src="{{asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/chart/rounded-barchart.js')}}"></script>
    <script src="{{asset('assets/plugins/chart/utils.js')}}"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- INTERNAL Data tables js-->
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>

    <!-- INTERNAL APEXCHART JS -->
    <script src="{{asset('assets/js/apexcharts.js')}}"></script>
    <script src="{{asset('assets/plugins/apexchart/irregular-data-series.js')}}"></script>

    <!-- INTERNAL Flot JS -->
    <script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.fillbetween.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/chart.flot.sampledata.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/dashboard.sampledata.js')}}"></script>

    <!-- INTERNAL Vector js -->
    <script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

    <!-- Adding Fire base -->
    <script src="{{asset('public_assets/js/firebase.js')}}"></script>
    <!-- TypeHead js -->
    {{-- <script src="../assets/plugins/bootstrap5-typehead/autocomplete.js"></script>
    <script src="../assets/js/typehead.js"></script> --}}

    <!-- INTERNAL INDEX JS -->
    <script src="{{asset('assets/js/index1.js')}}"></script>

    <!-- Color Theme js -->
    <script src="{{asset('assets/js/themeColors.js')}}"></script>

    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <script src="{{asset('/assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js')}}"></script>
    <script src="{{asset('/assets/js/moment.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script src="{{asset('/assets/datetimepicker/build/jquery.datetimepicker.full.js')}}"></script>

    <script src="{{asset('/assets/js/form-wizard.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>

    <!-- Active NAv----->

    <script>
        /*** add active class and stay opened when selected ***/
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.side-menu a').filter(function() {
            if (this.href) {
                return this.href == url || url.href.indexOf(this.href) == 0;
            }
        }).addClass('active');

        // for the treeview
        $('ul.slide-menu a').filter(function() {
            if (this.href) {
                return this.href == url || url.href.indexOf(this.href) == 0;
            }
        }).parentsUntil(".side-menu > .nav-tree").addClass('open').prev('a').addClass('active').parent().addClass('is-expanded');
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/css/intlTelInput.css" />
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/js/intlTelInput.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/js/utils.js"></script>
    <script type="text/javascript">
        function FormatNumber() {
            var number = $('#txtPhone').val();
            var classf = $(".selected-flag > div").attr("class");
            var flag = classf.slice(-2);
            var formattedNumber = intlTelInputUtils.formatNumber(number, flag, intlTelInputUtils.numberFormat
                .INTERNATIONAL);
            $('#txtPhone').val(formattedNumber.slice(formattedNumber.indexOf(' ') + 1, formattedNumber.length));
        }
        $(function() {
            var code = "+911234567890";

            if ($('#txtPhone').length && $('#txtPhoneNew').length) {
                $('#txtPhoneNew').val(code);
                $('#txtPhoneNew').intlTelInput({
                    autoHideDialCode: true,
                    autoPlaceholder: "ON",
                    dropdownContainer: document.body,
                    formatOnDisplay: true,
                    hiddenInput: "newPhoneNumber",
                    initialCountry: "auto",
                    nationalMode: true,
                    placeholderNumberType: "MOBILE",
                    preferredCountries: ['US'],
                    separateDialCode: true
                });
                FormatNumber();
                $('#txtPhoneNew').keyup(function() {
                    FormatNumber();
                });
                $('#txtPhone').val(code);
                $('#txtPhone').intlTelInput({
                    autoHideDialCode: true,
                    autoPlaceholder: "ON",
                    dropdownContainer: document.body,
                    formatOnDisplay: true,
                    hiddenInput: "phoneNumber",
                    initialCountry: "auto",
                    nationalMode: true,
                    placeholderNumberType: "MOBILE",
                    preferredCountries: ['US'],
                    separateDialCode: true
                });
                FormatNumber();
                $('#txtPhone').keyup(function() {
                    FormatNumber();
                });
            } else if ($('#txtPhone').length) {
                $('#txtPhone').val(code);
                $('#txtPhone').intlTelInput({
                    autoHideDialCode: true,
                    autoPlaceholder: "ON",
                    dropdownContainer: document.body,
                    formatOnDisplay: true,
                    hiddenInput: "phoneNumber",
                    initialCountry: "auto",
                    nationalMode: true,
                    placeholderNumberType: "MOBILE",
                    preferredCountries: ['US'],
                    separateDialCode: true
                });
                FormatNumber();
                $('#txtPhone').keyup(function() {
                    FormatNumber();
                });
            } else if ($('#txtPhoneNew').length) {
                $('#txtPhoneNew').val(code);
                $('#txtPhoneNew').intlTelInput({
                    autoHideDialCode: true,
                    autoPlaceholder: "ON",
                    dropdownContainer: document.body,
                    formatOnDisplay: true,
                    hiddenInput: "phoneNumberNew",
                    initialCountry: "auto",
                    nationalMode: true,
                    placeholderNumberType: "MOBILE",
                    preferredCountries: ['US'],
                    separateDialCode: true
                });
                FormatNumber();
                $('#txtPhoneNew').keyup(function() {
                    FormatNumber();
                });
            }

        });
    </script>
    <!--Firebase---->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var loggedIn = {
            {
                auth() - > check() ? 1 : 0
            }
        };
        var user_id = '';
        @auth
        if (loggedIn == 1) {
            var user_id = {
                {
                    auth() - > user() - > id
                }
            };
        }
        @endauth
    </script>
    <script src="{{asset('public_assets/js/firebase.js')}}"></script>
    <!----Custom Function To Manage-->
    @yield('foot_script');
    </body>

    </html>