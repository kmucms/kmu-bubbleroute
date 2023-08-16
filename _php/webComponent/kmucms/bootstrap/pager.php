<?php
/** @var \kmucms\uipages\PageComponent $this */
$page = intval($this->getData('page'));
$pagesCount = intval($this->getData('pagesCount'));
if($pagesCount<2){
  return;
}
?>

<nav>
  <ul class="pagination justify-content-center">
    <li class="page-item  <?=$page == 1? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?=$page-1?>"  <?=$page == 1? 'tabindex="-1" aria-disabled="true"' : '' ?> ><i class="bi bi-arrow-left"></i></a>
    </li>
    <?php for ($x = 1; $x <= $pagesCount; $x++): ?>
      <li class="page-item <?=$x==$page?'active':''?>"><a class="page-link" href="?page=<?=$x?>"><?= $x ?></a></li>
    <?php endfor; ?>
    <li class="page-item  <?=$page == $pagesCount ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?=$page+1?>" <?=$page == $pagesCount? 'tabindex="-1" aria-disabled="true"' : '' ?>><i class="bi bi-arrow-right"></i></a>
    </li>
  </ul>
</nav>
