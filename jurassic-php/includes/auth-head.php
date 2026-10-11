<?php /* expects $pageTitle and $cssFile */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="<?php echo htmlspecialchars($cssFile); ?>" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jurassic-park" rel="stylesheet">
  </head>
  <body>
