<?php  if (count($errors_email) > 0) : ?>
    <div class="error-message-div">
    <?php foreach ($errors_email as $error) : ?>
        <p class="error-message-paragraph"><?php echo $error ?></p>
    <?php endforeach ?>
    </div>
<?php  endif ?>