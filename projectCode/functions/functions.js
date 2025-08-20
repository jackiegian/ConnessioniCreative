$(document).ready(function () {
    
    $('.nav-item').hover(function () {
        $(this).find('.dropdown').css('display', 'block');
    }, function () {
        $(this).find('.dropdown').css('display', 'none');
    });

    
    $('#list-1').click(function (e) {
        e.stopPropagation(); 
        $('#new-dropdown').css('display', 'block');
        $('.nav-item .dropdown').css('display', 'none'); 
    });


    $('#new-dropdown').mouseleave(function () {
        $('#new-dropdown').css('display', 'none');
    });

    $('.dropdown-list').hover(function () {
        var backgroundImage = $(this).attr('data-background-image');
        $('#new-dropdown').css('background-image', 'url(' + backgroundImage + ')');
    }, function () {
        $('#new-dropdown').css('background-image', '');
    });

    $('#toggle-password').click(function () {
        var passwordField = document.getElementById("password");
        var icon = $(this);

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.text("visibility_off");
        } else {
            passwordField.type = "password";
            icon.text("visibility");
        }
    });

    document.getElementById('name').addEventListener('input', function () {
        validateName();
    });
    document.getElementById('surname').addEventListener('input', function () {
        validateSurname();
    });
    document.getElementById('mail').addEventListener('input', function () {
        validateMail();
    });
    document.getElementById('password').addEventListener('input', function () {
        validatePassword();
    });
    
    function validateName() {
        var name = document.getElementById('name').value;
        var errorMessage = document.getElementById('name-error');
    
        if (name.trim() === '') {
            errorMessage.style.display = 'block';
            return false;
        } else {
            errorMessage.style.display = 'none';
            return true;
        }
    }

});
