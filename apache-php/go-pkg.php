<?php
/*******************************************************************************
 *                      Apache variant of go-pkg-control                       *
 * --------------------------------------------------------------------------- *
 *                 https://github.com/jaytaylor/go-pkg-control                 *
 * --------------------------------------------------------------------------- *
 *
 * @author Jay Taylor <outtatime@gmail.com>
 *
 * @date 2018-03-24
 *
 * @see https://github.com/jaytaylor/go-pkg-control/tree/master/apache-php
 */

////////////////////////////////////////////////////////////////////////////////
// Begin settings.
//

$gitBaseUrl = 'https://github.com/';

$gitBasePath = 'jaytaylor';

//
// End settings.
////////////////////////////////////////////////////////////////////////////////

if (basename(__FILE__) == basename($_SERVER['REQUEST_URI'])) {
    header('HTTP/1.0 403 forbidden');
    exit;
}

$domain = $_SERVER['SERVER_NAME'];
$proto = $_SERVER['REQUEST_SCHEME'];
$domainRootUrl = $proto . '//' . $domain . '/';

$pkgName = ltrim($_SERVER['SCRIPT_URL'], '/');
$pkg = $domain . '/' . $pkgName;
$pkgUrl = $proto . '://' . $pkg;
$gitUrl = $gitBaseUrl . $gitBasePath . '/' . $pkgName;
?><!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $pkgName ?> - <?php echo $domain ?></title>

    <meta name="go-import" content="<?php echo $pkg ?> git <?php echo $gitUrl ?>">
    <meta name="go-source" content="<?php echo $pkg ?> _ <?php echo $gitUrl ?>/tree/master{/dir} <?php echo $gitUrl ?>/blob/master{/dir}/{file}#L{line}">

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="<?php echo $pkg ?>">
</head>
<body>
    Back to <a href="<?php echo $domainRootUrl ?>"><?php echo $domain ?></a>
    <div style="text-align: center; width: 100%;">
        <h1>Package: <?php echo $pkgName ?></h1>
        <br>
        <br>
        <a href="https://godoc.org/<?php echo $pkg ?>">Package Documentation</a>
        <br>
        <br>
        <br>
        <br>
        <a href="<?php echo $pkgUrl ?>"><?php echo $pkg ?></a>
        is currently being served from
        <a href="<?php echo $gitUrl ?>"><?php echo $gitUrl ?></a>
        <br>
        <br>
        <br>
        <br>
    </div>
    <br>
    Powered by <a href="https://github.com/jaytaylor/go-pkg-control">go-pkg-control</a>.
</body>
</html>
