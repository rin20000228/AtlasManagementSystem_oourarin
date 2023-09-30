$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
    $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
    $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
  });
});
