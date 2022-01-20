// https://www.youtube.com/watch?v=7L0YXnGuH10&t=881s

$(document).ready(function () {
    $('#signup-email').keyup(function (e) { 
        var email = $('#signup-email').val();  // store the value of user typed in the email box
        $.ajax({
            type: "POST",
            url: "signing_up.php",
            data: {
                "check_signup_btn" : 1,
                "input_email": email,  //send the world typed in the email box
            },
            success: function (response) {   // response from signing_up.php
                $('#email-error').text(response);
            }
        });
    });
});



