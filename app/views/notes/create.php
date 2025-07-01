<?php require_once 'app/views/templates/header.php'; ?>
<main class="container mt-4" style="max-width:540px">

  <h2 class="h4 mb-3">New reminder</h2>

  <form action="/notes/store" method="post">
    <div class="mb-3">
      <label class="form-label">Subject</label>
      <input class="form-control" name="subject" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Details <span class="text-muted small">(optional)</span></label>
      <textarea class="form-control" name="body" rows="4"></textarea>
    </div>

    <button class="btn btn-primary">Save reminder</button>
    <a href="/notes" class="btn btn-outline-secondary ms-2">Cancel</a>
  </form>

</main>
<?php require_once 'app/views/templates/footer.php'; ?>
