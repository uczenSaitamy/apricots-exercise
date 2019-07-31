<div class="row text-center">
    <div class="col-lg">
        <h1 class="display-2 text-danger">
            <?= $error['code'] ?>
            <span class="display-4 text-light">
                <?= $error['message'] ?>
            </span>
        </h1>
        <p class="display-4">back to: <a href="<?= url('home') ?>" class="text-decoration-none text-success">home</a></p>
    </div>
</div>