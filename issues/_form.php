<?php include_once('../_config.php');

// todo : redirect un auth usser 


// just the form

?>
<!-- add hidden id if _action isset -->
<form action="<?= base_path ?>/issues/create.php" method="post">
  <div class="row">
    <div class="form-group">
      <label for="content">Issue:</label>
      <textarea class="form-control" rows="6" id="content" name="content"  value="<?= $issue_data['content'] ?? null ?>"></textarea>
      <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
    </div>
  </div>

    <button class="btn btn-primary" type="submit">Submit</button>
</form>