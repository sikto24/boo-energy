jQuery(document).ready(function ($) {
  const loadMoreBtn = $('#load-more-post-btn');
  let currentPage = 1;
  const maxPages = parseInt(loadMoreBtn.data('max-pages'), 10);

  loadMoreBtn.on('click', function (e) {
    e.preventDefault();
    currentPage++;

    if (currentPage <= maxPages) {
      $.ajax({
        url: boo_blog_ajax.ajax_url,
        type: 'POST',
        data: {
          action: 'load_more_posts',
          page: currentPage,
          nonce: boo_blog_ajax.nonce
        },
        beforeSend: function () {
          loadMoreBtn.text('Loading...').prop('disabled', true);
        },
        success: function (html) {
          $('#boo-load-more-posts').append(html);
          loadMoreBtn.text('Ladda fler').prop('disabled', false);

          if (currentPage >= maxPages) {
            loadMoreBtn.hide();
            console.log('Hide By Default Load More Js');
          } else {
            loadMoreBtn.show();
          }
        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
          loadMoreBtn.after(
            "<p class='error-message'>Failed to load more posts. Please try again.</p>"
          );
          loadMoreBtn.text('Ladda fler').prop('disabled', false);
        }
      });
    } else {
      loadMoreBtn.hide();
    }
  });
});
