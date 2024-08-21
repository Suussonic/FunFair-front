function filterAttractions() {
  const filterValue = parseInt(document.getElementById("ageFilter").value);
  const attractions = document.querySelectorAll(".attraction-item");

  attractions.forEach((attraction) => {
    const attractionAge = parseInt(attraction.getAttribute("data-age"));
    if (isNaN(filterValue) || attractionAge == filterValue) {
      attraction.style.display = "block";
    } else {
      attraction.style.display = "none";
    }
  });
}
