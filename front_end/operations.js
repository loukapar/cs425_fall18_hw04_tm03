function initializeMap() {
    mymap = L.map('mapid').setView([51.505, -0.09], 13);
    mymap.on('click', onMapClick);

    // mymap.on('mousemove', hoverTheMap);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);

    L.marker([51.5, -0.09]).addTo(mymap).on('click', onMarkerClick);

    
    $('.modal').on('hidden.bs.modal', function (e) {
        if($('.modal').hasClass('in')) {
        $('body').addClass('modal-open');
        }    
    });

    // console.log(latlng.lat + ', ' + latlng.lng);

}

function hoverTheMap(ev){
    var latlng = mymap.mouseEventToLatLng(ev.originalEvent);
    L.marker([latlng.lat, latlng.lng]).addTo(mymap).bindPopup(latlng.lat + ', ' + latlng.lng).openPopup();
}

function onMarkerClick() {
    
    $("#buttonDelete").show();
    $("#buttonAdd").hide();
    $("#buttonSave").hide();
    $("#buttonEdit").show();
    $("#pv_profile_modal").modal();

    document.getElementById('buttonDelete').onclick = deleteClick;
    document.getElementById('buttonEdit').onclick = editClick;
    // disableAllElementsInForm(true);

}

function deleteClick(){
    
}

function editClick(){
    $("#myModal").modal();
    $("#pv_profile_modal").modal('hide');
    $("#buttonSave").show();

}

function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);

    console.log(params);

    return xhr;
}


function saveClick(){
    
}

function addClick(){


    // document.getElementById("name").value;
    // document.getElementById("system_power").value;
    // document.getElementById("sensors").value;
    // document.getElementById("annual_production").value;
    // document.getElementById("CO2_avoided").value;
    // document.getElementById("reimbursement").value;
    // document.getElementById("solar_panel_modules").value;
    // document.getElementById("azimuth_angle").value;
    // document.getElementById("inclination_angle").value;
    // document.getElementById("communication").value;
    // document.getElementById("commission_date").value;
    // document.getElementById("inverter").value;
    // document.getElementById("file").value;
    // document.getElementById("message_text").value;

    var element = {
        pv_name : $("#name").val(),
        pv_power : -1, // $("#system_power").val(),
        pv_sensor : $("#sensors").val(),
        pv_annual_production : -1, // $("#annual_production").val(),
        pv_co2_avoided : -1, //$("#CO2_avoided").val(),
        pv_reimbursement : -1, // $("#reimbursement").val(),
        pv_solar_panel_module : $("#solar_panel_modules").val(),
        pv_azimuth_ang1 : $("#azimuth_angle").val(),
        pv_inclination_angl : $("#inclination_angle").val(),
        pv_communication : $("#communication").val(),
        // pv_date :  null, //$("#commission_date").val(),
        pv_inverter : $("#inverter").val(),
        pv_address : "",
        pv_coordinate_x : -1,
        pv_coordinate_y: -1,
        pv_operator : "",
        // $("#file").val(),
        pv_description : $("#message_text").val()
    };

    console.log(JSON.stringify(element));

    $.ajax({
        type: "POST", //rest Type
        dataType: 'json', //mispelled
        url: "http://52.26.216.32/cs425_fall18_hw04_tm03/api/create.php",
        async: true,
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(element),
        success: function (msg) {
            console.log(msg);                
        }
    });

    // postAjax('http://52.26.216.32/cs425_fall18_hw04_tm03/api/create.php', { pv_name: "name1", pv_address: "address1", pv_coordinate_x:"", pv_coordinate_y:"", pv_operator:"", pv_date:"", pv_description:"description", pv_power:"", pv_annual_production:"", pv_co2_avoided:"", pv_reimbursement:"", pv_solar_panel_module:"", pv_azimuth_ang1:"", pv_inclination_angl:"", pv_communication:"", pv_inverter:"", pv_sensor:"" }, function(data){ console.log(data); });
    $("#myModal").modal('hide');
}

function onMapClick(ev){

    $("#buttonDelete").hide();
    $("#buttonAdd").show();
    $("#buttonSave").hide();
    $("#buttonEdit").hide();
    $("#myModal").modal();

    var latlng = mymap.mouseEventToLatLng(ev.originalEvent);
    coordx = latlng.lat;
    coordy = latlng.lng;

    document.getElementById('buttonAdd').onclick = addClick;
}


window.onload = initializeMap;