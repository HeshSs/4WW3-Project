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
    var macLatlng = new google.maps.LatLng(43.262706332597624, -79.91890681273307);
    var mapOptions = {
        zoom: 16,
        center: macLatlng
    }

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // Get the spots
    let spots;

    var query = window.location.href.split('?q=')[1];

    // Check if a search is queried
    if (query !== undefined) {
        query = query.replaceAll('%20', ' ');

        querySpots(query).then(function(response) {
            spots = response;

            // Initialize your new markers
            for (let i = 0; i < spots.length; i++) {
                var spot_info = spots[i].split(",");
                console.log(spot_info[0]);


                newMarker(parseFloat(spot_info[1]), parseFloat(spot_info[2]), spot_info[0], parseInt(spot_info[3]),
                `<h2>${i + 1}. ${spot_info[0]}</h2>\n<p><a href='spot.html?q=(${spot_info[1].replaceAll(' ', '')}, ${spot_info[2].replaceAll(' ', '')})'>Go to page!</a></p>`);
            }
            // Add all the markers to the map
            if (markers.length > 0) 
                showMarkers();
        });
    } else {
        getSpots().then(function(response) {
            spots = response;

            // Initialize your new markers
            for (let i = 0; i < spots.length; i++) {
                var spot_info = spots[i].split(",");

                newMarker(parseFloat(spot_info[1]), parseFloat(spot_info[2]), spot_info[0], parseInt(spot_info[3]),
                `<h2>${i + 1}. ${spot_info[0]}</h2>\n<p><a href='spot.html?q=(${spot_info[1].replaceAll(' ', '')}, ${spot_info[2].replaceAll(' ', '')})'>Go to page!</a></p>`);
            }
            // Add all the markers to the map
            if (markers.length > 0) 
                showMarkers();
        });
    }

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
        window.location = ("spots.html?q=" + searchInput.value);
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
    window.location = ("spots.html?q=" + "(" + position.coords.latitude + "," + position.coords.longitude + ")");
};

/**
 * If there is an error during user location retrieval
 * @param error
 */
function onError(error) {
    alert('Error: ' + error.message);
}

/**
 * @returns All the spots in the database in a JSON array
 */
function getSpots() {
    return $.ajax({
        url: '../index.php?table=spots',
        // url: `../spots.txt`,
        dataType: 'JSON'
      });
}

/**
 * @returns All the spots in the database that contain the string or coordinates in a JSON array
 */
function querySpots(string) {
    return $.ajax({
        url: `../index.php?q=${string}`,
        // url: `../spots.txt`,
        dataType: 'JSON'
      });
}