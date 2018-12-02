function initializeMap() {
    mymap = L.map('mapid').setView([34.982752818692, 33.137512207031], 10);
    mymap.on('click', onMapClick);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);

    $('.modal').on('hidden.bs.modal', function (e) {
        if ($('.modal').hasClass('in')) {
            $('body').addClass('modal-open');
        }
    });

    getCoordinates();
    document.getElementById('buttonCloseAdd').onclick = closeClickAdd;
    document.getElementById('buttonCloseProfile').onclick = closeClickProfile;
    document.getElementById('logout').onclick = logout;

}


function logout() {
    window.location = "index.html";
}

function closeClickAdd() {
    clearAddForm();
}

function closeClickProfile() {
    clearViewProfileForm();
}

function clearViewProfileForm() {
    $("#picture").attr("src", "img/no-image-available.png");
    $("#modal_name").val("");
    $("#modal_systemPower").val("");
    $("#modal_sensors").val("");
    $("#modal_annualPr").val("");
    $("#modal_COavoided").val("");
    $("#modal_reimbursement").val("");
    $("#modal_solarPanelModules").val("");
    $("#modal_azimuthAngle").val("");
    $("#modal_inclinationAngle").val("");
    $("#modal_communication").val("");
    $("#modal_date").val("");
    $("#modal_inverter").val("");
    $("#modal_address").val("");
    $("#modal_operator").val("");
    $("#modal_description").val("");
    $("#modal_corX").val("");
    $("#modal_corY").val("");
}

function onMarkerClick(ev) {

    $("#buttonDelete").show();
    $("#buttonAdd").hide();
    $("#buttonSave").hide();
    $("#buttonEdit").show();
    $("#pv_profile_modal").modal();


    var marker = ev.target;
    getPVInfo(marker.PVid);
    saveClick.PVid = marker.PVid;
    deleteClick.PVid = marker.PVid;
    deleteClick.marker = marker;
    document.getElementById('buttonDelete').onclick = deleteClick;
    document.getElementById('buttonEdit').onclick = editClick;
    document.getElementById('buttonSave').onclick = saveClick;
}

function deleteClick() {
    if (deleteClick.marker) { // check
        deleteAjax(deleteClick.PVid, deleteClick.marker);
    }
    $("#pv_profile_modal").modal('hide');
}

function saveClick() {

    if (!validateFormOnSubmit()) return;

    if (document.getElementById("file").files.length > 0) {

        encodeImageFileAsURL(document.getElementById("file"), function (e) {
            // use result in callback...
            var imageEnc = e.target.result;
            putAjax(imageEnc, saveClick.PVid)
        });
    } else {
        putAjax("", saveClick.PVid);
    }

    $("#myModal").modal('hide');
}

function editClick() {
    $("#myModal").modal();
    $("#pv_profile_modal").modal('hide');
    $("#buttonSave").show();

    $("#name").val($("#modal_name").text());
    $("#system_power").val($("#modal_systemPower").text());
    $("#sensors").val($("#modal_sensors").text());
    $("#annual_production").val($("#modal_annualPr").text());
    $("#CO2_avoided").val($("#modal_COavoided").text());
    $("#reimbursement").val($("#modal_reimbursement").text());
    $("#solar_panel_modules").val($("#modal_solarPanelModules").text());
    $("#azimuth_angle").val($("#modal_azimuthAngle").text());
    $("#inclination_angle").val($("#modal_inclinationAngle").text());
    $("#communication").val($("#modal_communication").text());
    $("#commission_date").val($("#modal_date").text());
    $("#inverter").val($("#modal_inverter").text());
    $("#address").val($("#modal_address").text());
    $("#operator").val($("#modal_operator").text());
    $("#message_text").val($("#modal_description").text());
}

function deleteAjax(pv_id, layer) {

    var element = {
        pv_id: pv_id
    }
    $.ajax({
        type: "DELETE", //rest Type
        dataType: 'json', //mispelled
        url: "http://52.26.216.32/cs425_fall18_hw04_tm03/api/delete.php",
        // dataType: "JSON", // data type expected from server
        data: JSON.stringify(element),
        async: true,
        contentType: "application/json; charset=utf-8",
        success: function (msg) {
            console.log(msg);
            mymap.removeLayer(layer); // remove
            swal("Good job!", "Delete Success!", "success");
        },
        error: function (err) {
            console.log('Error: ' + err);
            swal("Oops..", "Something went wrong!!", "error");
        }
    });

}

function putAjax(imageEnc, pv_id) {

    var element = [
        pv_id,
        ["pv_name", $("#name").val()],
        ["pv_power", $("#system_power").val()],
        ["pv_sensors", $("#sensors").val()],
        ["pv_annual_production", $("#annual_production").val()],
        ["pv_co2_avoided", $("#CO2_avoided").val()],
        ["pv_reimbursement", $("#reimbursement").val()],
        ["pv_solar_panel_module", $("#solar_panel_modules").val()],
        ["pv_azimuth_angl", $("#azimuth_angle").val()],
        ["pv_inclination_angl", $("#inclination_angle").val()],
        ["pv_communication", $("#communication").val()],
        ["pv_date", $("#commission_date").val()],
        ["pv_inverter", $("#inverter").val()],
        ["pv_address", $("#address").val()],
        ["encoded_image", imageEnc],
        ["pv_operator", $("#operator").val()],
        ["pv_description", $("#message_text").val()],
    ];
    console.log(JSON.stringify(element));

    $.ajax({
        type: "PUT", //rest Type
        dataType: 'json', //mispelled
        url: "http://52.26.216.32/cs425_fall18_hw04_tm03/api/update.php",
        async: true,
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(element),
        success: function (msg) {
            // addPointToMap(posX, posY, msg.pv_id);
            console.log(msg);
            swal("Good job!", "Change Success!", "success");
        },
        error: function (msg) {
            console.log('Error: ' + msg);
            swal("Oops..", "Something went wrong!!", "error");
        }
    });
}


function postAjax(imageEnc, posX, posY) {

    var element = {
        pv_name: $("#name").val(),
        pv_power: $("#system_power").val(),
        pv_sensors: $("#sensors").val(),
        pv_annual_production: $("#annual_production").val(),
        pv_co2_avoided: $("#CO2_avoided").val(),
        pv_reimbursement: $("#reimbursement").val(),
        pv_solar_panel_module: $("#solar_panel_modules").val(),
        pv_azimuth_angl: $("#azimuth_angle").val(),
        pv_inclination_angl: $("#inclination_angle").val(),
        pv_communication: $("#communication").val(),
        pv_date: $("#commission_date").val(),
        pv_inverter: $("#inverter").val(),
        pv_address: $("#address").val(),
        pv_coordinate_x: posX,
        pv_coordinate_y: posY,
        encoded_image: imageEnc,
        pv_operator: $("#operator").val(),
        pv_description: $("#message_text").val()
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
            addPointToMap(posX, posY, msg.pv_id);
            console.log(msg);
            swal("Good job!", "Added Success!", "success");
        }
    });
}

function clearAddForm() {

    $("#picture").attr("src", "img/no-image-available.png");
    $("#name").val("");
    $("#system_power").val("");
    $("#sensors").val("");
    $("#annual_production").val("");
    $("#CO2_avoided").val("");
    $("#reimbursement").val("");
    $("#solar_panel_modules").val("");
    $("#azimuth_angle").val("");
    $("#inclination_angle").val("");
    $("#communication").val("");
    $("#commission_date").val("");
    $("#inverter").val("");
    $("#address").val("");
    $("#operator").val("");
    $("#message_text").val("");
}

function addClick() {

    if (!validateFormOnSubmit()) return;
    
    if (document.getElementById("file").files.length > 0) {

        encodeImageFileAsURL(document.getElementById("file"), function (e) {
            // use result in callback...
            var imageEnc = e.target.result;

            postAjax(imageEnc, addClick.posX, addClick.posY);
        });
    } else {
        postAjax("", addClick.posX, addClick.posY);
    }

    $("#myModal").modal('hide');
}

function onMapClick(ev) {

    clearAddForm();
    $("#buttonDelete").hide();
    $("#buttonAdd").show();
    $("#buttonSave").hide();
    $("#buttonEdit").hide();
    $("#myModal").modal();

    var latlng = mymap.mouseEventToLatLng(ev.originalEvent);
    addClick.posX = latlng.lat;
    addClick.posY = latlng.lng;
    document.getElementById('buttonAdd').onclick = addClick;
}


function getCoordinates() {

    $.ajax({
        type: 'GET',
        async: true,
        url: 'http://52.26.216.32/cs425_fall18_hw04_tm03/api/read.php',
        dataType: "JSON", // data type expected from server
        success: callback,
        error: function (msg) {
            console.log('Error: ' + msg);
            swal("Oops..", "Something went wrong!!", "error");
        }
    });
}

function callback(response) {
    showCoordinatesToTheMap(response);
}

function getPVInfo(id) {

    $.ajax({
        type: 'GET',
        url: 'http://52.26.216.32/cs425_fall18_hw04_tm03/api/read_single.php',
        dataType: "JSON", // data type expected from server
        data: {
            pv_id: id
        },
        success: function (element) { //JSON.stringify(element)
            // console.log("PV content:" + JSON.stringify(msg));
            parseDataToForm(element);

        },
        error: function (msg) {
            console.log('Error: ' + msg);
            swal("Oops..", "Something went wrong!!", "error");
        }
    });
}

function showCoordinatesToTheMap(data) {

    try {
        for (var k in data) {
            addPointToMap(data[k].pv_coordinate_x, data[k].pv_coordinate_y, data[k].pv_id);
        }
    } catch (err) {

    }

    // if (data != null ){
    //     data.forEach(function (entry) {
    //         if (entry) addPointToMap(entry.pv_coordinate_x, entry.pv_coordinate_y,  entry.pv_id);
    //         // console.log("(" + entry.pv_coordinate_x + " , " + entry.pv_coordinate_y + ") --> " + marker.PVid);
    //     });
    // }
}

function addPointToMap(posX, posY, id) {
    var marker = L.marker([posX, posY]);
    marker.PVid = id;
    marker.addTo(mymap).on('click', onMarkerClick);
}

function encodeImageFileAsURL(element, onLoadCallback) {

    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = onLoadCallback;
    reader.readAsDataURL(file);
}


function parseDataToForm(element) {

    if (element.pv_photo.length > 0) $("#picture").attr("src", "http://52.26.216.32/cs425_fall18_hw04_tm03/resources/" + element.pv_photo);
    else $("#picture").attr("src", "img/no-image-available.png");
    $("#modal_name").text(element.pv_name);
    $("#modal_systemPower").text(element.pv_power);
    $("#modal_sensors").text(element.pv_sensors);
    $("#modal_annualPr").text(element.pv_annual_production);
    $("#modal_COavoided").text(element.pv_co2_avoided);
    $("#modal_reimbursement").text(element.pv_reimbursement);
    $("#modal_solarPanelModules").text(element.pv_solar_panel_module);
    $("#modal_azimuthAngle").text(element.pv_azimuth_angl);
    $("#modal_inclinationAngle").text(element.pv_inclination_angl);
    $("#modal_communication").text(element.pv_communication);
    $("#modal_date").text(element.pv_date);
    $("#modal_inverter").text(element.pv_inverter);
    $("#modal_description").text(element.pv_description);
    $("#modal_corX").text(element.pv_coordinate_x);
    $("#modal_corY").text(element.pv_coordinate_y);
    $("#modal_address").text(element.pv_address);
    $("#modal_operator").text(element.pv_operator);
}

window.onload = initializeMap;
