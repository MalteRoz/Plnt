<?php if ($response['status'] === 'success' && isset($response['pagination'])): ?>
    <?php
    $pagination = $response['pagination'];
    $totalPages = $pagination['totalPages'];
    $currentPage = $pagination['currentPage'];

    $baseParams = $_GET;
    ?>

    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <?php
            $baseParams['page'] = $currentPage - 1;
            $prevQuery = http_build_query($baseParams);
            ?>
            <a href="?<?php echo $prevQuery; ?>" class="prev-btn">Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php
            $baseParams['page'] = $i;
            $pageQuery = http_build_query($baseParams);
            $activeClass = ($i === $currentPage) ? 'page-active' : '';
            ?>
            <a href="?<?php echo $pageQuery; ?>" class="page-btn <?php echo $activeClass; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <?php
            $baseParams['page'] = $currentPage + 1;
            $nextQuery = http_build_query($baseParams);
            ?>
            <a href="?<?php echo $nextQuery; ?>" class="next-btn">Next</a>
        <?php endif; ?>
    </div>
<?php endif; ?>