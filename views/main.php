<html>
<head>
<title><?php echo $data["main"]["title"]?></title>
<style>
<?php include_once $data["main"]["StyleFile"]?>
</style>
</head>
<body>
    <div class="header"><?php echo $data["main"]["header"]?></div>
    <div class="menu"><?php echo $data["main"]["menu"]?></div>
    <div class="subview">
        <?php
            if (isset($data["subdata"])) {
                $filename = '/'.$data["subdata"]['model'].'.php';//? przydałbysię pasek postępu
                if (!file_exists($filename)) {
                    if (isset($data["subdata"][$data["subdata"]['model']]['content']['parent'])) {
                        $filename = '/'.$data["subdata"][$data["subdata"]['model']]['content']['parent'].'.php';
                        require_once($filename);
                    }
                } else {
                    require_once($filename);
                }
            } else {
                echo $data["main"]["content"];
            }
        ?>
    </div>
    <div class="footer"><?php echo $data["main"]["footer"]?></div>
</body>
</html>