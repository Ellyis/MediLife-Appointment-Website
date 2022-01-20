$(document).ready(function() {

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate()+1);
    var month = tomorrow.getMonth() + 1;
    var day = tomorrow.getDate();
    var year = tomorrow.getFullYear();

    // Check if today is the last day of the year

    if (month < 10) {
        month = "0" + month.toString();
    }
    if (day < 10) {
        day = "0" + day.toString();
    }

    
    //Disable previous date
    var minDate = year + "-" + month + "-" + day;
    $("#appointment-date").attr("min", minDate);



    const patient = document.getElementById("patient-name");
    patient.addEventListener("change", function(e) {
        var patient_id = patient.value.split(":")[0];
        $("#contact-field").load("load_contact_number.php", {
            patient_id: patient_id
        });
    });

    // https://pretagteam.com/question/disable-weekends-on-html-5-input-type-date
    const calendar = document.getElementById("appointment-date");
    calendar.addEventListener("input", function(e) {
        const doctor = document.getElementById("doctor-name");
        var doctor_id = doctor.value;
        if (doctor_id) {
            var date = new Date(this.value).toLocaleDateString();
            var day = new Date(this.value).getUTCDay();
            var sunday = 0;
            if([sunday].includes(day)){
                e.preventDefault();
                this.value = "";
                alert("Appointment on Sunday is not allowed");
            } else {
                $("#appointment-time").load("add_time_slot.php", {
                    doctor_id: doctor_id,
                    date: date,
                    day: day
                });
            } 
        } else {
            alert("Please select a doctor first");
            calendar.value = "";
        }
    });
});