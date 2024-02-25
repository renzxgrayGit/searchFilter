<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/assets/index.css">
		<title>Search Filter</title>
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script>
			$(document).ready(function() {
				/* Function to load all data when the page first loads */
				function loadAllData() {
					$.get('/searches/index_html', function(res) {
						$('#items_table').html(res);
					});
				}

				/* Load all data when the page first loads */
				loadAllData();

				/* Send AJAX request only when the search input is not empty */
				$('#search, #min, #max').on('input', function() {
					var searchTerm = $(this).val();
					
					if (searchTerm.trim() !== '') {
						$.ajax({
							type: 'POST',
							url: '/searches/index_html_filtered',
							data: {search: searchTerm},
							success: function(res) {
								$('#items_table').html(res);
							}
						});
					} else {
						// If the search input is empty, load all data
						loadAllData();
					}
				});

				/* Send AJAX request when the select option changes */
				$('#price_levels').on('change', function() {
					var selectedOption = $(this).val();
					var searchTerm = $('#search').val(); // Get the current search term
					var minPrice = $('#min').val(); // Retrieve min price
					var maxPrice = $('#max').val(); // Retrieve max price

					var dataToSend = { 
						search: searchTerm, 
						sort_order: selectedOption,
						min: minPrice, // Include min price in the data
						max: maxPrice  // Include max price in the data
					};


					$.ajax({
						type: 'POST',
						url: '/searches/index_html_sorted',
						data: dataToSend,
						success: function(res) {
							$('#items_table').html(res);
						}
					});
				});
			});
		</script>
	</head>
	<body>
		<div class='container'>
			<div class='search_form'>
				<form action='' method='post'>
					<input type='search' id='search' name='search' placeholder='Search by name'>
					<input type='number' id='min' name='min' placeholder='Minimum price' >
					<input type='number' id='max' name='max' placeholder='Maximum price'> 
					<select id='price_levels' name='price_levels'>
						<option value="Low_to_High">Low to High Price</option>
						<option value="High_to_Low">High to Low Price</option>
					</select>
				</form>
			</div>
			<div id='table'>
				<table>
					<thead>
						<tr>
							<th>Item name</th>
							<th>Number of stock</th>
							<th>Price</th>
							<th>Date added</th>
						</tr>
					</thead>
					<tbody id='items_table'>
						<!-- partials/items.php will be loaded here -->
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>