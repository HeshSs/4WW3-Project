// Google maps
let map;
let markers = [];
// HashMap of images
const images = new Map();

images.set(0, "../images/first-aid-kit.svg");
images.set(1, "../images/emergency-telephone.svg");

// Map initializer
function initMap() {
    // McMaster coordinates: 43.262706332597624, -79.91890681273307
    var macLatlng = new google.maps.LatLng(43.262706332597624,-79.91890681273307);
    var mapOptions = {
        zoom: 16,
        center: macLatlng
    }

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // Initialize your new markers

    // First Aid Kit @ MUSC: 43.26350049157633, -79.91766767857462
    newMarker(43.26350049157633, -79.91766767857462, "First-Aid Kit Spot", 0);

    // First Aid Kit @ Mills: 43.26278765892196, -79.91766372192467
    newMarker(43.26278765892196, -79.91766372192467, "First-Aid Kit Spot", 0);

    // Emergency Telephone @ MUSC: 43.263422451519816, -79.91762002305562
    newMarker(43.263422451519816, -79.91762002305562, "Emergency Telephone Spot", 1);

    // Emergency Telephone @ Mills: 43.26276359358968, -79.91758481896233
    newMarker(43.26276359358968, -79.91758481896233, "Emergency Telephone Spot", 1);

    // First Aid Kit @ BSB: 43.26209985774714, -79.92019797028367
    newMarker(43.26209985774714, -79.92019797028367, "First-Aid Kit Spot", 0);

    // Add all the markers to the map
    showMarkers();
}

/**
 * Adds a new marker to the list of markers
 */
function newMarker(lat, lng, title, icon) {
    var marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        title: title,
        icon: images.get(icon)
    });

    markers.push(marker);
}

/**
 * Adds all the markers to the map
 */
function setMapOnAll(map) {
    for (const marker of markers) {
        marker.setMap(map)
    }
}

// Shows any markers currently in the array.
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