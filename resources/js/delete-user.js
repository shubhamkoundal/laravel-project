$(document).on('click', '.delete-user-btn', function(e) {
    e.preventDefault();
    var userId = $(this).data('id');
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            type: "DELETE",
            url: "/users/" + userId,
            success: function(data) {
                alert(data.success);
                // optionally, remove the deleted user from the DOM
                $('tr[data-id="' + userId + '"]').remove();
            },
            error: function(data) {
                alert(data.responseJSON.error);
            }
        });
    }
});
