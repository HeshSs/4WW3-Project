// Google maps
let map;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        // McMaster coordinates: 43.262706332597624, -79.91890681273307
        center: { lat: 43.262706332597624, lng: -79.91890681273307 },
        zoom: 16.5,
    });
}