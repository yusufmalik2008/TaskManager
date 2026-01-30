<?= $this->extend('layout') ?>
<?= $this->section('title') ?>My Account<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4><i class="bi bi-person-circle"></i> My Account</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    
                    <!-- Stats -->
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <h3 class="text-primary"><?= $userStats['totalTasks'] ?? 0 ?></h3>
                            <small>Total Tasks</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <h3 class="text-success"><?= $userStats['completedTasks'] ?? 0 ?></h3>
                            <small>Completed</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <h3 class="text-warning"><?= $userStats['pendingTasks'] ?? 0 ?></h3>
                            <small>Pending</small>
                        </div>
                    </div>

                    <!-- Profile Form - POPULATED WITH REAL USER DATA -->
                    <form method="post" action="<?= site_url('account/update') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" 
                                       value="<?= old('full_name', $user['full_name'] ?? '') ?>" required>
                                <?php if (session('errors.full_name')): ?>
                                    <div class="text-danger"><?= session('errors.full_name') ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" 
                                       value="<?= old('email', $user['email'] ?? '') ?>" required>
                                <?php if (session('errors.email')): ?>
                                    <div class="text-danger"><?= session('errors.email') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update Profile
                        </button>
                    </form>
					<!-- Add this BEFORE closing </div> of card-body -->
<div class="mt-4 pt-4 border-top">
    <h6 class="text-muted mb-3">Session Management</h6>
    <div class="d-flex justify-content-between">
        <span>Logged in as: <strong><?= $user['username'] ?></strong></span>
        <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
