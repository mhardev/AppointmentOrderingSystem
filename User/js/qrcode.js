$(document).ready(function(){
    // Your existing code here

    // Function to show QR code based on payment method
    function showQRCode(paymentMethod) {
        // Hide all QR codes initially
        $('#gcashQR').hide();
        $('#mayaQR').hide();

        // Show the respective QR code based on payment method
        if (paymentMethod === 'Gcash') {
            $('#gcashQR').show();
        } else if (paymentMethod === 'Maya') {
            $('#mayaQR').show();
        }
    }
    $("#paymentMethod").on('change', function(){
        // Your existing payment method change code

        // Call the function to show the QR code based on the selected method
        showQRCode($(this).val());
    })
});