<?php $view->extend('layout.php') ?>
<?php $view['slots']->set('title', 'Welcome !') ?>
    <p>Hello !</p>
    <p>My name is Steven and I'm a developer.</p>

    <div class="svg-container">
        <object class="svg" type="image/svg+xml" data="<?php echo $assets->getUrl('images/me.svg') ?>">
          <div id="fallback"></div>
        </object>
    </div>
    <div class="social-ids">
        <p>
            <span>Follow me on:</span>
            <a href="http://twitter.com/BzhDevv">
                <svg class="icon icon-twitter">
                    <use xlink:href="#icon-twitter" />
                </svg>
            </a>
        </p>
    </div>
