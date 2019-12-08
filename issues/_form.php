<?php include_once('../_config.php')?>
<!-- redirect un auth usser  -->
<?php not_auth_redirect(base_path)?>

<?php 
// if (!isset($issue['id'])) redirect("/issues/index.php")
 ?>

<?php $form_data = $form_data ?? null ?>
<?php $_action = $_action ?? base_path . "/issues/create.php" ?>


<!-- // just the form -->

<!-- add hidden id if _action isset -->
<form action="<?= $_action?>" method="post">

<?php if (isset($_GET['id'])): ?>
    <input type="hidden" name="id" value="<?= $form_data['id']?>">
  <?php endif ?>
  <?php if (isset($_action)): ?>
    <input type="hidden" name="id">
  <?php endif ?>

  <div class="form-group col">
    <label for="title">Status:</label>
    <select name="status" class="form-control">
      <option value="draft" <?= isset($form_data['status']) && $form_data['status'] === "draft" ? "selected" : null; ?>>Draft</option>
      <option value="published"><?=(isset($form_data['status']) && $form_data['status'] === "published") ? "selected" : null?>Published</option>
    </select>
  </div>

  <div class="row">    
  <div class="form-group col">
    <label for="title">Issue:</label>
    <!-- Step 6: Prepopulate the value if there's a value in form_data for this textarea -->
    <textarea name="content" class="summernote" required value="<?= $issue_data['content'] ?? null ?>">
      <?= $form_data['content'] ?? null ?>
    </textarea>
  </div>

  </div>

    <button class="btn btn-primary" type="submit">Submit</button>
</form>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    $(".summernote").summernote({
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript', 'fontname', 'fontsize']],
        ['color', ['color']],
        ['para', ['style', 'ul', 'ol', 'paragraph']],
        ['misc', ['fullscreen', 'codeview', 'undo', 'redo']]
      ],
      height: 300
    });
  });
</script>