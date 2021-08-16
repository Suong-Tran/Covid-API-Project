function initMap() {
    let humberMap, marker;
    let humberAddr = document.getElementById('currentLocation').value;

    humberMap = new google.maps.Map(
        document.getElementById("map"),
        {
            zoom: 16
        }
    );

    let gcoder = new google.maps.Geocoder();

    gcoder.geocode(
        //request
        { address: humberAddr },
        //callback function
        function (results, status) {
            //console.log(results);
            //console.log(status);
            if (status == 'OK') {
                //if successfully geocoded
                //console.log(results[0]);
                humberMap.setCenter(results[0].geometry.location);

                marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: humberMap,
                });
            }
        }
    );

}