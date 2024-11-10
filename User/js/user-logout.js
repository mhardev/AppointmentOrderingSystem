function confirmLogout(event) {
    event.preventDefault();
    
    swal({
        title: "Logout",
        text: "Are you sure you want to logout from this app?",
        icon: "warning",
        buttons: ["Cancel", "Logout"],
        dangerMode: true,
    }).then((willLogout) => {
        if (willLogout) {
            swal({
                title: "Success",
                text: "Logout Successfully",
                icon: "success"
            }).then(function() {
                window.location = "home.php";
            });
        }
    });
}