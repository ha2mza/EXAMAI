<?php

$title = 'ExamAI - Login';
require_once ROOT. '/src/Views/layouts/auth.php';

function contentPage()
{
    ?>

    <div class="auth-form-wrapper px-4 py-5">
        <a href="#" class="noble-ui-logo d-block mb-2">Exam<span>AI</span></a>
        <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
        <p style="color: red;"><?= request_session('login_erreur') ?? '' ?></p>
        <form class="forms-sample" method="post" action="">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                       autocomplete="current-password" placeholder="Password">
            </div>
            <div class="form-check form-check-flat form-check-primary">
                <label class="form-check-label">
                    <input type="checkbox" name="remember" class="form-check-input">
                    Remember me
                </label>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">
                    Login
                </button>
            </div>
            <a href="register.php" class="d-block mt-3 text-muted">Not a user? Sign up</a>
        </form>
    </div>

    <?php
}