<!DOCTYPE html>
<html>
    <head>
        <title><?php $view['slots']->output('title', '') ?> &mdash; sjehan.net &mdash; ≧^◡^≦'</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo $assets->getUrl('css/styles.css') ?>" rel="stylesheet">
    </head>
    <body>
    <div id="container">
        <?php $view['slots']->output('_content') ?>
    </div>
    <script src="<?php echo $assets->getUrl('js/app.js') ?>"></script>
    </body>
</html>
