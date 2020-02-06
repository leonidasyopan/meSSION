<?php  if (count($errors_reset) > 0) : ?>
    <div class="error-message-div">
    <?php foreach ($errors_reset as $error) : ?>
        <p class="error-message-paragraph"><?php echo $error ?></p>
    <?php endforeach ?>
    </div>
<?php  endif ?>