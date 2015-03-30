<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>
<div class="dataTables_paginate paging_bootstrap pagination">
    <ul class="pagination">
    {{ $presenter->render() }}
    </ul>
</div>