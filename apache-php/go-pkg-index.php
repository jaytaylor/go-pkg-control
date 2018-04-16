<!doctype html>
<html>
<head>
    <title>golang packages - gigawatt.io</title>
    <meta charset="utf-8">
    <meta name="author" content="Jay Taylor">
    <meta name="description" content="gigawatt.io Public Go Packages">
</head>
<body>

Golang packages I created or maintain my own forks of:

    <ul style="list-style-type: none">
<?php
$pkgs = array(
    'web',
    'concurrency',
    'go-commons',
    'driver',
    'errorlib',
    'oslib',
    'testlib',
    'upstart',
    'diskqueue',
    'bindatafs',
    'zklib',
    'gentle',
    'netlib',
    'metaflector',
    'awsarn',
    'window',
    'ago',
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
