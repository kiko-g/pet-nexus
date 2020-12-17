<?php


	function paginate_query($append, $cur_page, $num_elements_in_page){
		$start_element = $cur_page * $num_elements_in_page;
		$end_element = $start_element + $num_elements_in_page + 1;
		return $append . ' LIMIT ' . $start_element. ' ,  ' . $end_element;
	}

	function generate_pagination_bottom($page, $returned_elements, $num_elements){
?>
		<a href="cona.php">&lt;</a>
		<?= $page ?>
		<a href="cona.php">&gt;</a>

<?php
	}


?>
