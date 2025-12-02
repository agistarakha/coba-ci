<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4"><?= $title ?></h1>
        <p class="text-muted">Data diambil dari Netbox API: <?= esc($netboxUrl) ?></p>

        <?php if (empty($devices)): ?>
            <div class="alert alert-info">
                Tidak ada device ditemukan di Netbox.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Device Type</th>
                            <th>Status</th>
                            <th>Site</th>
                            <th>Rack</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($devices as $device): ?>
                            <tr>
                                <td><?= $device['id'] ?? '-' ?></td>
                                <td>
                                    <strong><?= esc($device['name'] ?? $device['display'] ?? '-') ?></strong>
                                </td>
                                <td>
                                    <?php if (isset($device['device_type'])): ?>
                                        <?= esc($device['device_type']['model'] ?? '-') ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $status = $device['status']['value'] ?? 'unknown';
                                    $badgeClass = [
                                        'active' => 'bg-success',
                                        'planned' => 'bg-info',
                                        'staged' => 'bg-warning',
                                        'failed' => 'bg-danger',
                                        'inventory' => 'bg-secondary',
                                        'decommissioning' => 'bg-dark',
                                    ];
                                    $badge = $badgeClass[$status] ?? 'bg-secondary';
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= ucfirst($status) ?></span>
                                </td>
                                <td>
                                    <?php if (isset($device['site'])): ?>
                                        <?= esc($device['site']['name'] ?? '-') ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (isset($device['rack'])): ?>
                                        <?= esc($device['rack']['name'] ?? '-') ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (isset($device['position'])): ?>
                                        <?= $device['position'] ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>