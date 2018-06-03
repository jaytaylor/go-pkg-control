<!doctype html>
<html>
<head>
    <title>golang packages - jaytaylor.com</title>
    <meta charset="utf-8">
    <meta name="author" content="Jay Taylor">
    <meta name="description" content="Jay Taylor's Go Packages">
</head>
<body>

Golang packages I've created or maintain forks of:

    <ul style="list-style-type: none">
<?php
$pkgs = array(
    'archive.is',
    'archive.org',
    'go-bulk-dns-resolver',
    'go-hostsfile',
    'go-netcat',
    'GoOse',
    'goose-cli',
    'gorm',
    'hn-utils',
    'html2text',
    'iTerm2JTT',
    'libchanner',
    'logserver',
    'mockery-example',
    'shipbuilder',
    'slick',
    'stoppableListener',
    'syncdebug',
    'tesseract-web',
    'txt-web',
);

foreach ($pkgs as $idx => $pkg) {
    ?>
        <li><a href="/<?php echo $pkg ?>"><?php echo $pkg ?></a></li><?php
}
?>
    </ul>

    <h3>Packages I've contributed to:</h3>
    <ul>
<?php
$contributor = array(
    'jinzhu/gorm',
    'mreiferson/go-options',
    'moul/http2curl',
    'mesos/mesos-go',
    'tebeka/go2xunit',
    'olekukonko/tablewriter',
    'medallia/convoy',
    'medallia/telegraf',
    'kalloc/dkim',
    'parnurzeal/gorequest',
    'aktau/github-release',
    'vektra/mockery',
    'outersky/har-tools',
    'hashicorp/terraform',
    'advancedlogic/GoOse',
);
foreach ($contributor as $idx => $ghSuffix) {
    $author = split('/', $ghSuffix)[0];
    $pkg = split('/', $ghSuffix)[1];
    ?>
        <li><a href="https://github.com/<?php echo $ghSuffix ?>"><?php echo $pkg ?></a> by <?php echo $author ?></li><?php
}
?>
    </ul>

    <a href="/">back</a>
</body>
</html>
