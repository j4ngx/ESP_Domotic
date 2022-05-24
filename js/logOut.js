$('li.logOut').on('click', function() {
    $.ajax({
        method: "POST",
        url: "http://localhost:8001/php/services/logOut.php",

    });
    location.replace("http://localhost:8001");


});
