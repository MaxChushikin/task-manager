<footer>
    <div class="copyright">
        <div class="container">
            <div class="col-lg-12">
                <p class="copy_top">© Ruby Garage.</p>
            </div>
        </div>
    </div>
</footer>

<!--        Login / Register START-->
<div class="wrapper fadeInDown">
    <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountModalLabel">login or Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                    </div>
                    <h5>Demo-user: <span class="badge badge-warning">demodemo</span></h5>
                    <h5>Demo-password <span class="badge badge-warning">demodemo</span></h5>
                    <form id="accountForm">
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" name="login" class="form-control" id="login" placeholder="Enter login">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <button type="button" id="loginButton" class="accountButton btn btn-primary">Login</button>
                        <button type="button" id="registerButton" class="accountButton btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--        Login / Register END -->


<!--        Add project modal START-->
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" id="addProjectForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Project name</label>
                        <input type="text" class="form-control" id="project_name" name="project_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="addProjectSubmit" class="btn btn-primary"><span>Add project</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--        Add project modal END -->
<script src="js/jquery/jquery-3.3.1.min.js"></script>
<script src="js/datepicker.js"></script>
<script src="js/i18n/datepicker.en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
