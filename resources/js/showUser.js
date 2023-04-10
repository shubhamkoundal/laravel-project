$(document).ready(function() {
    // Get the user ID from the URL
    var userId = window.location.pathname.split('/').pop();

    // Make an AJAX request to get the user details
    $.ajax({
        url: '/users/' + userId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the HTML with the user details
            $('#user-name').text(response.name);
            $('#user-email').text(response.email);
            // Add more fields as necessary
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});
