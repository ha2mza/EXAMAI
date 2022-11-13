<?php

$title = 'ExamAI - Register';
require_once ROOT . '/src/Views/layouts/auth.php';


function contentPage()
{
    ?>

    <div class="auth-form-wrapper px-4 py-5">
        <a href="#" class="noble-ui-logo d-block mb-2">Exam<span>AI</span></a>
        <h5 class="text-muted font-weight-normal mb-4">Create a free account.</h5>
        <p style="color: red;"><?= request_session('register_erreur') ?? '' ?></p>
        <form class="forms-sample" method="post">
            <div class="form-group">
                <label for="txtfirstname">First Name</label>
                <input name="first_name" type="text" class="form-control" id="txtfirstname" autocomplete="first_name">
            </div>
            <div class="form-group">
                <label for="txtlastname">Last Name</label>
                <input name="last_name" type="text" class="form-control" id="txtlastname" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="txtemail">Email address</label>
                <input name="email" type="text" class="form-control" id="txtemail" autocomplete="email">
            </div>
            <div class="form-group">
                <label for="txtpass">Password</label>
                <input name="password" type="password" class="form-control" id="txtpass" autocomplete="off">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary text-white mr-2 mb-2 mb-md-0">
                    Sing up
                </button>
            </div>
            <a href="login.php" class="d-block mt-3 text-muted">Already a user? Sign in</a>
        </form>
    </div>

    <?php
}