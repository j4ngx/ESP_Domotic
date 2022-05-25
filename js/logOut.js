$('li.logOut').on('click', function() {
    $.ajax({
        method: "POST",
        url: "./services/logOut.php",

    });
    location.replace("../index.php");


});
