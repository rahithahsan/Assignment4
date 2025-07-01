<?php 
$note = $note ?? null;
require_once 'app/views/templates/header.php'; ?>
<main class="container d-flex justify-content-center align-items-start py-5">

  <div class="card shadow-sm" style="max-width:540px; width:100%">
    <div class="card-body">
      <h2 class="h5 mb-3">
        <i class="bi bi-pencil-square me-1"></i> Edit reminder
      </h2>

      <?php if(!$note): ?>
        <div class="alert alert-danger">Reminder not found.</div>
      <?php else: ?>
      <form action="/notes/update/<?= $note['id'] ?>" method="post" novalidate>
        <div class="mb-3">
          <label class="form-label fw-semibold">Subject <span class="text-danger">*</span></label>
          <input name="subject" class="form-control" required
                 value="<?= htmlspecialchars($note['subject'] ?? '') ?>">
          <div class="invalid-feedback">A subject is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Details</label>
          <textarea name="body" rows="4" class="form-control"
                    placeholder="Extra notes…"><?= htmlspecialchars($note['body'] ?? '') ?></textarea>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" id="done"
                 name="completed" value="1" <?= $note['completed'] ? 'checked' : '' ?>>
          <label class="form-check-label" for="done">Mark as completed</label>
        </div>

        <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i>Save changes</button>
        <a href="/notes" class="btn btn-outline-secondary ms-2">Cancel</a>
      </form>
      <?php endif; ?>
    </div>
  </div>

</main>

<script>
(() => {
  const form = document.querySelector('form');
  if(form){
    form.addEventListener('submit', e => {
      if (!form.checkValidity()){ e.preventDefault(); e.stopPropagation(); }
      form.classList.add('was-validated');
    });
  }
})();
</script>
<?php require_once 'app/views/templates/footer.php'; ?>

