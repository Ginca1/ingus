
  // Function to display error message
  function displayError(elementId, message) {
    var errorElement = document.getElementById(elementId);
    errorElement.innerText = message;
    errorElement.classList.add("error");
  }

  // Function to display success message
  function displaySuccess(elementId, message) {
    var successElement = document.getElementById(elementId);
    successElement.innerText = message;
    successElement.classList.remove("error");
  }

  // Function to reset input fields
  function resetInputs() {
    document.getElementById("taskName").value = "";
    document.getElementById("description").value = "";
    document.getElementById("date").value = "";
    document.getElementById("statusDropdown").value = "";
  }

  // Function to validate the task name
  function validateTaskName() {
    var taskName = document.getElementById("taskName").value;
    var taskNameError = "taskNameError";
    var taskNameSuccess = "taskNameSuccess";

    if (taskName.trim() === "") {
      displayError(taskNameError, "Task name is required");
      displaySuccess(taskNameSuccess, "");
      return false;
    } else if (taskName.trim().length >= 19) {
      displayError(taskNameError, "Task name is too long");
      displaySuccess(taskNameSuccess, "");
      return false;
    } else if (/[^a-zA-Z0-9\s]/.test(taskName)) {
      displayError(taskNameError, "Task name cannot contain special characters");
      displaySuccess(taskNameSuccess, "");
      return false;
    } else {
      displayError(taskNameError, "");
      displaySuccess(taskNameSuccess, "Task name is valid");
      return true;
    }
  }

  // Function to validate the description
  function validateDescription() {
    var description = document.getElementById("description").value;
    var descriptionError = "descriptionError";
    var descriptionSuccess = "descriptionSuccess";

    if (description.trim() === "") {
      displayError(descriptionError, "Description is required");
      displaySuccess(descriptionSuccess, "");
      return false;
    } else if (/[^a-zA-Z0-9\s]/.test(description)) {
      displayError(descriptionError, "Description cannot contain special characters");
      displaySuccess(descriptionSuccess, "");
      return false;
    } else {
      displayError(descriptionError, "");
      displaySuccess(descriptionSuccess, "Description is valid");
      return true;
    }
  }

  // Function to validate the due date
  function validateDate() {
    var date = document.getElementById("date").value;
    var dateError = "dateError";
    var dateSuccess = "dateSuccess";

    if (date.trim() === "") {
      displayError(dateError, "Due date is required");
      displaySuccess(dateSuccess, "");
      return false;
    } else if (!/^\d{4}-\d{2}-\d{2}$/.test(date)) {
      displayError(dateError, "Invalid date format (YYYY-MM-DD)");
      displaySuccess(dateSuccess, "");
      return false;
    } else {
      displayError(dateError, "");
      displaySuccess(dateSuccess, "Date is valid");
      return true;
    }
  }

  // Function to validate the status dropdown
  function validateDropdown() {
    var dropdown = document.getElementById("statusDropdown");
    var dropdownError = "dropdownError";
    var dropdownSuccess = "dropdownSuccess";

    if (dropdown.value === "") {
      displayError(dropdownError, "Status is required");
      displaySuccess(dropdownSuccess, "");
      return false;
    } else if (dropdown.value !== "todo" && dropdown.value !== "done") {
      displayError(dropdownError, "Invalid status value");
      displaySuccess(dropdownSuccess, "");
      return false;
    } else {
      displayError(dropdownError, "");
      displaySuccess(dropdownSuccess, "Status is valid");
      return true;
    }
  }

  // Function to validate all fields
  function validateForm() {
    var isTaskNameValid = validateTaskName();
    var isDescriptionValid = validateDescription();
    var isDateValid = validateDate();
    var isDropdownValid = validateDropdown();

    // Return true only if all fields are valid
    return isTaskNameValid && isDescriptionValid && isDateValid && isDropdownValid;
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Burger icon and sidebar functionality
    document.querySelector(".burger-icon").addEventListener("click", () => {
      toggleMenu();
    });

    window.toggleMenu = function () {
      document.getElementById("mySidebar").style.width = "50%";
    };

    window.closeMenu = function () {
      document.getElementById("mySidebar").style.width = "0";
    };

    // Function to populate the dropdown with task statuses
    function fetchAndPopulateDropdown() {
      const apiUrl = 'http://localhost/darbi/trio/api/dropdown.php';

      function populateDropdown(statuses) {
        const statusDropdown = document.getElementById('statusDropdown');
        statuses.forEach(status => {
          const option = document.createElement('option');
          option.value = status;
          option.textContent = status;
          statusDropdown.appendChild(option);
        });
      }

      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          populateDropdown(data);
        })
        .catch(error => {
          console.error('Error fetching task statuses:', error);
        });
    }

    // Call the function to fetch and populate the dropdown
    fetchAndPopulateDropdown();

    // Add event listener for the add button
    document.getElementById("add").addEventListener("click", function () {
      // Validate the form before proceeding
      if (validateForm()) {
        // Get form values
        var taskName = document.getElementById("taskName").value;
        var description = document.getElementById("description").value;
        var date = document.getElementById("date").value;
        var status = document.getElementById("statusDropdown").value;

        // Create a FormData object to send form data
        var formData = new FormData();
        formData.append("taskName", taskName);
        formData.append("description", description);
        formData.append("date", date);
        formData.append("status", status);

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure it: POST-request for the URL of your API endpoint
        xhr.open("POST", "http://localhost/darbi/trio/api/insert.php", true);

        // Send the request with the form data
        xhr.send(formData);

        // Reset inputs after successful submission
        resetInputs();
      }
    });
  });
