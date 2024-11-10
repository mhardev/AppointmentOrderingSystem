$(document).ready(function () {

    // Function to load services data dynamically
    function loadServicesData() {
      $.ajax({
        url: 'APIs/ServicesAPI/getServices.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
          // Populate checkboxes with services data
          $.each(data, function (key, value) {
            $('#servicesCheckbox').append(
              '<div class="form-check">' +
              '<input class="form-check-input" type="checkbox" value="' + value.id + '" id="service_' + value.id + '">' +
              '<label class="form-check-label" for="service_' + value.id + '">' + value.services_name + ' - $' + value.services_price + '</label>' +
              '</div>'
            );
          });
        },
        error: function (error) {
          console.error("An error occurred:", error);
        }
      });
    }

    // Load services data on modal open
    $('#addOnServicesModal').on('show.bs.modal', function () {
      $('#servicesCheckbox').empty(); // Clear existing checkboxes
      loadServicesData();
    });

    // Calculate total cost on checkbox change
    $('#servicesCheckbox').on('change', 'input[type="checkbox"]', function () {
      var totalCost = 0;
      $('input[type="checkbox"]:checked').each(function () {
        totalCost += parseFloat($(this).siblings('label').text().replace('$', ''));
      });
      $('#totalCost').val(totalCost.toFixed(2));
    });

    // AJAX to submit selected services and total cost
    $('#submitAddOnServices').click(function () {
      var selectedServices = [];
      $('input[type="checkbox"]:checked').each(function () {
        selectedServices.push($(this).val());
      });

      $.ajax({
        url: 'APIs/AddOnServicesAPI/submitAddOnServices.php',
        type: 'POST',
        data: {
          selectedServices: selectedServices,
          totalCost: $('#totalCost').val()
        },
        success: function (data) {
          // Handle success, e.g., show a success message
          console.log(data);
          $('#addOnServicesModal').modal('hide');
        },
        error: function (error) {
          // Handle error, e.g., show an error message
          console.error("An error occurred:", error);
        }
      });
    });
})