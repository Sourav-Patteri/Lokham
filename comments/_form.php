<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php if (!AUTH) redirect(base_path . "/issues") ?>
<?php if (!isset($issue['id'])) redirect("/issues") ?>

<?php $form_data = $form_data ?? null ?>
<?php $_action = $_action ?? base_path . "/comments/create.php" ?>
<style>
  .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

/* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */

</style>

<div class="row mb-5">
  <div class="col-sm-9">

    <form action="<?= $_action ?>" method="post">
      <input type="hidden" name="issue_id" value="<?= $issue['id'] ?? null ?>">

      <div class="rate">
        <input type="radio" id="star5" name="rating" value="5" />
        <label for="star5" title="5">5 stars</label>
        <input type="radio" id="star4" name="rating" value="4" />
        <label for="star4" title="4">4 stars</label>
        <input type="radio" id="star3" name="rating" value="3" />
        <label for="star3" title="3">3 stars</label>
        <input type="radio" id="star2" name="rating" value="2" />
        <label for="star2" title="2">2 stars</label>
        <input type="radio" id="star1" name="rating" value="1" />
        <label for="star1" title="1">1 star</label>
      </div>

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