<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup for an iDiscuss Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/forum/partial/_handlesignup.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="signupemail">Username</label>
                        <input type="text" class="form-control" id="signupemail" name="signupemail" aria-describedby="emailHelp">
                      <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>  -->
                    </div>
                    <div class="form-group">
                        <label for="signupPassword">Password</label>
                        <input type="password" name="signupPassword" class="form-control" id="signupPassword">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" name="signupcPassword" id="signupcPassword">
                    </div>

                    <button type="submit" class="btn btn-primary">Signup</button>
                </div>
            </form>

        </div>
    </div>
</div>