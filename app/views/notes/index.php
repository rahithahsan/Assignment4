<?php require 'app/views/templates/header.php'; ?>
<main class="container py-4">

  <!-- flash ------------------------------------------------------>
  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-success alert-dismissible fade show small" role="alert">
      <?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- page header ------------------------------------------------->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold mb-0">
      <i data-feather="bell" class="me-1"></i> My reminders
    </h2>

    <a class="btn btn-primary btn-sm d-flex align-items-center gap-1" href="/notes/create">
      <i data-feather="plus" class="feather-sm"></i><span>New</span>
    </a>
  </div>

  <!-- OPEN (to-do) ----------------------------------------------->
  <h6 class="text-uppercase text-muted small fw-bold">To&nbsp;do</h6>

  <?php if (empty($open)) : ?>
      <p class="text-muted mb-4">Nothing pending – nice!</p>
  <?php else : ?>
    <div class="table-responsive mb-4">
      <table class="table align-middle table-hover small">
        <thead class="table-light">
          <tr>
            <th style="width:55%">Subject</th>
            <th style="width:20%">Created</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($open as $n): ?>
          <tr>
            <td class="fw-medium"><?= htmlspecialchars($n['subject']) ?></td>
            <td><?= date('M j Y', strtotime($n['created_at'])) ?></td>
            <td class="text-end">
              <!-- NEW “Done” button -->
              <a href="/notes/toggle/<?= $n['id'] ?>"
                 class="btn btn-success btn-sm me-1">
                   <i data-feather="check" class="feather-sm"></i>
                   <span class="ms-1">Done</span>
              </a>

              <a href="/notes/edit/<?= $n['id'] ?>"
                 class="btn btn-outline-secondary btn-sm me-1">
                   <i data-feather="edit-2" class="feather-sm"></i>
                   <span class="ms-1">Edit</span>
              </a>

              <a href="/notes/delete/<?= $n['id'] ?>"
                 class="btn btn-outline-danger btn-sm">
                   <i data-feather="trash" class="feather-sm"></i>
                   <span class="ms-1">Del</span>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <!-- COMPLETED (collapsible) ------------------------------------>
  <h6>
    <button class="btn btn-sm btn-link p-0 text-decoration-none"
            data-bs-toggle="collapse"
            data-bs-target="#doneWrap" aria-expanded="false">
      <i data-feather="chevron-right" class="feather-sm me-1"></i>
      Completed
      <span class="badge bg-secondary align-text-top"><?= count($done ?? []) ?></span>
    </button>
  </h6>

  <div class="collapse show" id="doneWrap">
    <?php if (empty($done)) : ?>
        <p class="text-muted">No completed reminders.</p>
    <?php else : ?>
      <div class="table-responsive">
        <table class="table align-middle table-sm small">
          <thead class="table-light">
            <tr>
              <th style="width:55%">Subject</th>
              <th style="width:20%">Created</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($done as $n): ?>
            <tr class="table-success">
              <td><s><?= htmlspecialchars($n['subject']) ?></s></td>
              <td><?= date('M j Y', strtotime($n['created_at'])) ?></td>
              <td class="text-end">
                <!-- NEW “Undo” button -->
                <a href="/notes/toggle/<?= $n['id'] ?>"
                   class="btn btn-outline-success btn-sm me-1">
                   <i data-feather="rotate-ccw" class="feather-sm"></i>
                   <span class="ms-1">Undo</span>
                </a>

                <a href="/notes/delete/<?= $n['id'] ?>"
                   class="btn btn-outline-danger btn-sm">
                   <i data-feather="trash" class="feather-sm"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

</main>

<!-- icons & tool-tips ------------------------------------------->
<script>
document.addEventListener('DOMContentLoaded', () => {
  window.feather && feather.replace({width:14,height:14});
  [...document.querySelectorAll('[data-bs-toggle="tooltip"]')]
      .forEach(el => new bootstrap.Tooltip(el));
});
</script>

<?php require 'app/views/templates/footer.php'; ?>
