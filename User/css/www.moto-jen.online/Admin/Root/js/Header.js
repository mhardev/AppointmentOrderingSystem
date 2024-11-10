$(document).ready(function () {
    $('#changePass').click(function () {
        var currentPass = $('#CurPass').val();
        var newPass = $('#newPass').val();
        var confirmPass = $('#confirmPass').val();
    
        if (currentPass === newPass) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "The new password is the same as the current password",
            });
            return;
        }
    
        if (newPass.length < 8 || !hasSpecialCharacters(newPass)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password should be at least 8 characters long and contain special characters.',
            });
            return;
        }
    
        if (newPass !== confirmPass) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Passwords don't match!",
            });
            return;
        }
    
        $.ajax({
            url: 'APIs/Header/checkPass.php',
            type: 'POST',
            data: { id: currentPass },
            dataType: 'json',
            success: function (data) {
                if (data === '1') {
                    updatePassword(newPass);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Current password is incorrect',
                    });
                }
            },
            error: function (error) {
                console.error("An error occurred:", error);
            }
        });
    });
    
    function updatePassword(newPassword) {
        $.ajax({
            url: 'APIs/Header/updatePass.php',
            type: 'POST',
            data: { pass: newPassword },
            dataType: 'json',
            success: function (data) {
                if (data === '1') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Password Changed!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#headerCP').modal('hide');
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to update password',
                    });
                }
            },
            error: function (error) {
                console.error("An error occurred:", error);
            }
        });
    }
    
    function hasSpecialCharacters(str) {
        var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        return format.test(str);
    }
    
    


    $('#updtAcc').click(function () {
        $.ajax({
            url: 'APIs/Header/updateAdminAccount.php',
            type: 'POST',
            data: { email: $('#Email').val(), age: $('#Age').val(), address: $('#Address').val(), number: $('#Number').val() },
            success: function (data) {
                Swal.fire({
                    icon: "success",
                    text: "Information Updated!",
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    $("#updateInfo").find(':input').val('');
                    $('#updateInfo').modal('hide');
                    location.reload();
                })
            },
            error: function (error) {
                console.error("An error occurred:", error);
            }
        });
    })


    $('#updtInfo').click(function () {
        $.ajax({
            url: 'APIs/Header/getUserInfo.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#Username').val(data[0].username)
                $('#Email').val(data[0].email)
                $('#Age').val(data[0].age)
                $('#Number').val(data[0].number)
                $('#Address').val(data[0].address)
            },
            error: function (error) {
                console.error("An error occurred:", error);
            }
        });
    })

    $('#updtPicBtn').click(function () {
        var form_data = new FormData();
        form_data.append('file', $('#updateImage').prop('files')[0]);
        $.ajax({
            url: 'APIs/Header/updatePic.php',
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            success: function (data) {
                Swal.fire({
                    icon: "success",
                    text: "Profile Pic Changed! ",
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    $("#updateProfile").find(':input').val('');
                    $('#updateProfile').modal('hide');
                    location.reload();
                })
            },
            error: function (error) {
                console.error("An error occurred:", error);
            }
        });
    });


})