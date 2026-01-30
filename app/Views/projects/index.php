
<?= $this->section('title') ?>Projects<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-diagram-3"></i> Projects</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">
            <i class="bi bi-plus-circle"></i> New Project
        </button>
    </div>

    <!-- Projects Grid -->
    <div class="row">
        <?php foreach ($projects as $project): ?>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($project['name']) ?></h5>
                    <p class="card-text"><?= esc(substr($project['description'], 0, 100)) ?>...</p>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-muted"><?= date('M j, Y', strtotime($project['created_at'])) ?></small>
                    <a href="<?= site_url('tasks?project=' . $project['id']) ?>" class="btn btn-sm btn-outline-primary float-end">
                        View Tasks
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- New Project Modal -->
    <div class="modal fade" id="projectModal">
        <div class="modal-dialog">
            <form method="post" action="<?= site_url('projects') ?>">
                <?= csrf_field() ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
