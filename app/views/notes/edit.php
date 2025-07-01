<?php require 'app/views/templates/header.php'; ?>
<main class="container mt-4">

  <h2 class="h4 mb-3">Edit reminder</h2>

  <form action="/notes/update/<?= $note['id'] ?>" method="post" class="mb-4">
    <div class="mb-3">
      <label class="form-label">Subject</label>
      <input name="subject" class="form-control"
             value="<?= htmlspecialchars($note['subject']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Details (optional)</label>
      <textarea name="body" rows="4"
                class="form-control"><?= htmlspecialchars($note['body']) ?></textarea>
    </div>

    <div class="form-check mb-3">
      <input type="checkbox" class="form-check-input" id="done"
             name="completed" value="1" <?= $note['completed'] ? 'checked' : '' ?>>
      <label class="form-check-label" for="done">Mark as completed</label>
    </div>

    <button class="btn btn-primary">Save changes</button>
    <a href="/notes" class="btn btn-outline-secondary ms-2">Cancel</a>
  </form>

</main>
<?php require 'app/views/templates/footer.php'; ?>
