<?php $view->extend('layout.php') ?>
<?php $view['slots']->set('title', 'Welcome !') ?>
    <p>Hello !</p>
    <p>My firstname is Steven and I'm a web developer.</p>

    <div class="svg-container">
        <object class="svg" type="image/svg+xml" data="<?php echo $assets->getUrl('images/me.svg') ?>">
          <div id="fallback"></div>
        </object>
    </div>
    <div class="social-ids">
        <p>
            <span>Follow me on:</span>
            <a href="http://twitter.com/katsoops">
                <svg class="icon icon-twitter">
                    <use xlink:href="#icon-twitter" />
                </svg>
            </a>
            <a href="https://plus.google.com/+StevenJBigoud">
                <svg class="icon icon-google">
                    <use xlink:href="#icon-google" />
                </svg>
            </a>
        </p>
    </div>
