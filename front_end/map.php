<?php require_once('../api/authentication.php'); ?>

<!DOCTYPE html>
<html>

<head>

    <title>Quick Start - Leaflet</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" /> -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
        crossorigin=""></script>

    <link rel="stylesheet" href="styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="operations.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body>

    <a href="#" class="btn btn-info btn-lg content" id="logout">
        <span class="glyphicon glyphicon-log-out"></span> Log out
    </a>

    <div id="mapid" class="map"></div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add PV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="system_power" class="col-form-label">System Power:</label>
                            <input type="number" class="form-control" id="system_power">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="sensors" class="col-form-label">Sensors:</label>
                            <input type="text" class="form-control" id="sensors">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="annual_production" class="col-form-label">Annual production:</label>
                            <input type="number" class="form-control" id="annual_production">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="CO2_avoided" class="col-form-label">CO2 avoided:</label>
                            <input type="number" class="form-control" id="CO2_avoided">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="reimbursement" class="col-form-label">Reimbursement:</label>
                            <input type="number" class="form-control" id="reimbursement">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="solar_panel_modules" class="col-form-label">Solar panel modules:</label>
                            <input type="text" class="form-control" id="solar_panel_modules">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="azimuth_angle" class="col-form-label">Azimuth angle:</label>
                            <input type="text" class="form-control" id="azimuth_angle">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inclination_angle" class="col-form-label">Inclination angle:</label>
                            <input type="text" class="form-control" id="inclination_angle">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="communication" class="col-form-label">Communication:</label>
                            <input type="text" class="form-control" id="communication">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="commission_date" class="col-form-label">Commission date:</label>
                            <input type="date" class="form-control" id="commission_date">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inverter" class="col-form-label">Inverter:</label>
                            <input type="text" class="form-control" id="inverter">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="operator" class="col-form-label">Operator:</label>
                            <input type="text" class="form-control" id="operator">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="address" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" id="address">
                        </div>

                        <div class="form-group" style="margin-left:10px; margin-right: 10px">
                            <label class="custom-file">
                                <label for="custom-file-input" class="col-form-label">Upload:</label>
                                <input type="file" id="file" class="custom-file-input">
                                <span class="custom-file-control"></span>
                            </label>
                        </div>

                        <div class="form-group" style="margin-left:10px; margin-right: 10px">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="message_text"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button id="buttonCloseAdd" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="buttonSave" type="button" class="btn btn-primary">Save</button>
                    <button id="buttonAdd" type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="pv_profile_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!--Body-->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-3">
                            <p></p>
                            <p class="text-center"><img src="img/no-image-available.png" class="img-rounded" alt="Cinque Terre"
                                    id="picture" width="60%" height="200px"></p>
                            <!-- img/image.jpg -->
                        </div>

                        <div class="col-9 pv_view_form">
                            <p>
                                <span class="column_left"><b>Name:</b></span>
                                <span id="modal_name" class="column_right"></span>
                            </p>
                            <p>
                                <span><b>System Power:</b></span>
                                <span id="modal_systemPower"></span>
                            </p>

                            <p>
                                <span><b>Sensors:</b></span>
                                <span id="modal_sensors"></span>
                            </p>

                            <p>
                                <span><b>Annual Production:</b></span>
                                <span id="modal_annualPr"></span>
                            </p>

                            <p>
                                <span><b>CO2 avoided:</b></span>
                                <span id="modal_COavoided"></span>
                            </p>

                            <p>
                                <span><b>Reimbursement:</b></span>
                                <span id="modal_reimbursement"></span>
                            </p>
                            <p>
                                <span><b>Solar panel modules:</b></span>
                                <span id="modal_solarPanelModules"></span>
                            </p>
                            <p>
                                <span><b>Azimuth angle:</b></span>
                                <span id="modal_azimuthAngle"></span>
                            </p>
                            <p>
                                <span><b>Inclination angle:</b></span>
                                <span id="modal_inclinationAngle"></span>
                            </p>

                            <p>
                                <span><b>Communication:</b></span>
                                <span id="modal_communication"></span>
                            </p>

                            <p>
                                <span><b>Commission Date:</b></span>
                                <span id="modal_date"></span>
                            </p>

                            <p>
                                <span><b>Inverter:</b></span>
                                <span id="modal_inverter"></span>
                            </p>

                            <p>
                                <span><b>Description:</b></span>
                                <span id="modal_description"></span>
                            </p>
                            <p>
                                <span><b>Location:</b></span>
                            </p>
                            <p>
                                <span><b>Coordinates:</b></span>
                                X : <span id="modal_corX"></span>
                                Y : <span id="modal_corY"></span>
                            </p>

                            <p>
                                <span><b>Address:</b></span>
                                <span id="modal_address"></span>
                            </p>

                            <p>
                                <span><b>Operator:</b></span>
                                <span id="modal_operator"></span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button id="buttonCloseProfile" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="buttonEdit" type="button" class="btn btn-primary">Edit</button>
                    <button id="buttonDelete" type="button" class="btn btn-primary">Delete</button>
                </div>

            </div>
        </div>


</body>

</html>