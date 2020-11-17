<style>
    div {
        outline: 1px red solid;
    }

    .nav-item {
        text-align: center;
    }

    .nav-item>button {
        width: 6em;
    }
</style>

<div class="row content">
    <div class="col-md-9" id="content-pane">

    </div>
    <div class="col-md-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <button type="button" id="btn-create-post" class="btn btn-outline-primary">Create Post</button>
            </li>
            <br>
            <li class="nav-item">
                <button type="button" id="btn-send-vote" class="btn btn-outline-primary">Send Vote</button>
            </li>
            <br>
            <li class="nav-item">
                <button type="button" id="btn-check-stats" class="btn btn-outline-primary">Check Statistics</button>
            </li>
        </ul>
    </div>
</div>

<script>
    $('#btn-create-post').click(() => {
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'CreatePost'
        };
        // jQuery post
        $.post(url, query, function(data) {
            var d = JSON.parse(data);
            if (d.display == 'CreatePost' && isSigned(d.id)) {
                var t = '<div class="form-group"><label for= "exampleFormControlTextarea1"> Create Post: </label><textarea class="form-control" id="create-post-text" rows="10"></textarea></div >';
                $('#content-pane').html(t);
            }
            else{
                $('#register-modal').modal('show');
            }
        });

    });

    $('#btn-send-vote').click(() => {
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'SendVote'
        };
        // jQuery post
        $.post(url, query, function(data) {
            var d = JSON.parse(data);
            if(isSigned(d.id)){
                var t = '';
            }
            else{
                $('#register-modal').modal('show');
            }
            /*
            if (data != -1) {
                var t = "<table class='table table-bordered table-condensed'>";
                t += '<tr>'
                for (j in rows[0]) {
                    if (j != "Id")
                        t += '<th>' + j + '</th>'
                }
                t += '</tr>'

                for (var i = 0; i < rows.length; i++) {
                    t += '<tr>';
                    for (j in rows[i]) {

                        if (j != "Id") {
                            t += '<td>' + rows[i][j] + '</td>';
                        }
                    }
                    t += '</tr>';
                }
                t += '</table>';
                $('#content-panes').html(t);
            }
            */
        });

    });

    function isSigned(data) {
        if (data == -1) {
            return false;
        } else
            return true;
    }
</script>