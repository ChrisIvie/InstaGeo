

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(savePosition, positionError, {timeout:10000});
    } else {
        //Geolocation is not supported by this browser
    }
}

// handle the error here
function positionError(error) {
    var errorCode = error.code;
    var message = error.message;

    alert(message);
}





function savePosition(position) {
          // Creating a variable so i can include the =
          var location = "location=";
          // Another variable with encodeURIComponent so its a clean URL.
          var lat_clean = encodeURIComponent(position.coords.latitude);
          var lng_clean = encodeURIComponent(position.coords.longitude);
          // Setting the URL variable to avoid mix ups during the redirect
          var url = "results.php?"+ location + lat_clean + "+" + lng_clean;

          //Used this URL for console.log, still going to keep it here just in case
          var instagramURL = "https://api.instagram.com/v1/media/search?lat="+lat_clean+
            "&lng="+lng_clean+"&client_id=4173458cee254a64b15ba24f9e5a40fc";

          document.write('Loading..');
          window.location = url;

          //var InstaData = JSON.parse(instagramURL);
          //var results = document.getElementById("results");
          //results.innerHTML = InstaData.link;

          //console.log(instagramURL);

//This is something I worked on for getting someones current location, still doesn't work but I might come back to it later.
}
