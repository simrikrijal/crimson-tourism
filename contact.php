<?php
$title = "Contact Us";
$active_contact = "active_page";
require 'include/head.php';
require 'include/header.php';
?>

<div class="container-fluid" style="margin-top: 60px; margin-bottom: 0px;">
<div class="map-contact" id="map-contact"></div>
</div>

<?php
require 'include/footer.php';
?>

<script>
    function initMap() {
        var uluru = {lat: 27.689302, lng: 85.322551 };
        var map = new google.maps.Map(document.getElementById('map-contact'), {
            zoom: 18,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0jh5EMPz84XDCWq2wIJ1x32hOMoxa1UQ&callback=initMap">
</script>

<?php
require 'include/footer_js.php';
?>  
