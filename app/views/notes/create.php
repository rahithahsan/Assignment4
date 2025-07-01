<?php require_once 'app/views/templates/header.php'; ?>
<main class="container d-flex justify-content-center align-items-start py-5">

  <div class="card shadow-sm" style="max-width:540px; width:100%">
    <div class="card-body">
      <h2 class="h5 mb-3">
        <i class="bi bi-plus-circle me-1"></i> New reminder
      </h2>

      <form action="/notes/store" method="post" novalidate>
        <div class="mb-3">
          <label class="form-label fw-semibold">Subject <span class="text-danger">*</span></label>
          <input type="text" name="subject" class="form-control" placeholder="e.g. Pay tuition" required>
          <div class="invalid-feedback">A subject is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Details <span class="text-muted">(optional)</span></label>
          <textarea name="body" rows="4" class="form-control" placeholder="Extra notes…"></textarea>
        </div>

        <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Save reminder</button>
        <a href="/notes" class="btn btn-outline-secondary ms-2">Cancel</a>
      </form>
    </div>
  </div>

</main>

<script>
/* Bootstrap client-side validation */
(() => {
  const form = document.querySelector('form');
  form.addEventListener('submit', e => {
    if (!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
    form.classList.add('was-validated');
  });
})();
</script>
<?php require_once 'app/views/templates/footer.php'; ?>

