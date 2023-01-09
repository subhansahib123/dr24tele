<!-- Back-to-top button Start -->
<a href="javascript:void(0)" class="back-to-top bounce"><i class="ri-arrow-up-s-line"></i></a>
<!-- Back-to-top button End -->

<!-- Link of JS files -->



<script src="{{ asset('public_assets/js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('public_assets/calender_jquery/jquery.calendars.picker.js') }}"></script> --}}
{{-- <script src="{{ asset('public_assets/calender_jquery/main.js') }}"></script>
<script src="{{ asset('public_assets/calender_jquery/main.js') }}"></script>
<script src="{{ asset('public_assets/calender_jquery/main.js') }}"></script>
<script src="{{ asset('public_assets/calender_jquery/main.js') }}"></script>
<script src="{{ asset('public_assets/calender_jquery/main.js') }}"></script> --}}
<script src="{{ asset('public_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public_assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('public_assets/js/contact-form-script.js') }}"></script>
<script src="{{ asset('public_assets/js/aos.js') }}"></script>
<script src="{{ asset('public_assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public_assets/js/odometer.min.js') }}"></script>
<script src="{{ asset('public_assets/js/fancybox.js') }}"></script>
<script src="{{ asset('public_assets/js/jquery.appear.js') }}"></script>
<script src="{{ asset('public_assets/js/tweenmax.min.js') }}"></script>
<script src="{{ asset('public_assets/js/main.js') }}"></script>
{{-- <script src="{{ asset('public_assets/js/fullcalendar.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('public_assets/js/inputMask.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/css/intlTelInput.css" />
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>  -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/js/intlTelInput.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/js/utils.js"></script>
<!-- <script type="text/javascript">
    function FormatNumber() {
        var number = $('#txtPhone').val();
        var classf = $(".selected-flag > div").attr("class");
        var flag = classf.slice(-2);
        var formattedNumber = intlTelInputUtils.formatNumber(number, flag, intlTelInputUtils.numberFormat
            .INTERNATIONAL);
        $('#txtPhone').val(formattedNumber.slice(formattedNumber.indexOf(' ') + 1, formattedNumber.length));
    }
    $(function() {
        var code = "";
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
        }


    });
</script> -->
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
        $('#card-number').inputmask('9999999999999999');
        $('#card-cvc').inputmask('999');
        $('#card-month').inputmask('99');
        $('#card-year').inputmask('99');
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
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#reg_Organization').change(function() {
            if ($(this).is(":checked"))
                $('#ORG,#reg_img,#card').show();
            else {
                $('#ORG,#reg_img,#card,#atm_card').hide();
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#pay_by_atmCard').change(function() {
            if ($(this).is(":checked"))
                $('#atm_card').show(),
                $('#reg_img').hide()
            else {
                $('#reg_img').show(),
                    $('#atm_card').hide()
            }
        });
    });
</script>


<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var loggedIn = {{ auth()->check() ? 1 : 0 }};
    var user_id = '';
    @auth
    if (loggedIn == 1) {
        var user_id = {{ auth()->user()->id }};
    }
    @endauth
</script>
<script src="{{ asset('public_assets/js/firebase.js') }}"></script>
@yield('foot_script')

</body>

</html>
