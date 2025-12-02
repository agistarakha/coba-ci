<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4"><?= $title ?></h1>

        <form action="<?= base_url('device-types/' . $deviceType['id'] . '/update') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Device Type <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= old('name', $deviceType['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $deviceType['description']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('device-types') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>