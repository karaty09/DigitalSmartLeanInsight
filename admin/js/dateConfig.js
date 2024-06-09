// กำหนดวันเริ่มต้นปัจจุบัน
document.addEventListener("DOMContentLoaded", (event) => {
  // Get the current date
  const currentDate = new Date();
  // Format the date to YYYY-MM-DD
  const formattedDate = currentDate.toISOString().split("T")[0];
  // Set the value of the end-date input field
  document.getElementById("start-date").value = formattedDate;
});

// กำหนดวันสิ้นสุดของปีปัจจุบัน
document.addEventListener("DOMContentLoaded", (event) => {
  // Get the current year
  const currentYear = new Date().getFullYear();
  // Set the date to December 31st of the current year
  const endDate = new Date(currentYear, 11, 31);
  // Format the date to YYYY-MM-DD
  const formattedDate = endDate.toISOString().split("T")[0];
  // Set the value of the end-date input field
  document.getElementById("end-date").value = formattedDate;
});

document.addEventListener("DOMContentLoaded", function () {
  // Function to update selected date
  function updateSelectedDate() {
    const startDate = new Date(
      document.getElementById("start-date").value
    ).toLocaleDateString("th-TH");
    const endDate = new Date(
      document.getElementById("end-date").value
    ).toLocaleDateString("th-TH");
    const selectedDateField = document.getElementById("selected-date");
    selectedDateField.value = `วันที่เริ่มต้น: ${startDate} ถึงวันที่สิ้นสุด: ${endDate}`;
  }

  // Add event listeners to date inputs
  document
    .getElementById("start-date")
    .addEventListener("change", updateSelectedDate);
  document
    .getElementById("end-date")
    .addEventListener("change", updateSelectedDate);

  // Call updateSelectedDate() once on page load
  // updateSelectedDate();
});
