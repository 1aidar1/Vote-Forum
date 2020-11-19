<style>
    .header {
        border: darkgray 2px solid;
        border-radius: 18px;
        padding-top:0.5em;
        padding-bottom: 0.5em;
    }



    .col-md-2 {
        margin-top: 0.5%;
        margin-bottom: 0.5%;
        text-align: center;
    }

    .modal-body>div {
        text-align: left;
    }

    .modal-body>div>label {
        width: 75px;
    }
</style>

<div class="row header">
    <div class="col-md-8">
    </div>

    <div class="col-md-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register-modal">
            Register
        </button>
        <!-- Modal Register-->
        <div class="modal fade" id="register-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="join-username">UIN: </label>
                            <input type="text" name="UIN" required id="register-UIN">
                        </div>
                        <br>
                        <div>
                            <label for="join-username">Handle: </label>
                            <input type="text" name="username" required id="register-handle">
                        </div>
                        <br>
                        <div>
                            <label for="join-password">Password: </label>
                            <input type="password" name="password" required id="register-password">
                        </div>
                        <br>
                        <div>
                            <label for="join-email">Phone: </label>
                            <input type="text" name="tel" id="register-tel" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-form-register" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sign-in-modal">
            Sign In
        </button>
        <!-- Modal SignIn-->
        <form action="controller.php" method="POST" id="form-signin" name="form-signin">
            <div class="modal fade" id="sign-in-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label for="signin-username">Username: </label>
                                <input type="text" name="handle" id="signin-handle" required>
                            </div>
                            <br>
                            <div>
                                <label for="signin-password">Password: </label>
                                <input type="password" name="password" id="signin-password" required>
                            </div>
                            <?php echo $error ?>
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="page" id="page" value="Header" style="visibility: hidden; position: absolute;">
                            <input type="text" name="command" id="signin" value="SignIn" style="visibility: hidden; position: absolute;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" form="form-signin" id="btn-form-signin" class="btn btn-primary">Sign In</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<script>
    /*
    $('#btn-form-signin').click(() => {
        $('#sign-in-modal').modal('hide');
        var url = 'controller.php';
        var query = {
            page: 'MainPage',
            command: 'SignIn',
            handle: $('#signin-handle').val(),
            password: $('#signin-password').val()
        };
        // jQuery post
        $.post(url, query, function(data) {
        });
    });
    */
    $(document).ready(() => {
        if(<?php if($error!=''){ echo true;}else{echo false;} ?>){
            $('#sign-in-modal').modal('show');
        }
    });

    $('#btn-form-register').click(() => {
        $('#register-modal').modal('hide');
        var url = 'controller.php';
        var query = {
            page: 'Header',
            command: 'Register',
            UIN: $('#register-UIN').val(),
            handle: $('#register-handle').val(),
            password: $('#register-password').val(),
            tel: $('#register-tel').val()
        };
        // jQuery post
        $.post(url, query, function(data) {
            var d = jQuery.parseJSON(data);
            alert(d.display);
        });
    });
</script>