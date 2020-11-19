<style>
    .nav-item {
        text-align: center;
    }

    .nav-item>button {
        width: 6em;
    }

    .post-link {
        color: darkblue;
        border: none;
        padding: 0;
        background: none;
    }

    .post-link:hover {
        cursor: pointer;
        text-decoration: underline;
        color: darkblue;
        border: none;
    }

    .post-info {
        font-size: 0.9em;
        color: grey;
    }

    .comment {
        margin-top: 1em;
        width: 70%;
        margin-left: 1em;
    }

    .comment>h5 {
        text-decoration: underline;
    }

    .comment>p {
        background-color: lightgray;
        padding-top: 1em;
        padding-bottom: 1em;
    }

    .radio-row-1 {
        width: 45%;
        display: inline-block;
        text-align: center;
    }

    .radio-row-2 {
        width: 45%;
        display: inline-block;
        text-align: center;
    }
</style>

<div class="row content">
    <div class="col-md-9">

        <div id="content-pane">

        </div>

        <div id='comments-pane'>

        </div>
    </div>
    <div class="col-md-3">
        <ul class="nav flex-column">
            <br>
            <li class="nav-item">
                <button type="button" id="btn-home" class="btn btn-outline-dark" onclick="getPosts()">Home</button>
            </li>
            <br>
            <li class="nav-item">
                <button type="button" id="btn-create-post" class="btn btn-outline-dark">Create Post</button>
            </li>
            <br>
            <li class="nav-item">
                <button type="button" class="btn btn-outline-dark" data-toggle='modal' data-target='#vote-modal'>Send Vote</button>
            </li>
            <br>
            <li class="nav-item">
                <button type="button" id="btn-check-stats" class="btn btn-outline-dark">Check Statistics</button>
            </li>
        </ul>

        <div class="modal fade" id="vote-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Vote: </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="radio-row-1">
                            <!-- Group of default radios - option 1 -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="radio_1" value="1" name="groupOfDefaultRadios">
                                <label class="custom-control-label" for="radio_1">Option 1</label>
                            </div>

                            <!-- Group of default radios - option 2 -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="radio_2" value="2" name="groupOfDefaultRadios">
                                <label class="custom-control-label" for="radio_2">Option 2</label>
                            </div>

                            <!-- Group of default radios - option 3 -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="radio_3" value="3" name="groupOfDefaultRadios">
                                <label class="custom-control-label" for="radio_3">Option 3</label>
                            </div>
                        </div>
                        <div class="radio-row-2">
                            <!-- Group of default radios - option 4 -->
                            <div class="custom-control custom-radio">
                                <input type="radio" value="4" class="custom-control-input" id="radio_4" name="groupOfDefaultRadios">
                                <label class="custom-control-label" for="radio_4">Option 4</label>
                            </div>

                            <!-- Group of default radios - option 5 -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="radio_5" value="5" name="groupOfDefaultRadios">
                                <label class="custom-control-label" for="radio_5">Option 5</label>
                            </div>

                            <!-- Group of default radios - option 6 -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="radio_6" value="6" name="groupOfDefaultRadios">
                                <label class="custom-control-label" for="radio_6">Option 6</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-vote">Vote</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('#btn-check-stats').click(()=>{
        cleanContent();
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'CheckVote'
        };
        $.post(url, query, function(data) {
            var d = JSON.parse(data);
            console.log(d);
            var candidates = [0,0,0,0,0,0];
            var total=0;
            for(var i=0;i<d.length;i++){
                if(d[i]!=0){
                    candidates[d[i]-1]++;
                    total++;
                }
            }

            console.log(candidates.toString());

            var ans = [0,0,0,0,0,0];
            var t = '<div><h3>Statistics:</h3><hr>';
            for(var i=0;i<ans.length;i++){
                ans[i] = candidates[i]*100/total;
                ans[i] = ans[i].toFixed(2);
                t+='<p> Candidate ' + (i+1) + ': ' + ans[i] +'%</p>'
            }
            t+='</div>';
            $('#content-pane').html(t);


        });
    });

    $('#btn-vote').click(() => {
        var radios = $('.custom-control-input');
        //console.log(radios);
        var ans = 0;
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                ans = radios[i].value;
                console.log("VOTE: "+ ans);
                break;
            }
        }
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'Vote',
            vote: ans

        };
        $.post(url, query, function(data) {
            if(data == 0 ){
                alert('Cannot vote twice!');
                $('#vote-modal').modal('hide');
            }
            else if(data == 1){
                alert('vote submited');
                $('#vote-modal').modal('hide');
            }
            else if(data == -1){
                $('#vote-modal').modal('hide');
                $('#register-modal').modal('show');
            }

        });
    });


    $('#btn-create-post').click(() => {
        cleanContent();
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
        cleanContent();
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'GetPosts'

        };
        $.post(url, query, function(data) {

            var rows = JSON.parse(data);
            console.log(data);
            var t = "<table class='table table-bordered table-condensed'>";
            t += '<tr>';
            for (j in rows[0]) {
                if (j != "ID") {
                    if (j == "CreatorID")
                        j = 'Creator';
                    t += '<th>' + j + '</th>';
                }
            }
            t += '</tr>'
            for (var i = 0; i < rows.length; i++) {
                t += '<tr>';
                for (j in rows[i]) {
                    if (j != "ID") {
                        if (j == 'PostName') {
                            t += '<td><button onclick="toPost(event)" class="post-link" id="id_' + rows[i]['ID'] + '">' + rows[i][j] + '</button></td>';
                        } else
                            t += '<td>' + rows[i][j] + '</td>';
                    }
                }
                t += '</tr>';
            }
            t += '</table>';
            $('#content-pane').html(t);

        });
    }

    function toPost(event) {
        cleanContent();
        var post_id = $(event.target).attr('id');
        //  alert(post_id);
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'OpenPost',
            post_id: post_id

        };
        // jQuery post
        $.post(url, query, function(data) {
            var d = JSON.parse(data);
            console.log(d);
            var head = '<h1>' + d.PostName + '</h1><hr>';
            var text = '<p class="post-text">' + d.PostText + '</p><hr>';
            var info = '<p class="post-info"> Date: ' + d.Date + '</p>';
            var t = head + text + info + "<br>";

            var comment = '<label>Leave Comment:</label>';
            comment += '<textarea class="form-control" placeholder = "Comment" id="comment-text" rows="2"></textarea>';
            comment += '<button type="button" id="btn-submit-comment" class="btn btn-outline-dark float-right" onclick="submitComment()">Submit</button>';
            t += comment + "<br>";

            var comments = '<button type="button" id="btn-get-comments" class="btn btn-outline-dark" onclick="getComments()">View Comments</button>';
            t += comments;


            $('#content-pane').html(t);
        });
    }

    function cleanContent() {
        $('#content-pane').html('');
        $('#comments-pane').html('');
    }

    function getComments() {
        //cleanContent();

        // var res = id.replace(/\D/g, "");
        //alert('pressed');

        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'GetComments'
        };
        // jQuery post
        $.post(url, query, function(data) {
            //console.log("DATA "+data);
            var d = JSON.parse(data);
            console.log(d);
            var user = [];
            var comment = [];
            var t = '';
            for (const [key, value] of Object.entries(d)) {
                user.push(value.UserID);
                comment.push(value.CommentText);
            }
            for (var i = user.length - 1; i >= 0; i--) {
                t += '<div class="comment"><h5>' + user[i] + '</h5>';
                t += '<p>' + comment[i] + '</p></div>';
            }
            $('#comments-pane').html(t);

        });
    }

    function submitComment() {
        var url = 'controller.php';
        var query = {
            page: 'Content',
            command: 'SubmitComment',
            comment_text: $('#comment-text').val()
        };
        // jQuery post
        $.post(url, query, function(data) {
            console.log(data);
            if (data == true) {
                alert('Comment Submited');
                $('#comment-text').val('');
                getComments();
            } else {
                alert('Not Submited');
            }
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

    function isSigned(data) {
        if (data == -1) {
            return false;
        } else
            return true;
    }
</script>