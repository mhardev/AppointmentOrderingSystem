var today = new Date();
var currentMonth = today.getMonth();
var currentYear = today.getFullYear();
var selectYear = document.getElementById("year");
var selectMonth = document.getElementById("month");
var monthHeader = document.getElementById("monthHeader");
var yearHeader = document.getElementById("yearHeader");
var nextBtn = document.getElementById("next");
var previousBtn = document.getElementById("previous");
var datePicked = document.getElementById("appDate");
var months = "";
var days = "";
var monthsArr = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var daysArr = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

months = monthsArr;
days = daysArr;

var tableHeaderMonth = document.getElementById("thead-month");
var dataHead = "<tr>";
var startDay = "";

for (dhead in days) {
  days[dhead] === "Sun" ? startDay = "red-text" : startDay = "";
  dataHead += "<th data-days='" + days[dhead] + "' class='" + startDay + "'>" + days[dhead] + "</th>";
}

dataHead += "</tr>";
tableHeaderMonth.innerHTML = dataHead;
showCalendar(currentMonth, currentYear);  

nextBtn.addEventListener("click", next, false);
previousBtn.addEventListener("click", previous, false);

function yearRange(start, end) {
  var years = "";

  for (var year = start; year <= end; year++) {
    years += "<option value='" + year + "'>" + year + "</option>";
  }

  return years;
}

var createYear = yearRange(1970, 2050);
selectYear.innerHTML = createYear;

function next() {
  currentYear = currentMonth === 11 ? currentYear + 1 : currentYear;
  currentMonth = (currentMonth + 1) % 12;
  showCalendar(currentMonth, currentYear);
}

function previous() {
  currentYear = currentMonth === 0 ? currentYear - 1 : currentYear;
  currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
  showCalendar(currentMonth, currentYear);
}

function jump() {
  currentYear = parseInt(selectYear.value);
  currentMonth = parseInt(selectMonth.value);
  showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {
  var firstDay = new Date(year, month).getDay();
  var monthString = monthsArr[month];

  table = document.getElementById("calendar-body");
  table.innerHTML = ""; 
  monthHeader.innerHTML = monthString.substring(0, 3);
  yearHeader.innerHTML = year;
  selectYear.value = year;
  selectMonth.value = month;

  var date = 1;

  for (var i = 0; i < 6; i++ ) {
    var row = document.createElement("tr");

    for (var j = 0; j < 7; j++) {
      if (i === 0 && j < firstDay) {
        cell = document.createElement("td");
        cellText = document.createTextNode("");
        cell.appendChild(cellText);
        row.appendChild(cell);
      } else if (date > daysInMonth(month, year)) {
        break;
      } else {
        cell = document.createElement("td");
        cell.setAttribute("data-date", date);
        cell.setAttribute("data-month", month + 1);
        cell.setAttribute("data-year", year);
        cell.setAttribute("data-month-name", months[month]);
        cell.className = "date-picker";
        cell.innerHTML = "<span>" + date + "</span>";
        cell.onclick = function(event) {
          var dates = document.querySelectorAll(".date-picker");
          var currentTarget = event.currentTarget;
          var date = currentTarget.dataset.date;
          var month = currentTarget.dataset.month - 1;
          var year = currentTarget.dataset.year;

          for (var i = 0; i < dates.length; i++) {
            dates[i].classList.remove("selected");
        }

        currentTarget.classList.add("selected");
        var formattedDate = year + "-" + (month + 1).toString().padStart(2, '0') + "-" + date;

        datePicked.innerHTML = formattedDate;
        document.getElementById("appDate").value = formattedDate;

        // Check slot availability when a date is clicked
        checkSlotAvailability(formattedDate);
    };

        row.appendChild(cell);
        date++;
      }
    }

    table.appendChild(row);
  }
}

function daysInMonth(month, year) {
  return 32 - new Date(year, month, 32).getDate();
}

function checkSlotAvailability(selectedDate) {
  $.ajax({
      url: 'checkAppointmentSlots.php',
      type: 'GET',
      data: {
          date: selectedDate
      },
      dataType: 'json',
      success: function (data) {
          var isSlotAvailable = data[0].mornA < 5 || data[0].mornB < 5 || data[0].mornC < 5 || data[0].mornD < 5 
          || data[0].afterA < 5 || data[0].afterB < 5 || data[0].afterC < 5 || data[0].afterA < D;

          // Find and update the selected date cell's class
          var selectedDateCell = document.querySelector(".date-picker.selected");
          if (selectedDateCell) {
              selectedDateCell.classList.toggle("redDate", !isSlotAvailable);
              selectedDateCell.classList.toggle("greenDate", isSlotAvailable);
          }
      },
      error: function (error) {
          console.error("An error occurred:", error);
      }
  });
}