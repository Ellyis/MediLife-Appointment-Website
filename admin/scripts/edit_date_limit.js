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

    const calendar = document.getElementById("appointment-date");
    var date = new Date(calendar.value).toLocaleDateString();
    var day = new Date(calendar.value).getUTCDay();
    $("#appointment-time").load("admin_time_slot.php", {
        date: date,
        day: day
    });

    // https://pretagteam.com/question/disable-weekends-on-html-5-input-type-date
    calendar.addEventListener("input", function(e) {
        var date = new Date(this.value).toLocaleDateString();
        var day = new Date(this.value).getUTCDay();
        var sunday = 0;
        if([sunday].includes(day)){
            e.preventDefault();
            this.value = "";
            alert("Appointment on Sunday is not allowed");
        } else {
            $("#appointment-time").load("admin_time_slot.php", {
                date: date,
                day: day
            });

        }
    });

});