beforeSubmit = function () {
    let city = document.getElementById("geoCity").value;
    let address = document.getElementById("geoAddress").value;
    let civic = document.getElementById("geoCnum").value;

    let completeAddress = address + " " + civic + " " + city;

    var geocodeOptions = {
        query: completeAddress,
        key: "m5upOBKh2ugQazsa72XgmQ7fFAuUxA9y",
    };
    // Look up the geocode of the given address
    tt.services.geocode(geocodeOptions).then(function (geocodeRes) {
        console.log(geocodeRes);
        var reverseOptions = {
            position: geocodeRes.results[0].position,
            key: "m5upOBKh2ugQazsa72XgmQ7fFAuUxA9y",
        };
        console.log(geocodeRes.results[0].position.lat);
        console.log(geocodeRes.results[0].position.lng);

        let lat = geocodeRes.results[0].position.lat;
        let lng = geocodeRes.results[0].position.lng;

        document.getElementById("longitudeHtml").value = lng;
        document.getElementById("latitudeHtml").value = lat;

        // with our geocode, do a reverse look-up to get our original address back
        /* tt.services.reverseGeocode(reverseOptions).then(function (reverseRes) { 
          console.log(reverseRes); 
      });  */
    });

    setTimeout(() => {
        document.getElementById("formid").submit();
    }, 1500);
};
