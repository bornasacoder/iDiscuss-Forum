<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login To iDiscuss</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/forum/partial/_handlelogin.php" method="POST">
            <div class="modal-body">
                    <div class="form-group">
                        <label for="loginemail">Username</label>
                        <input type="text" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp">
                    <!--    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>  -->
                    </div>
                    <div class="form-group">
                        <label for="loginpassword">Password</label>
                        <input type="password" class="form-control" id="loginpassword" name="loginpassword">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
          
        </div>
    </div>
</div>