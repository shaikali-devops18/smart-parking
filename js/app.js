let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 17.3850, lng: 78.4867 }, // Example: Hyderabad
    zoom: 14,
  });

  // Dummy parking spots
  const parkingSpots = [
    { lat: 17.385044, lng: 78.486671, title: "Parking Lot 1" },
    { lat: 17.391044, lng: 78.481671, title: "Parking Lot 2" },
    { lat: 17.380044, lng: 78.490671, title: "Parking Lot 3" },
  ];

  parkingSpots.forEach(spot => {
    new google.maps.Marker({
      position: { lat: spot.lat, lng: spot.lng },
      map,
      title: spot.title,
    });
  });
}