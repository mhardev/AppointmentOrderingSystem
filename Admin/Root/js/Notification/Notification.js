$(document).ready(function(){
    $.ajax({
        url: 'APIs/NotificationAPI/Notification.php',
        type: 'POST',
        data: {
            supplier_id: $(this).data('id'),
        },
        success: function(data) {
            Swal.fire({
                icon: 'success',
                title: 'Product Added',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                $("#product_modal_cover").css('display', 'none');
                $("#product_modal_form")[0].reset();
            })
            
        },
        error: function(error) {
            alert(error);
        }
    });
})