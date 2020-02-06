<?php  if (count($errors_register) > 0) : ?>
    <div class="error-message-div">
    <?php foreach ($errors_register as $error) : ?>
        <p class="error-message-paragraph"><?php echo $error ?></p>
    <?php endforeach ?>
    </div>
<?php  endif ?>