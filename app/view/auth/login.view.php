<form class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in </h1>
    <label for="user" class="sr-only">User/Email</label>
    <input name="user" type="text" id="user" class="form-control" placeholder="User/Email" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
    <hr>
    <h3>OR</h3>
    <a href="/auth/github" class="btn btn-lg btn-block btn-social btn-github">
        <span class="fab fa-github"></span> Sign in with Github
    </a>
    <p class="mt-5 mb-3 text-muted">&copy; 2020-<?= date('Y') ?></p>
</form>
