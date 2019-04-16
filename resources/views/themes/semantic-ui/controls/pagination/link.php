<?php if ($isCurrent): ?>
    <a class="item" id="<?=$pageNumber?>" style="color: red;"><?=$title?></a>
<?php else: ?>
    <a class="item" id="<?=$pageNumber?>"><?=$title?></a>
<?php endif?>
