jQuery(document).ready(function ($) {
  // Handle filter tab click
  $('#filter-tabs a').on('click', function (e) {
    e.preventDefault();

    // Update active class
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
        security: boo_search_ajax.nonce,
        post_type: postType,
        search_query: searchQuery, // Ensure the search term is included here
        page: 1 // Reset pagination
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
    const searchQuery = $('#searchform input[name="s"]').val();
    const page = $(this).attr('href').split('paged=')[1] || 1;

    $.ajax({
      url: boo_search_ajax.ajax_url,
      type: 'POST',
      data: {
        action: 'boo_filter_posts',
        security: boo_search_ajax.nonce,
        post_type: postType,
        search_query: searchQuery,
        page: page
      },
      beforeSend: function () {
        $('#search-results-container').html('<p>Loading...</p>');
      },
      success: function (response) {
        if (response.success) {
          $('#search-results-container').html(response.data.results);
          $('#pagination-container').html(response.data.pagination); // Insert pagination
        } else {
          $('#search-results-container').html('<p>No results found.</p>');
          $('#pagination-container').html(''); // No pagination if no results
        }
      },
      error: function () {
        $('#search-results-container').html(
          '<p>An error occurred. Please try again.</p>'
        );
      }
    });
  });
});
