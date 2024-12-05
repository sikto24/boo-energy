jQuery(document).ready(function ($) {
  function BooAktuellDriftstatus() {
    const contactArea = '.single-notification-result-main'; // Selector
    $('.single-notification-contact-area')
      .off('click')
      .on('click', function (e) {
        e.preventDefault();
        $(this).siblings(contactArea).slideToggle(300);
      });
  }

  $('.tab-area-filter-main .tab-filter').on('click', function (e) {
    e.preventDefault();
    $('.tab-area-filter-main .tab-filter').removeClass('tab-filter-active');
    $(this).addClass('tab-filter-active');

    const dataStatus = $(this).data('status');
    const dataMockup = $('#notification-results');
    $.ajax({
      url: booajaxurl.ajax_url,
      type: 'POST',
      data: {
        action: 'filter_notifications',
        post_status: dataStatus,
        nonce: booajaxurl.nonce
      },
      beforeSend: function () {
        // dataMockup.html('<p>Loading...</p>');
      },
      success: function (response) {
        dataMockup.html(response);
        BooAktuellDriftstatus();
        if (dataStatus == 'draft') {
          dataMockup.addClass('draft-disable');
        } else {
          dataMockup.removeClass('draft-disable');
        }
      },
      error: function () {
        dataMockup.html(
          '<p class="error">An error occurred. Please try again.</p>'
        );
      }
    });
  });

  BooAktuellDriftstatus();
});