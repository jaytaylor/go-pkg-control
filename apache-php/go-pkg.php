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

$gitBasePath = 'gigawattio';

//
// End settings.
////////////////////////////////////////////////////////////////////////////////

if (basename(__FILE__) == basename($_SERVER['REQUEST_URI'])) {
    header('HTTP/1.0 403 forbidden');
    exit;
}

$domain = $_SERVER['SERVER_NAME'];
$proto = $_SERVER['REQUEST_SCHEME'];
$domainRootUrl = $proto . '://' . $domain . '/';

$pkgName = ltrim($_SERVER['SCRIPT_URL'], '/');
$pkg = $domain . '/' . $pkgName;
$pkgUrl = $proto . '://' . $pkg;
$gitUrl = $gitBaseUrl . $gitBasePath . '/' . explode('/', $pkgName)[0];

// Test for suspicious package path.
//
// scorePackageName is a port of the following awk program:
//
// { split(x, C); n = split($1, F, "/"); n -= 1; m = n; for (i in F) if (i > 0) n -= (C[F[i]]++ > 0); $2 = n; $3 = m; if (n > 1) $4 = n / m ; else $4 = 1 }1
//
function scorePackageName($pkg) {
    $seen = array();
    $pieces = explode('/', $pkg);
    $n = count($pieces);
    --$n;
    $m = $n;
    for ($i = 0; $i < count($pieces); ++$i) {
        if ($i > 0) { // Skip required domain name package prefix.
            if (array_search($pieces[$i], $seen) != FALSE) {
                --$n;
            }
            $seen[$pieces[$i]] = $pieces[$i];
        }
    }
    if ($m != 0) {
        return $n / $m;
    }
    return 1;
}

$plausabilityScore = scorePackageName($pkg);

if ($plausabilityScore < 0.5) {
    http_response_code(404);
    echo '404 - not found';
    return;
}

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
    Back to <a href="<?php echo $domainRootUrl ?>"><?php echo $domain ?></a> | <a href="<?php echo $domainRootUrl ?>/go-pkgs">Packages</a>
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
    <div>score: <?php echo $plausabilityScore ?></div>
    <br>
    Powered by <a href="https://github.com/jaytaylor/go-pkg-control">go-pkg-control</a>.
</body>
</html>
