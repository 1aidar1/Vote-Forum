<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</head>

<body>
    <style>
        label+p {
            color: darkgrey;
            font-size: 1em;
        }

        label {
            margin: 0px;
            font-size: 1.3em;
        }

        .container>.row {
            display: flex;
            align-items: center;
        }

        #btn-logout:hover {
            cursor: pointer;
        }
    </style>
    <div class="container">
        <?php
        include 'SignedHeader.php';
        ?>
        <div class="row">
            <h1>Account Settings</h1>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label for="">UIN</label>
                <p id="account-UIN">12345678</p>
            </div>
            <div class="col-md-2">
                <button id='btn-change-UIN' class="btn btn-info">Change</button>
            </div>
        </div>
        <!-- Modal Change UIN-->
        <div id="change-UIN-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b>Change UIN</b></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="New UIN" id='new-UIN' required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-submit-UIN" data-dismiss="modal"
                            class="btn btn-light">Submit</button>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="">Handle</label>
                <p id="account-handle">Username</p>
            </div>
            <div class="col-md-2">
                <button id='btn-change-handle' class="btn btn-info">Change</button>
            </div>
        </div>
        <!-- Modal Change Handle-->
        <div id="change-handle-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b>Change Handle</b></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="New Handle" id='new-handle' required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-submit-handle" data-dismiss="modal"
                            class="btn btn-light">Submit</button>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="">Password</label>
                <p id="account-password">*******</p>
            </div>
            <div class="col-md-2">
                <button id='btn-change-password' class="btn btn-info">Change</button>
            </div>
        </div>
        <!-- Modal Change Password-->
        <div id="change-password-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b>Change Password</b></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="New Password" id='new-password' required>
                        <br>
                        <input type="text" class="form-control" placeholder="Confirm Password" id='confirm-password'
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-submit-password" data-dismiss="modal"
                            class="btn btn-light">Submit</button>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="">Cell</label>
                <p id="account-cell">12345678910</p>
            </div>
            <div class="col-md-2">
                <button id='btn-change-tel' class="btn btn-info">Change</button>
            </div>
        </div>
        <!-- Modal Change Tel-->
        <div id="change-tel-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b>Change Cell</b></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="New Cell" id='new-tel' required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-submit-tel" data-dismiss="modal"
                            class="btn btn-light">Submit</button>
                    </div>
                </div>

            </div>
        </div>

</body>
<script>
    $('#btn-change-UIN').click(() => {
        $('#change-UIN-modal').modal('show');
    });

    $('#btn-change-handle').click(() => {
        $('#change-handle-modal').modal('show');
    });

    $('#btn-change-password').click(() => {
        $('#change-password-modal').modal('show');
    });

    $('#btn-change-tel').click(() => {
        $('#change-tel-modal').modal('show');
    });

    $('#btn-submit-UIN').click(() => {
        var new_UIN = $('#new-UIN').val();
        $('#new-UIN').val('');

        var url = 'controller.php';
        var query = {
            page: 'SettingsPage',
            command: 'ChangeUIN',
            new_UIN: new_UIN
        };
        // jQuery post
        $.post(url, query, function (data, status) {
            //var d = JSON.parse(data);
            alert(data);

        });
    });

    $('#btn-submit-handle').click(() => {
        var new_handle = $('#new-handle').val();
        $('#new-handle').val('');

        var url = 'controller.php';
        var query = {
            page: 'SettingsPage',
            command: 'ChangeHandle',
            new_handle: new_handle
        };
        // jQuery post
        $.post(url, query, function (data, status) {
            //var d = JSON.parse(data);
            alert(data);

        });
    });

    $('#btn-submit-password').click(() => {
        var new_password = $('#new-password').val();
        var confirm_password = $('#confirm-password').val();
        $('#new-password').val('');
        $('#confirm-password').val('');
        var url = 'controller.php';
        var query = {
            page: 'SettingsPage',
            command: 'ChangePassword',
            new_password: new_password,
            confirm_password: confirm_password
        };
        // jQuery post
        $.post(url, query, function (data, status) {
            //var d = JSON.parse(data);
            alert(data);

        });
    });

    $('#btn-submit-tel').click(() => {
        var new_tel = $('#new-tel').val();
        $('#new-tel').val('');

        var url = 'controller.php';
        var query = {
            page: 'SettingsPage',
            command: 'ChangeTel',
            new_tel: new_tel
        };
        // jQuery post
        $.post(url, query, function (data, status) {
            //var d = JSON.parse(data);
            alert(data);
        });
    });
</script>

</html>