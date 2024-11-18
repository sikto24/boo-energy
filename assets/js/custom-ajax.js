jQuery(document).ready(function ($) {
  // When a category is clicked
  $('.post-filter-wrapper ul li a').on('click', function (e) {
    e.preventDefault(); // Prevent the default link behavior

    var categorySlug = $(this).data('slug'); // Get the category slug
    var targetContainer = $('#blog-postbox-main'); // The container where posts will be displayed

    // Start the AJAX request
    $.ajax({
      url: ajax_params.ajax_url, // The AJAX URL from localized script
      type: 'POST',
      data: {
        action: 'filter_posts',
        category_slug: categorySlug
      },
      beforeSend: function () {
        targetContainer.html('<p>Loading posts...</p>'); // Display loading text
      },
      success: function (response) {
        targetContainer.html(response); // Replace content with AJAX response
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error:', error);
      }
    });
  });
});
