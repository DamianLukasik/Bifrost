<?php
if (isset($data[$data["params"]['page']]["content"]['title'])) {
    ?><h2><?php echo $data[$data["params"]['page']]["content"]['title'];?></h2><?php
}
?>
<div class="wrapper">
    <?php if (isset($data[$data["params"]['page']]["content"])) {
        ?><div class="table"><div class="row header <?php echo $data[$data["params"]['page']]["content"]['color']; ?>"><?php
            if (isset($data[$data["params"]['page']]["content"]['header'])) {
                foreach ($data[$data["params"]['page']]["content"]['header'][$data[$data["params"]['page']]["content"]['color']] as $head) {
                    ?><div class="cell"><?php echo $head; ?></div><?php
                }
            }?></div><?php
            if (isset($data[$data["params"]['page']]["content"]["rows"])) {
                foreach ($data[$data["params"]['page']]["content"]["rows"] as $cells) {
                ?><div class="row"><?php
                    foreach ($cells as $key => $cell) {
                        ?><div class="cell" <?php echo 'data-title="'.$key.'"'; ?> ><?php echo $cell; ?></div><?php
                    }
                ?></div><?php
                }
            }
        ?></div><?php
    } ?>
</div>