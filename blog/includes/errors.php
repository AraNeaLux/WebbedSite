<?php if (count($errors) > 0) : ?>
  <div class="message error validation_errors" >
        <?php foreach ($errors as $error) : ?>
          <?php echo $error ?>
        <?php endforeach ?>
  </div>
<?php endif ?>
