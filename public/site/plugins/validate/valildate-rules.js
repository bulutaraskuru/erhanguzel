//Validation
jQuery(document).ready(function () {
    var form = $(".form-validate");
    form.each(function () {
        var elem = $(this);
        elem.validate({
            errorClass: "is-invalid",
            validClass: "is-valid ",
            errorElement: "div",
            focusInvalid: false,
            rules: {
                name: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                neighbourhood: {
                    required: true,
                },
                year: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                tcno: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
            },
            messages: {
                name: {
                    required: "Ad ve Soyad alanı zorunludur.",
                },
                phone: {
                    required: "Telefon No alanı zorunludur.",
                },
                neighbourhood: {
                    required: "Mahalle alanı zorunludur.",
                },
                year: {
                    required: "Doğum Yılı alanı zorunludur.",
                },
                email: {
                    required: "E-mail alanı zorunludur.",
                    email: "Geçerli bir e-mail adresi giriniz.",
                },
                tcno: {
                    required: "T.C. Kimlik No alanı zorunludur.",
                    minlength: "T.C. Kimlik No 11 haneli olmalıdır.",
                    maxlength: "T.C. Kimlik No 11 haneli olmalıdır.",
                    digits: "T.C. Kimlik No sadece rakamlardan oluşmalıdır.",
                },
            },
            errorPlacement: function (error, element) {
                element.parent().append(error);
            },
            invalidHandler: function (elem, validator) {
                $("html, body")
                    .stop(true, false)
                    .animate(
                        {
                            scrollTop:
                                $(validator.errorList[0].element).offset().top -
                                200,
                        },
                        1500,
                        "easeInOutExpo"
                    );
            },
            submitHandler: function (form) {
                // You can submit the form via AJAX here if needed
                form.submit();
            },
        });
    });
});
