// Google maps
let map;
let markers = [];

// HashMap of images
const images = new Map();

images.set(0, "../images/first-aid-kit.svg");
images.set(1, "../images/emergency-telephone.svg");

/**
 * Initializes the map
 */
function initMap() {
    // McMaster coordinates: 43.262706332597624, -79.91890681273307
    var macLatlng = new google.maps.LatLng(43.262706332597624, -79.91890681273307);
    var mapOptions = {
        zoom: 16,
        center: macLatlng
    }

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // Initialize your new markers

    // First Aid Kit @ MUSC: 43.26350049157633, -79.91766767857462
    newMarker(43.26350049157633, -79.91766767857462, "First-Aid Kit Spot", 0,
        "<h2>First-Aid Kit Spot</h2>\n<p><a href='spot1.html'>Go to page!</a></p>");

    // First Aid Kit @ Mills: 43.26278765892196, -79.91766372192467
    newMarker(43.26278765892196, -79.91766372192467, "First-Aid Kit Spot", 0,
        "<h2>First-Aid Kit Spot</h2>\n<p><a href='spot1.html'>Go to page!</a></p>");

    // Emergency Telephone @ MUSC: 43.263422451519816, -79.91762002305562
    newMarker(43.263422451519816, -79.91762002305562, "Emergency Telephone Spot", 1,
        "<h2>First-Aid Kit Spot</h2>\n<p><a href='spot2.html'>Go to page!</a></p>");

    // Emergency Telephone @ Mills: 43.26276359358968, -79.91758481896233
    newMarker(43.26276359358968, -79.91758481896233, "Emergency Telephone Spot", 1,
        "<h2>First-Aid Kit Spot</h2>\n<p><a href='spot2.html'>Go to page!</a></p>");

    // First Aid Kit @ BSB: 43.26209985774714, -79.92019797028367
    newMarker(43.26209985774714, -79.92019797028367, "First-Aid Kit Spot", 0,
        "<h2>First-Aid Kit Spot</h2>\n<p><a href='spot1.html'>Go to page!</a></p>");

    // Add all the markers to the map
    showMarkers();
}

/**
 * Adds a new marker to the list of markers
 */
function newMarker(lat, lng, title, icon, text) {
    var marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        title: title,
        icon: images.get(icon),
    });

    // OnClick listener for markers
    google.maps.event.addListener(marker, 'click', function () {
        var infoWindow = new google.maps.InfoWindow({
            content: text
        });

        infoWindow.open(map, marker);
    });

    markers.push(marker);
}

/**
 * Adds all the markers to the map
 * @param map The map to setup all the markers on
 */
function setMapOnAll(map) {
    for (const marker of markers) {
        // Add the marker to the map
        marker.setMap(map);
    }
}

/**
 * Shows any markers currently in the array.
 */
function showMarkers() {
    setMapOnAll(map);
}

/**
 * Hides all the markers from the map, but keeps them in the array.
 */
function hideMarkers() {
    setMapOnAll(null);
}

/**
 * Deletes all markers in the array by removing references to them.
 */
function deleteMarkers() {
    hideMarkers();
    markers = [];
}

/**
 * Verifies location submission details
 */
const checkSubmission = (event) => {
    event.preventDefault();
    const elements = document.getElementById("form").elements;
    for (var i = 0; i < elements.length; i++) {
        var item = elements.item(i);
        if (item.name == "btn") break;
        if (item.name == "file" && item.files.length == 0)
            return alert(
                `${item.name} is required, please upload a file!`
            );
        if (!item.value)
            return alert(`${item.name} is required, please enter a value!`);

    }
    alert("You have successfully submitted a new emergency location!");
    window.location.reload();
};

/**
 * Verifies the user registration details
 */
const handleUserReg = (event) => {
    event.preventDefault();
    const elements = document.getElementById("userReg").elements;
    for (var i = 0; i < elements.length; i++) {
        var item = elements.item(i);
        if (item.name == "btn") break;
        if (item.name == 'Email') {
            if (!item.value.includes('@')) return alert('Email address invalid, please enter again')
        }
        if (item.name == 'Password' && (item.value.length < 8)) {
            return alert(`${item.name} has to be at least 8 characters!`);
        }
        if (!item.value)
            return alert(`${item.name} is required, please enter a value!`);
    }
    alert("You have successfully registered an account");
    window.location.reload();
};

/**
 * When the user scrolls down 20px from the top of the document, show the button
 */
window.onscroll = function () {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetop").style.display = "block";
    } else {
        document.getElementById("movetop").style.display = "none";
    }
}

/**
 * When the user clicks on the button, scroll to the top of the document
 */
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

/**
 * Searches for what the user inputted
 */
function search() {
    const searchInput = document.getElementById("searchInput");

    if (!searchInput.value)
        return alert(`${searchInput.name} is required, please enter a location in this format (latitude, longitude)`);
    else
        window.location = ("spots.html?" + searchInput.value);
}

/**
 * Gets user's location
 */
function getUserLocation() {
    navigator.geolocation.getCurrentPosition(onSuccess, onError);
}

/**
 * If user's location was retrieved successfully
 * @param position is the position of the user in (latitude, longitude) format.
 */
function onSuccess(position) {
    // Goes to the spots page with the coordinates of the user
    window.location = ("spots.html?" + "(" + position.coords.latitude + "," + position.coords.longitude + ")");
};

/**
 * If there is an error during user location retrieval
 * @param error
 */
function onError(error) {
    alert('Error: ' + error.message);
}

/**
 *
 */
async function getSpots() {
    let response = await fetch("../index.php?table=spots")
    if (response.ok) {
        alert("We reached Success");
        const result = response.text.toString;
        console.log(result);
        alert(result);

    } else {
        alert("HTTP-Error: " + response.status);
    }
}