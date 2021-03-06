<title><?= $title ?></title>
<meta name="description" content="<?= $desc ?>" />
<meta name="keywords" content="<?= $keywords ?>" />
<meta property="og:type" content="article" />
<?php if(!empty($visualAsset)){ ?>
  <meta property="og:image" content="<?= $visualAsset ?>" />
<?php } ?>
