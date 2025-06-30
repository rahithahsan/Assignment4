<?php
/**
 * Notes controller  —  phase 1
 * Read-only list of current reminders.
 */
class Notes extends Controller
{
    /** GET /notes */
    public function index(): void
    {
        $note  = $this->model('Note');
        $notes = $note->all($_SESSION['uid']);   // fetch array

        $this->view('notes/index', compact('notes'));
    }
}
