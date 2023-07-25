document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("registrationForm");
    const ageField = document.getElementById("age");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

      // Perform JavaScript validation here before AJAX submission
        if (!validateFullName() || !validateEmail() || !validateMobile() || !validateGender()) {
            return;
        }

        const formData = new FormData(form);

        // AJAX submission using fetch API
        fetch("submit.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === "success") {
                form.reset();
                ageField.value = '';
            }
        })
        .catch(error => {
            console.log(error);
        });
    });

    // Update the age field automatically when the date of birth changes
    document.getElementById("dob").addEventListener("change", function () {
        const dob = new Date(this.value);
        const today = new Date();
        const age = today.getFullYear() - dob.getFullYear();
        ageField.value = age;
    });

    function validateFullName() {
        const fullNameInput = document.getElementById("fullname");
        const fullNamePattern = /^[a-zA-Z\s,.]+$/;
        if (!fullNamePattern.test(fullNameInput.value)) {
            alert("Invalid Fullname. Only letters, spaces, commas, and periods are allowed.");
            fullNameInput.focus();
            return false;
        }
        return true;
    }

    function validateEmail() {
        const emailInput = document.getElementById("email");
        const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
        if (!emailPattern.test(emailInput.value)) {
            alert("Invalid Email Address. Please enter a valid email format.");
            emailInput.focus();
            return false;
        }
        return true;
    }

    function validateMobile() {
        const mobileInput = document.getElementById("mobile");
        const mobilePattern = /^09\d{9}$/;
        if (!mobilePattern.test(mobileInput.value)) {
            alert("Invalid Mobile Number. Please enter a valid Philippine mobile number (e.g., 09970818774).");
            mobileInput.focus();
            return false;
        }
        return true;
    }

    function validateGender() {
        const genderSelect = document.getElementById("gender");
        if (genderSelect.value === "") {
            alert("Please select a gender.");
            genderSelect.focus();
            return false;
        }
        return true;
    }
});
