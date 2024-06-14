$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    
    $("#ticketbox [type='radio']").on("change", function() {
        $("#ticketbox select").prop("disabled", false);
        $("#ticketbox input").prop("disabled", false);

        const ticketType = getSelectedRadio("ticketType").value;
        $("#returnDate").prop("disabled", ticketType == "oneway");
    });

    $("#ticketbox [type='date']").on("change", function() {
        const todayDate = new Date();
        const ticketType = getSelectedRadio("ticketType").value;
        const depValue = $("#departureDate").val();
        const depDate = new Date(depValue);
        let wrong = false;

        if (depValue == "" || depValue == null || depValue == undefined) {
            wrong = true;
        }
        
        if (depDate < todayDate) {
            $("#todayAlert").show();
            wrong = true;
        } else {
            $("#todayAlert").hide();
        } 

        if (ticketType == "twoway") {
            const retValue = $("#returnDate").val();
            const retDate = new Date(retValue);

            if (retValue == "" || retValue == null || retValue == undefined) {
                wrong = true;
            }

            if (retDate <= depDate) {
                $("#dateAlert").show();
                wrong = true;
            } else {
                $("#dateAlert").hide();
            }
        }

        $("#searchFlightsButton").prop("disabled", wrong);
    })

    // $("#fromDestination").on("change", function() {
    //     if ($(this).val() != "PRG") {
    //         $("#toDestination").val("PRG");
    //         $("#toDestination").prop("disabled", true);
    //     } else {
    //         $("#toDestination").prop("disabled", false);
    //     }
    // });

    // $("#toDestination").on("change", function() {
    //     if ($(this).val() != "PRG") {
    //         $("#fromDestination").val("PRG");
    //         $("#fromDestination").prop("disabled", true);
    //     } else {
    //         $("#fromDestination").prop("disabled", false);
    //     }
    // });

    $("#loginLink").click(function() {
        $("#registerForm").hide();
        $("#loginForm").show();
        $(this).hide();
        $("#registerLink").show();
    });

    $("#registerLink").click(function() {
        $("#loginForm").hide();
        $("#registerForm").show();
        $(this).hide();
        $("#loginLink").show();
    });

    $('#password, #confirmPassword').on('change', function() {
        const password = $("#password").val();
        const confirm = $("#confirmPassword").val();

        if (password.length < 8) {
            $("#shortPasswordAlert").show();
            return;
        } else {
            $("#shortPasswordAlert").hide();
        }

        if (password != "" && confirm != "") {
            if (password == confirm) {
                $("#equalPasswordAlert").hide();
            } else {
                $("#equalPasswordAlert").show();
            }
        }
    });

    $("#phone").on("change", function() {
        const phoneRegex = /^(\+420)?\d{9}$/;
        if (!phoneRegex.test($(this).val())) {
            $("#phoneAlert").show();
        } else {
            $("#phoneAlert").hide();
        }
    });

    $("#birthDate").on("change", function() {
        const value = $(this).val();
        const birthDate = new Date(value);
        const todayDate = new Date();
        const diffYears = todayDate.getFullYear() - birthDate.getFullYear();

        if (diffYears < 18) {
            $("#ageAlert").show();
        } else {
            $("#ageAlert").hide();
        }

        if (diffYears >= 18 && diffYears <= 26) {
            $("#isStudentRow").show();
        } else {
            $("#isStudentRow").hide();
        }
    });

    $("#registerForm *").on("change", function() {
        $("#registerButton").prop("disabled", !checkRegisterForm());
    });

    $("#loginForm input").on("change", function() {
        let empty = false;
        $("#loginForm input").each(function() {
            const value = $(this).val();
            if (value == "" || value == null || value == undefined) {
                empty = true;
            }
        });

        $("#loginButton").prop("disabled", empty);
    });

    $(".formLink").click(function() {
        const form = $(this).parents("form").get(0);
        $(form).submit();
    });

    $("#cardName").on("change", function() {
        const name = $(this).val();
        const nameRegex = /^\w+ \w+$/;

        if (!nameRegex.test(name)) {
            $("#nameAlert").show();
        } else {
            $("#nameAlert").hide();
        }
    });

    $("#cardNumber").on("change", function() {
        const number = $(this).val();
        const numberRegex = /^\d{16}$/;

        if (!numberRegex.test(number)) {
            $("#numberAlert").show();
        } else {
            $("#numberAlert").hide();
        }
    });

    $("#expiryDate").on("change", function() {
        const date = $(this).val();
        const dateRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;

        if (!dateRegex.test(date)) {
            $("#badDateAlert").show();
        } else {
            $("#badDateAlert").hide();

            const month = parseInt(date.split("/")[0], 10);
            const year = date.split("/")[1];
            const currentMonth = new Date().getMonth() + 1;
            const currentYear = new Date().getFullYear() % 100;

            if (year < currentYear || (year == currentYear && month < currentMonth)) {
                $("#expiryAlert").show();
            } else {
                $("#expiryAlert").hide();
            }
        }
    });

    $("#cvv").on("change", function() {
        const cvv = $(this).val();
        const cvvRegex = /^\d{3}$/;

        if (!cvvRegex.test(cvv)) {
            $("#cvvAlert").show();
        } else {
            $("#cvvAlert").hide();
        }
    });

    $("#paymentForm *").on("change", function() {
        let allFilled = true;

        $("#paymentForm input").each(function() {
            if ($(this).val() === "") {
                allFilled = false;
                return false;
            }
        });
    
        let errorVisible = $(".errorText:visible").length > 0;
        $("#paymentButton").prop("disabled", !(allFilled && !errorVisible));
    });

    $("#updateEmail").on("change", function() {
        const value = $(this).val();
        const emailRegex = /^\w+@\w\.\w+$/;

        if (!emailRegex.test(value)) {
            $("#emailAlert").show();
        } else {
            $("#emailAlert").hide();
        }
    });

    $("#updatePhone").on("change", function() {
        const value = $(this).val();
        const phoneRegex = /^(\+420)?\d{9}$/;

        if (!phoneRegex.test(value)) {
            $("#phoneAlert").show();
        } else {
            $("#phoneAlert").hide();
        }
    });

    $("#oldPassword").on("change", function() {
        const old = $("#oldPassword").val();

        if (old == "") {
            $("#oldAlert").show();
        } else {
            $("#oldAlert").hide();
        }
    })

    $("#updatePassword, #updateConfirm").on("change", function() {
        const pass = $("#updatePassword").val();
        const confirm = $("#updateConfirm").val();
        const old = $("#oldPassword").val();

        if (pass.length == 0 && confirm.length == 0) {
            return;
        }

        if (pass.length < 8) {
            $("#passAlert").show();
        } else {
            $("#passAlert").hide();
        }

        if (pass != confirm) {
            $("#confirmAlert").show();
        } else {
            $("#confirmAlert").hide();
        }
    });

    $("#updateUserForm *").on("change", function() {
        $("#updateButton").prop("disabled", $("#updateUserForm .errorText:visible").length != 0);
    });
});