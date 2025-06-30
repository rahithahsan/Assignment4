<?php require 'app/views/templates/header.php'; ?>
<main class="container mt-4">

  <h2 class="h4 mb-3">My reminders</h2>

  <?php if (empty($notes)) : ?>
        <p class="text-muted">You don’t have any reminders yet.</p>
  <?php else : ?>
        <ul class="list-group">
        <?php foreach ($notes as $n): ?>
          <li class="list-group-item"><?= htmlspecialchars($n['subject']) ?></li>
        <?php endforeach; ?>
        </ul>
  <?php endif; ?>

</main>
<?php require 'app/views/templates/footer.php'; ?>
