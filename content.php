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
                <button type="button" id="btn-check-stats" class="btn btn-outline-primary" onclick="getPosts()">Check Statistics</button>
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
            if (isSigned(d.id)) {
                if (d.display == 'CreatePost') {
                    var t = '<input type="text" id="post-name" placeholder = "Post name">';
                    t += '<textarea class="form-control" placeholder = "Text" id="textarea-text" rows="10"></textarea>';
                    t += '<button type="button" id="btn-submit-textarea" class="btn btn-outline-dark" onclick="submit()">Submit</button>';
                    t += '<button type="button" id="btn-cancel-textarea" class="btn btn-outline-dark" onclick="cancel()">Cancel</button>';
                    $('#content-pane').html(t);
                }

            } else {
                $('#register-modal').modal('show');
            }
        });

    });

    function submit() {
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'SubmitPost',
            post_name: $('#post-name').val(),
            post_text: $('#textarea-text').val()

        };
        $.post(url, query, function(data) {
            if (data) {
                alert('Post Created');
                cancel();
            } else {
                alert("Error occured.");
            }

        });
    }

    function getPosts() {
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'GetPosts'

        };
        $.post(url, query, function(data) {
            console.log(data);
            var rows = JSON.parse(data);
            var t = "<table class='table table-bordered table-condensed'>";
            t += '<tr>';
            for (j in rows[0]) {
                if (j == "CreatorID")
                    j = 'Creator';
                t += '<th>' + j + '</th>';
            }
            t += '</tr>'
            for (var i = 0; i < rows.length; i++) {
                t += '<tr>';
                for (j in rows[i]) {

                    t += '<td>' + rows[i][j] + '</td>';


                }
                t += '</tr>';
            }
            t += '</table>';
            $('#content-pane').html(t);

        });
    }

    $(document).ready(() => {
        getPosts();
    });

    function cancel() {
        $('#post-name').val("");
        $('#textarea-text').val("");
        var t = '';
        getPosts();
    }

    $('#btn-send-vote').click(() => {
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'SendVote'
        };
        // jQuery post
        $.post(url, query, function(data) {
            var d = JSON.parse(data);
            if (isSigned(d.id)) {
                var t = '';
            } else {
                $('#register-modal').modal('show');
            }
        });

    });

    function isSigned(data) {
        if (data == -1) {
            return false;
        } else
            return true;
    }
</script>