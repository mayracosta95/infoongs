<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humble Framework</title>
    <link rel="stylesheet" href="/css/layout.css">
</head>
<body>
    <header id="appHeader">
        Humble Framework
    </header>
    <div id="appContent">
        <?php include_once $_viewPath; ?>
    </div>
    <footer id="appFooter">
        Lucian Alves <?php echo date('Y'); ?>
    </footer>
</body>
</html>