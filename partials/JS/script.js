$(document).ready(function () {
    // Custom method to check for strong passwords
    $.validator.addMethod("strongPassword", function (value, element) {
        return this.optional(element) || /[a-z]/.test(value) && /[A-Z]/.test(value) && /\d/.test(value);
    }, "Please enter a valid password.");

    // Custom method to check for valid usernames (letters, numbers, underscores, and dots only)
    $.validator.addMethod("validUsername", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9_.]+$/.test(value);
    }, "Usernames can only contain letters, numbers, underscores, and dots.");

    // Initialize form validation
    $("#SignupForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            username: {
                required: true,
                minlength: 3,
                validUsername: true
            },
            name: {
                required: true,
                minlength: 3,
                maxlength: 16,
            },
            password: {
                required: true,
                minlength: 6,
                strongPassword: true
            },
            confirmpassword: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            email: {
                required: "Please enter your email address.",
                email: "Please enter a valid email address."
            },
            username: {
                required: "Please enter a Username.",
                minlength: "Your username must be at least 3 characters long.",
                validUsername: "Usernames can only contain letters, numbers, underscores, and dots."
            },
            name: {
                required: "Please enter a Name.",
                minlength: "Your Name must be at least 3 characters long.",
                maxlength: "Your name can only contain 16 characters"
            },
            password: {
                required: "Please provide a Password.",
                minlength: "Your password must be at least 6 characters long.",
                strongPassword: "Please enter a valid password."
            },
            confirmpassword: {
                required: "Please confirm your password.",
                equalTo: "Please enter the same password as above."
            }
        },
        errorClass: "text-danger",
        validClass: "text-success"
    });

    // Toggle password visibility
    $('#passwordEye').click(() => {
        let passwordfield = $('#password');
        let icon = $('#passwordEye i');

        if (passwordfield.attr('type') === 'password') {
            passwordfield.attr('type', 'text');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        } else {
            passwordfield.attr('type', 'password');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        }
    });
});
