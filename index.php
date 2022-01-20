<?php
include_once "includes/header.php";
?>
<article>
    <div class="banner">
        <img class="slides" src="images/banner1.jpg" alt="custom_html_banner1" style="width: 100%" />
        <img class="slides" id="slide2" src="images/banner2.jpg" alt="custom_html_banner2" style="width: 100%" />
        <img class="slides" id="slide3" src="images/banner3.jpg" alt="custom_html_banner3" style="width: 100%" />
        <button class="slides-button display-left" onclick="plusDivs(-1)">
            &#10094;
        </button>
        <button class="slides-button display-right" onclick="plusDivs(1)">
            &#10095;
        </button>
        <section id="history">
            <div class="container">
                <img src="images/history_bg.jpg" alt="history background" id="history-background">
                <div id="history-details">
                    <h2 class="text-center">“Everyone deserves to SMILE”</h2>
                    <div id="history-paragraph" class="text-center">
                        <p>
                            MediLife Healthcare Centre has been delivering healthcare services in Malaysia for more than
                            two decades now and we strive to continue providing dependable and economical medical
                            services. Being the medical care department for Elderly Home’s Club, we are a non-profit
                            organization that offers healthcare needs to senior citizens who are struggling to get by.
                        </p>
                        <br>
                        <p>
                            In addition, with our value-added services, we also actively promote the notion of
                            preventive and routine check-ups with our doctors to ensure improved health, wellness, and
                            lifestyle for our clients' happiness and their families.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="why-us">
            <div class="text-center">
                <h1>Why Choose Us?</h1>
                <p>Our team of doctors are dedicated to offer the best patient care by providing high-quality healthcare
                    services, cutting-edge technology, and state-of-the-art facilities, ensuring the best possible
                    treatment for the elders.</p>
            </div>
        </section>

        <section id="our-facilities" class="text-center">
            <h1>Our Facilities</h1>
            <div id="facilities">
                <img src="images/facility1.jpg" alt="facility1">
                <img src="images/facility2.jpg" alt="facility2">
                <img src="images/facility3.jpg" alt="facility3">
            </div>
        </section>

    </div>
</article>

<?php
include_once "includes/footer.php";
?>
<?php
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    echo "<script>window.onload = function() {alert('" . $_SESSION['message'] . "')};</script>";
    unset($_SESSION['login']);
    unset($_SESSION['message']);
}
?>