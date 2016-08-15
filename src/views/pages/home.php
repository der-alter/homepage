<?php $view->extend('layout.php') ?>
<?php $view['slots']->set('title', 'Welcome !') ?>

    <div class="svg-container">
        <object class="svg" type="image/svg+xml" data="<?php echo $assets->getUrl('images/me.svg') ?>">
          <div id="fallback"></div>
        </object>
    </div>
    <p>
        <a href="https://plus.google.com/u/0/+StevenJBigoud">StevenJ</a>
    </p>
