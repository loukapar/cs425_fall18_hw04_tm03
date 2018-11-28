function initializeMap() {
    mymap = L.map('mapid').setView([51.505, -0.09], 13);
    mymap.on('click', onMapClick);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);

    L.marker([51.5, -0.09]).addTo(mymap).on('click', onMarkerClick);

}

function onMarkerClick(e) {
    
    // var x = document.getElementById("buttonSave");
    // x.style.visibility = 'invisible';
    
    // x = document.getElementById("buttonDelete");
    // x.style.visibility = 'visible';

    // x = document.getElementById("buttonAdd");
    // x.style.visibility = 'visible';

    $("#buttonDelete").hide();
    $("#buttonAdd").hide();
    $("#buttonSave").hide();
    $("#buttonSave").hide();

    $("#myModal").modal();
}

function onMapClick(){

    var x = document.getElementById("buttonSave");
    x.style.visibility = 'visible';

    $("#myModal").modal();
}


window.onload = initializeMap;