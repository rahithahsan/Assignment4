<?php require 'app/views/templates/header.php'; ?>
<main class="container mt-4">

  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-success small">
      <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
    </div>
  <?php endif; ?>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">My reminders</h2>
    <a class="btn btn-sm btn-primary" href="/notes/create">+ New</a>
  </div>

  <?php if (empty($notes)) : ?>
        <p class="text-muted">You don’t have any reminders yet.</p>
  <?php else : ?>
  <table class="table table-sm table-hover align-middle">
    <thead>
      <tr>
        <th>Subject</th>
        <th class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($notes as $n): ?>
        <tr class="<?= $n['completed'] ? 'table-success' : '' ?>">
          <td><?= htmlspecialchars($n['subject']) ?></td>
          <td class="text-end">
            <a class="btn btn-sm btn-outline-secondary"
               href="/notes/edit/<?= $n['id'] ?>">Edit</a>
            <a class="btn btn-sm btn-outline-danger"
               href="/notes/delete/<?= $n['id'] ?>">×</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>

</main>
<?php require 'app/views/templates/footer.php'; ?>

