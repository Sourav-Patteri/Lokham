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
<form action="<?= $_action?>" method="post" enctype="multipart/form-data">
<?php if (isset($_action)): ?>
    <input type="hidden" name="issue_id" value="<?= $form_data['issue_id']?>">
  <?php endif ?>
  <div class="row">    
  <div class="form-group col">
    <label for="title">Title:</label>
    <!-- Step 4: Add value if there's a value in form_data for this field -->
    <input type="text" class="form-control" name="title" placeholder="Enter Issue Title" value="<?= $form_data['title'] ?? null?>">
  </div>
  <div class="form-group col">
    <label for="title">Issue:</label>
    <!-- Step 6: Prepopulate the value if there's a value in form_data for this textarea -->
    <textarea name="content" class="summernote" required value="<?= $form_data['content'] ?? null ?>">
      <?= $form_data['content'] ?? null ?>
    </textarea>
  </div>
  <div class="custom-file m-2">
      <input type="file" name="uploads" class="custom-file-input" id="uploads">
      <label for="uploads" class="custom-file-label">Choose File:</label>
  </div>
  </div>
    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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