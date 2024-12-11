jQuery(document).ready(function ($) {
  const loadMorebtnCta = $('.load-more-btn-posts-frist');
  loadMorebtnCta.hide();
  var currentCategorySlug = '';
  // Filter Posts Ajax
  $('.post-filter-wrapper ul li a').on('click', function (e) {
    e.preventDefault();

    var categorySlug = $(this).data('slug');
    currentCategorySlug = categorySlug;
    let targetContainer = $('#blog-postbox-main');
    let action = categorySlug === 'all' ? 'load_all_posts' : 'filter_posts';
    $.ajax({
      url: boo_posts_ajax_params.ajax_url,
      type: 'POST',
      data: {
        action: action,
        category_slug: categorySlug,
        nonce: boo_posts_ajax_params.nonce
      },
      beforeSend: function () {
        targetContainer.html('');
      },
      success: function (response) {
        $('#boo-load-more-posts , .load-more-btn-posts-second').hide();

        targetContainer.html(response);
        loadMorePostCat();
        loadMorebtnCta.show();
        if (categorySlug === 'all') {
          $('#boo-load-more-posts , .load-more-btn-posts-second').show();
          loadMorebtnCta.hide();
        }
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error:', error);
      }
    });
  });
  // Categories Tag Active
  $('.post-filter-wrapper li:nth-child(1) a').addClass('boo-categories-active');
  $('.post-filter-wrapper li a').on('click', function (e) {
    e.preventDefault();
    $('.post-filter-wrapper li a').removeClass('boo-categories-active');
    $(this).addClass('boo-categories-active');
  });

  // Load More Posts on Categories

  function loadMorePostCat() {
    const loadMoreBtn = $('#load-more-post-cat');
    let currentPage = 1;
    const maxPages = parseInt(loadMoreBtn.data('max-pages'), 10);
    console.log(maxPages);
    loadMoreBtn.on('click', function (e) {
      e.preventDefault();
      currentPage++;
      if (currentCategorySlug) {
        if (currentPage <= maxPages) {
          $.ajax({
            url: boo_blog_ajax.ajax_url,
            type: 'POST',
            data: {
              action: 'load_more_posts',
              category_slug: currentCategorySlug,
              page: currentPage,
              nonce: boo_blog_ajax.nonce
            },
            beforeSend: function () {
              loadMoreBtn.text('Loading...').prop('disabled', true);
            },
            success: function (html) {
              console.log(currentCategorySlug);
              $('#blog-postbox-main').append(html);
              loadMoreBtn.text('Ladda fler').prop('disabled', false);

              if (currentPage >= maxPages) {
                loadMoreBtn.hide();
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
      } else {
        console.log('Categories Slug Not Found');
      }
    });
  }
});
