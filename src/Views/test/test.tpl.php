<h2>Test
    <?= $id ?>
</h2>

<?php

$filter = isset($_GET['filter']);

?>

<form id="searchForm" action="" method="get">
    <select name="filter" id="filter">
        <option value="name" <?= $filter && $_GET['filter'] == 'name' ? 'selected' : '' ?>>Name</option>
        <option value="price" <?= $filter && $_GET['filter'] == 'price' ? 'selected' : '' ?>>Price</option>
        <option value="test" <?= $filter && $_GET['filter'] == 'test' ? 'selected' : '' ?>>Test</option>
    </select>
</form>



<script>
    document.getElementById('filter').addEventListener('change', () => {
        document.getElementById("searchForm").submit();
    });
</script>