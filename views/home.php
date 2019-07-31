<div class="row text-center">
    <div class="col-lg">
        <h1 class="display-3">Morele - Zadanie</h1>
    </div>
</div>

<div class="row text-center mt-2">
    <div class="col-lg">
    </div>
    <div class="col-lg">
        <?php include('template/form.php') ?>
    </div>
    <div class="col-lg">
    </div>
</div>

<?php if (readlink('image')) { ?>
    <div class="row text-center mt-2">
        <div class="col-lg">
            <img src="image" class="img-fluid" alt="Responsive image">
        </div>
    </div>
<?php } ?>