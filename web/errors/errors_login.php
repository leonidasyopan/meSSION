<?php  if (count($errors_login) > 0) : ?>
    <div class="error-message-div">
    <?php foreach ($errors_login as $error) : ?>
        <p class="error-message-paragraph"><?php echo $error ?></p>
    <?php endforeach ?>
    </div>
<?php  endif ?>