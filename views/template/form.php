<form method="post" action="<?= url('store') ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="file">File</label>
        <input type="file" class="form-control-file" id="file" name="file">
        <?php if (isset($errors['file'])) {
            foreach ($errors['file'] as $message) { ?>
                <small class="text-danger"><?php echo $message ?></small><br>
            <?php }
        } ?>
    </div>

    <div class="form-group">
        <label for="height">Height (px)</label>
        <input type="number" class="form-control" id="height" placeholder="height" name="height" value="<?= $old['height'] ?? null ?>">
        <?php if (isset($errors['height'])) {
            foreach ($errors['height'] as $message) { ?>
                <small class="text-danger"><?php echo $message ?></small><br>
            <?php }
        } ?>
    </div>

    <div class="form-group">
        <label for="width">Width (px)</label>
        <input type="number" class="form-control" id="width" placeholder="width" name="width" value="<?= $old['width'] ?? null ?>">
        <?php if (isset($errors['width'])) {
            foreach ($errors['width'] as $message) { ?>
                <small class="text-danger"><?php echo $message ?></small><br>
            <?php }
        } ?>
    </div>

    <button type=" submit" class="btn btn-danger">Submit</button>
</form>