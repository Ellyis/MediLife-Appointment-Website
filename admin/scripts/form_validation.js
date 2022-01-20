function is_empty(str) {
    return (!str || str.length === 0 );
}

function set_error_for(input, message) {
	const form_control = input.parentElement;
	const error_field = form_control.querySelector("small");

    // Add error class
	form_control.className = "flex-item error";

    // Add error message
	error_field.innerText = message;

    input.focus();
    return false;
}

function set_success_for(input) {
	const form_control = input.parentElement;

    // Add success class
	form_control.className = "flex-item success";
    return true;
}


// Patient Validation
function validate_patient_full_name() {
    const full_name_input = document.getElementById("full-name");
    const full_name = full_name_input.value.trim();
    if (!is_empty(full_name) && !(/^[a-zA-Z]*[a-zA-Z\s]*[a-zA-Z]$/.test(full_name))) {
        return set_error_for(full_name_input, "Invalid full name");
    } else {
        return set_success_for(full_name_input);
    }
}

function validate_patient_contact_number() {
    const contact_number_input = document.getElementById("contact-number");
    const contact_number = contact_number_input.value.trim();
    if (!is_empty(contact_number) && !/^([0-9]{3})-([0-9]{7})$/.test(contact_number)) {
        return set_error_for(contact_number_input, "Invalid contact number");
    } else {
        return set_success_for(contact_number_input);
    }
}

function validate_email() {
    const email_input = document.getElementById("email-address");
    const email = email_input.value.trim();
    if (is_empty(email)) {
        return set_error_for(email_input, "Email address cannot be left blank");
    } else if (!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email)) { 
        return set_error_for(email_input, "Invalid email address");
    } else {
		return set_success_for(email_input);
	}
}

function validate_password() {
    const password_input = document.getElementById("password");
    const password = password_input.value.trim();
    if (!/^(?=.{8,30}$)/.test(password)) {
        return set_error_for(password_input, "Length must be between 8 and 30");
    } else if (!/^[a-zA-Z]+/.test(password)) { 
        return set_error_for(password_input, "First character must be alphabet");
    } else if (!/^[a-zA-Z0-9!@#$%^&*]+$/.test(password)) {
        return set_error_for(password_input, "Only alphanumeric and special characters are allowed");
    } else {
		return set_success_for(password_input);
	}
}

function validate_address_line_1() {
    const address_line_1_input = document.getElementById("address-line-1");
    return set_success_for(address_line_1_input);
}

function validate_address_line_2() {
    const address_line_2_input = document.getElementById("address-line-2");
    return set_success_for(address_line_2_input);
}

function validate_zip_code() {
    const zip_code_input = document.getElementById("zip-code");
    const zip_code = zip_code_input.value.trim();
    if (!is_empty(zip_code) && !/^\d{5}$/.test(zip_code)) {
        return set_error_for(zip_code_input, "Zip code should be 5 digits");
    } else {
        return set_success_for(zip_code_input);
    }
}

function validate_city() {
    const city_input = document.getElementById("city");
    const city = city_input.value.trim();
    if (!is_empty(city) && !/^[A-Za-z\s]+$/.test(city)) {
        return set_error_for(city_input, "Only letters are allowed");
    } else {
        return set_success_for(city_input);
    }
}

function validate_state() {
    const state_input = document.getElementById("state");
    const state = state_input.value.trim();
    if (!is_empty(state) && !/^[A-Za-z\s]+$/.test(state)) {
        return set_error_for(state_input, "Only letters are allowed");
    } else {
        return set_success_for(state_input);
    }
}

function validate_country() {
    const country_input = document.getElementById("country");
    const country = country_input.value.trim();
    if (!is_empty(country) && !/^[A-Za-z\s]+$/.test(country)) {
        return set_error_for(country_input, "Only letters are allowed");
    } else {
        return set_success_for(country_input);
    }
}

function validate_profile() {
    var country = validate_country();
    var state = validate_state();
    var city = validate_city();
    var zip_code = validate_zip_code();
    var address_line_2 = validate_address_line_2();
    var address_line_1 = validate_address_line_1();
    var password = validate_password();
    var email = validate_email();
    var contact_number = validate_patient_contact_number();
    var full_name = validate_patient_full_name();
    const validation = [full_name, contact_number, email, password, address_line_1, address_line_2, zip_code, city, state, country];
    if (validation.includes(false)) {
        return false;
    } else {
        return true;
    }
}

// Doctor Validation
function validate_full_name() {
    const full_name_input = document.getElementById("full-name");
    const full_name = full_name_input.value.trim();
    if (is_empty(full_name)) {
        return set_error_for(full_name_input, "Full name cannot be left blank");
    } else if (!/^[a-zA-Z/]*[a-zA-Z\s/]*[a-zA-Z/]$/.test(full_name)) {
        return set_error_for(full_name_input, "Invalid full name");
    }  else if (full_name.length > 100) {
        return set_error_for(full_name_input, "Full name cannot exceed 100 words");
    } else {
        return set_success_for(full_name_input);
    }
}

function validate_gender() {
    const gender_input = document.getElementById("gender");
    const gender = gender_input.value.trim();
    if (is_empty(gender)) {
        return set_error_for(gender_input, "Gender cannot be left blank");
    } else {
        return set_success_for(gender_input);
    }
}

function validate_contact_number() {
    const contact_number_input = document.getElementById("contact-number");
    const contact_number = contact_number_input.value.trim();
    if (is_empty(contact_number)) {
        return set_error_for(contact_number_input, "Contact number cannot be left blank");
    } else if (!/^([0-9]{3})-([0-9]{7})$/.test(contact_number)) {
        return set_error_for(contact_number_input, "Invalid contact number");
    } else {
        return set_success_for(contact_number_input);
    }
}

function validate_doctor_qualification() {
    const qualification_input = document.getElementById("qualification");
    const qualification = qualification_input.value.trim();
    if (is_empty(qualification)) {
        return set_error_for(qualification_input, "Qualification cannot be left blank");
    } else if (qualification.length > 100) {
        return set_error_for(qualification_input, "Qualification cannot exceed 100 words");
    } else {
        return set_success_for(qualification_input);
    }
}

function validate_doctor_specialty() {
    const specialty_input = document.getElementById("specialty");
    const specialty = specialty_input.value.trim();
    if (is_empty(specialty)) {
        return set_error_for(specialty_input, "Specialty cannot be left blank");
    } else if (!/^[A-Za-z\s,]+$/.test(specialty)) {
        return set_error_for(specialty_input, "Only letters are allowed");
    } else if (specialty.length > 50) {
        return set_error_for(specialty_input, "Specialty cannot exceed 50 words");
    } else {
        return set_success_for(specialty_input);
    }
}

function validate_doctor_languages() {
    const languages_input = document.getElementById("languages");
    const languages = languages_input.value.trim();
    if (is_empty(languages)) {
        return set_error_for(languages_input, "Languages cannot be left blank");
    } else if (!/^[A-Za-z\s,]+$/.test(languages)) {
        return set_error_for(languages_input, "Only letters are allowed");
    } else if (languages.length > 50) {
        return set_error_for(languages_input, "Languages cannot exceed 50 words");
    } else {
        return set_success_for(languages_input);
    }
}

function validate_doctor_image() {
    const image_input = document.getElementById("image");
    const image = image_input.value.trim();

    // Allowing file type
    var allowed_extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/;
    if (is_empty(image)) {
        return set_error_for(image_input, "Profile picture cannot be left blank");
    } else if (!allowed_extensions.exec(image)) {
        return set_error_for(image_input, "Only .jpg, .jpeg, .png and .gif files are allowed");
    } else if (image_input.files[0].size / 1024 / 1024 > 16) {
        return set_error_for(image_input, "Image size should not exceed 16 MiB");
    } else {
        return set_success_for(image_input);
    }
}

function validate_add_doctor() {
    var country = validate_country();
    var state = validate_state();
    var city = validate_city();
    var zip_code = validate_zip_code();
    var address_line_2 = validate_address_line_2();
    var address_line_1 = validate_address_line_1();
    var image = validate_doctor_image();
    var languages = validate_doctor_languages();
    var specialty = validate_doctor_specialty();
    var qualification = validate_doctor_qualification();
    var contact_number = validate_contact_number();
    var password = validate_password();
    var email = validate_email();
    var gender = validate_gender();
    var full_name = validate_full_name();
    const validation = [full_name, gender, email, password, contact_number, qualification, specialty, languages, image, address_line_1, address_line_2, zip_code, city, state, country];
    if (validation.includes(false)) {
        return false;
    } else {
        return true;
    }
}


function validate_doctor_edit_image() {
    const image_input = document.getElementById("image");
    const image = image_input.value.trim();

    // Allowing file type
    var allowed_extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/;
    if (!is_empty(image)) {

        // https://www.geeksforgeeks.org/file-type-validation-while-uploading-it-using-javascript/
        if (!allowed_extensions.exec(image)) {
            return set_error_for(image_input, "Only .jpg, .jpeg, .png and .gif files are allowed");
            
        // https://stackoverflow.com/questions/3717793/javascript-file-upload-size-validation
        } else if (image_input.files[0].size / 1024 / 1024 > 2) {
            return set_error_for(image_input, "Image size should not exceed 2 MiB");
        }
    }
    return set_success_for(image_input);
}

function validate_edit_doctor() {
    var country = validate_country();
    var state = validate_state();
    var city = validate_city();
    var zip_code = validate_zip_code();
    var address_line_2 = validate_address_line_2();
    var address_line_1 = validate_address_line_1();
    var image = validate_doctor_edit_image();
    var languages = validate_doctor_languages();
    var specialty = validate_doctor_specialty();
    var qualification = validate_doctor_qualification();
    var contact_number = validate_contact_number();
    var password = validate_password();
    var email = validate_email();
    var gender = validate_gender();
    var full_name = validate_full_name();
    const validation = [full_name, gender, email, password, contact_number, qualification, specialty, languages, image, address_line_1, address_line_2, zip_code, city, state, country];
    if (validation.includes(false)) {
        return false;
    } else {
        return true;
    }
}

// Appointment validation
function validate_appointment_doctor_name() {
    const doctor_name_input = document.getElementById("doctor-name");
    const doctor_name = doctor_name_input.value.trim();
    if (is_empty(doctor_name)) {
        return set_error_for(doctor_name_input, "Doctor name cannot be left blank");
    } else {
        return set_success_for(doctor_name_input);
    }
}

function validate_appointment_patient_name() {
    const patient_name_input = document.getElementById("patient-name");
    const patient_name = patient_name_input.value.trim();
    if (is_empty(patient_name)) {
        return set_error_for(patient_name_input, "Patient name cannot be left blank");
    } else {
        return set_success_for(patient_name_input);
    }
}

function validate_date() {
    const date_input = document.getElementById("appointment-date");
    const date = date_input.value.trim();
    if (is_empty(date)) {
        return set_error_for(date_input, "Date cannot be left blank");
    } else {
        return set_success_for(date_input);
    }
}

function validate_time() {
    const time_input = document.getElementById("appointment-time");
    const time = time_input.value.trim();
    if (is_empty(time)) {
        return set_error_for(time_input, "Time cannot be left blank");
    } else {
        return set_success_for(time_input);
    }
}

function validate_remarks() {
    const remarks_input = document.getElementById("remarks");
    const remarks = remarks_input.value.trim();
    if (!is_empty(remarks) && remarks.length > 500) {
        return set_error_for(remarks_input, "Remarks cannot exceed 500 words");
    } else {
        return set_success_for(remarks_input);
    }
}

function validate_add_appointment() {
    var remarks = validate_remarks();
    var time = validate_time();
    var date = validate_date();
    var patient_contact_number = validate_contact_number();
    var patient_name = validate_appointment_patient_name();
    var doctor_name = validate_appointment_doctor_name();
    const validation = [doctor_name, patient_name, patient_contact_number, date, time, remarks];
    if (validation.includes(false)) {
        return false;
    } else {
        return true;
    }
}

function validate_edit_appointment() {
    var time = validate_time();
    var date = validate_date();
    var validation = [date, time];
    if (validation.includes(false)) {
        return false;
    } else {
        return true;
    }
}

function validate_book_appointment() {
    var remarks = validate_remarks();
    var time = validate_time();
    var date = validate_date();
    var patient_contact_number = validate_contact_number();
    var patient_name = validate_appointment_patient_name();
    var validation = [patient_name, patient_contact_number, date, time, remarks];
    if (validation.includes(false)) {
        return false;
    } else {
        return true;
    }
}

function validate_inquiry() {
    const inquiry_input = document.getElementById("inquiry");
    const inquiry = inquiry_input.value.trim();
    if (is_empty(inquiry)) {
        return set_error_for(inquiry_input, "Inquiry cannot be left blank");
    } else {
        return set_success_for(inquiry_input);
    }
}

function validate_contact_us() {
    var inquiry = validate_inquiry();
    var contact_number = validate_contact_number();
    var email = validate_email();
    var full_name = validate_full_name();
    var validation = [full_name, email, contact_number, inquiry];
    if (validation.includes(false)) {
        return false;
    } else {
        return true;
    }
}