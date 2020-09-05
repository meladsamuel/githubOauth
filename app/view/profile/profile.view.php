<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 d-flex justify-content-between align-items-center">
                <a class="btn btn-sm btn-outline-secondary" href="/auth/logout">LogOut</a>
            </div>
        </div>
    </header>
    <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">welcome <?= $user->name?></h1>
            <p class="lead my-3"></p>
            <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
    </div>
</div>
