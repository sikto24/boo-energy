jQuery(document).ready(function ($) {
  $('#filter-tabs a').on('click', function (e) {
    e.preventDefault();
    $('#filter-tabs a').removeClass('search-filter-active');
    $(this).addClass('search-filter-active');

    const postType = $(this).data('post-type');
    const searchQuery = $('#search-input').val();
    console.log('Captured Search Query:', searchQuery);

    $.ajax({
      url: boo_search_ajax.ajax_url,
      type: 'POST',
      data: {
        action: 'boo_filter_posts',
        post_type: postType,
        search_query: searchQuery,
        page: 1
      },
      beforeSend: function () {
        $('#search-results-container').html('<p>Loading...</p>');
      },
      success: function (response) {
        if (response.success) {
          $('#search-results-container').html(response.data.results);
          console.log('Search Query: ' + response.data.search_query); // Log the search query
        } else {
          $('#search-results-container').html('<p>No results found.</p>');
        }
      },
      error: function () {
        $('#search-results-container').html(
          '<p>An error occurred. Please try again.</p>'
        );
      }
    });
  });

  // Handle pagination clicks
  $(document).on('click', '.search-pagination a', function (e) {
    e.preventDefault();
    const postType = $('#filter-tabs .search-filter-active').data('post-type');
    const page = $(this).attr('href').split('paged=')[1] || 1;
    const searchQuery = $('#search-input').val();

    console.log('Post Type:', postType);
    console.log('Search Query:', searchQuery);
    console.log('Page:', page);

    // AJAX call to fetch filtered posts
    $.ajax({
      url: boo_search_ajax.ajax_url, // The AJAX URL defined in your WordPress setup
      type: 'POST',
      data: {
        action: 'boo_filter_posts', // The action hook to handle the request in PHP
        security: boo_search_ajax.nonce, // Security nonce for verification
        post_type: postType,
        search_query: searchQuery,
        page: page
      },
      beforeSend: function () {
        // Show a loading message while fetching data
        $('#search-results-container').html('<p>Loading...</p>');
      },
      success: function (response) {
        // Update the results and pagination dynamically based on the response
        if (response.success) {
          $('#search-results-container').html(response.data.results);
          $('#pagination-container').html(response.data.pagination); // Insert pagination HTML
        } else {
          $('#search-results-container').html('<p>No results found.</p>');
          $('#pagination-container').html(''); // Clear pagination if no results
        }
      },
      error: function () {
        // Handle errors gracefully
        $('#search-results-container').html(
          '<p>An error occurred. Please try again.</p>'
        );
      }
    });
  });
});
