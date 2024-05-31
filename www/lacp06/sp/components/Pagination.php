<?php

?>

<div class="pagination">
  <ul class="pagination" style="display: flex; flex-wrap: wrap;">
    <li class="page-item <?php echo $page == 1 ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?php echo $page - 1 ?>">Zpět</a>
    </li>
    <?php for ($i = 0; $i < $nPaginations; $i++) : ?>
      <li class="page-item <?php echo $page - 1 == $i ? 'active' : '' ?>"><a class="page-link" href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
    <?php endfor; ?>
    <li class="page-item <?php echo $page == $nPaginations ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?php echo $page + 1 ?>">Další</a>
    </li>
  </ul>
</div>