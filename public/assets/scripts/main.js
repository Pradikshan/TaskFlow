document.addEventListener("DOMContentLoaded", function () {
    const colorBadge = document.querySelectorAll(".badge-color");

    colorBadge.forEach(function (badge) {
        const badgeText = badge.innerText.trim();
        switch (badgeText) {
            case "Low priority":
                badge.classList.add("text-bg-primary");
                break;
            case "Medium priority":
                badge.classList.add("text-bg-warning");
                break;
            case "High priority":
                badge.classList.add("text-bg-danger");
                break;
            default:

                break;
        }
    });
});

document.getElementById("addSubtask").addEventListener("click", function() {
    // Create a new subtask item
    const subtasksList = document.getElementById("subtasks");
    const newSubtaskItem = document.createElement("li");
    
    // Create an input element
    const input = document.createElement("input");
    input.type = "text";
    input.name = "subtasks[]";
    input.className = "form-control";
    input.placeholder = "Subtask";

    // Append the input element to the new subtask item
    newSubtaskItem.appendChild(input);

    // Append the new subtask item to the list
    subtasksList.appendChild(newSubtaskItem);
});






// function initMap() {
//     document.addEventListener("DOMContentLoaded", function () {
//     const locationInput = document.getElementById('locationInput');
//     const getLocationButton = document.getElementById('getLocationButton');

//     getLocationButton.addEventListener('click', function () {
//         if ("geolocation" in navigator) {
//             navigator.geolocation.getCurrentPosition(function (position) {
//                 const latitude = position.coords.latitude;
//                 const longitude = position.coords.longitude;

//                 // Create a Geocoder instance
//                 const geocoder = new google.maps.Geocoder();

//                 // Create a LatLng object
//                 const latlng = new google.maps.LatLng(latitude, longitude);

//                 // Perform reverse geocoding to get the location name
//                 geocoder.geocode({ 'location': latlng }, function (results, status) {
//                     if (status === google.maps.GeocoderStatus.OK) {
//                         if (results[0]) {
//                             const locationName = results[0].formatted_address;
//                             locationInput.value = locationName;

//                             localStorage.setItem('userLocation', locationName);
//                         } else {
//                             alert('No location found');
//                         }
//                     } else {
//                         alert('Geocoder failed due to: ' + status);
//                     }
//                 });
//             }, function (error) {
//                 switch (error.code) {
//                     case error.PERMISSION_DENIED:
//                         alert("User denied the request for Geolocation.");
//                         break;
//                     case error.POSITION_UNAVAILABLE:
//                         alert("Location information is unavailable.");
//                         break;
//                     case error.TIMEOUT:
//                         alert("The request to get user location timed out.");
//                         break;
//                     case error.UNKNOWN_ERROR:
//                         alert("An unknown error occurred.");
//                         break;
//                 }
//             });
//         } else {
//             alert("Geolocation is not supported by this browser.");
//         }
//     });
// });
// }

function initMap() {
    document.addEventListener("DOMContentLoaded", function () {
        const locationInput = document.getElementById('locationInput');
        const getLocationButton = document.getElementById('getLocationButton');

        // Check if location is already in LocalStorage
        const savedLocation = localStorage.getItem('userLocation');
        if (savedLocation) {
            locationInput.value = savedLocation;
        }

        getLocationButton.addEventListener('click', function () {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Create a Geocoder instance
                    const geocoder = new google.maps.Geocoder();

                    // Create a LatLng object
                    const latlng = new google.maps.LatLng(latitude, longitude);

                    // Perform reverse geocoding to get the location name
                    geocoder.geocode({ 'location': latlng }, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                const locationName = results[0].formatted_address;
                                locationInput.value = locationName;

                                // Save the location in LocalStorage
                                localStorage.setItem('userLocation', locationName);
                            } else {
                                alert('No location found');
                            }
                        } else {
                            alert('Geocoder failed due to: ' + status);
                        }
                    });
                }, function (error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            alert("User denied the request for Geolocation.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("Location information is unavailable.");
                            break;
                        case error.TIMEOUT:
                            alert("The request to get user location timed out.");
                            break;
                        case error.UNKNOWN_ERROR:
                            alert("An unknown error occurred.");
                            break;
                    }
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });
    });
}








