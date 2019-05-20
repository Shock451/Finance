<!DOCTYPE html>

<html>

    <head>

        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>

        <style>
            body {
                     background-color: PapayaWhip;
                 }

            h1 {
                   color: maroon;
                   margin-left: 40px;
               } 
		</style>
		
		<?php if (isset($title)): ?>
            <title>C$50 Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>C$50 Finance</title>
        <?php endif ?>

        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">
                <a href="/"><img alt="C$50 Finance" src="/img/logo.gif"/></a>
				<?php if(isset($pagename)):?>
				<h4><?= htmlspecialchars($pagename)?><h4>
				<?php endif ?>
			</div>
			<div id="middle">
