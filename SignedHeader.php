<style>
    .header {
        background-color: aqua;
    }

    .dropdown {
        text-align: end;
    }

    div {
        outline: solid red 1px;
        padding: 0px;
    }

    .col-md-4 {
        padding: 0px;
    }
</style>

<div class="row header">
    <div class="col-md-2">
        <form action="controller.php" method="POST" id="home-form">
            <input type="text" name="page" value="SignedHeader" style="visibility: hidden; position: absolute;">
            <input type="text" name="command" value="Home" style="visibility: hidden; position: absolute;">
            <button id='btn-home'>Home</button>
        </form>
    </div>
    <div class="col-md-6">

    </div>

    <div class="col-md-4">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Your Profile
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <form action="controller.php" method="POST" id="settings-form">
                    <input type="text" name="page" value="SignedHeader" style="visibility: hidden; position: absolute;">
                    <input type="text" name="command" value="Settings" style="visibility: hidden; position: absolute;">
                    <button class="dropdown-item" id="btn-settings" type="button">Settings</button>
                </form>
                <form action="controller.php" method="POST" id="sign-out-form">
                    <input type="text" name="page" value="SignedHeader" style="visibility: hidden; position: absolute;">
                    <input type="text" name="command" value="SignOut" style="visibility: hidden; position: absolute;">
                    <button class="dropdown-item" id="btn-logout" type="button">Logout</button>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    $('#btn-logout').click(() => {
        $('#sign-out-form').submit();
    });
    $('#btn-settings').click(() => {
        $('#settings-form').submit();
    });
    $('#btn-home').click(() => {
        $('#home-form').submit();
    });
</script>