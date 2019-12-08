<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php if (!AUTH) redirect(base_path . "/issues") ?>
<?php if (!isset($issue['id'])) redirect("/issues") ?>

<?php $form_data = $form_data ?? null ?>
<?php $_action = $_action ?? base_path . "/comments/create.php" ?>

<div class="row mb-5">
  <div class="col-sm-9">
    <form action="<?= $_action ?>" method="post">
      <input type="hidden" name="issue_id" value="<?= $issue['id'] ?? null ?>">
      
      <!-- <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="
        //<?php 
        //echo $form_data['title'] ?? null 
        ?>
        ">
      </div> -->

      <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea type="text" class="form-control" name="comment" rows="5"><?= $form_data['comment'] ?? null ?></textarea>
      </div>

      <div class="form-group clearfix">
        <button class="btn btn-primary pull-right" type="submit">Submit</button>
      </div>
    </form>
  </div>
</div>