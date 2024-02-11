$(document).ready(function() {
  // Navigate to index.html when clicking on the logo or home button
  $('.navbar-brand, .nav-link[href="index.html"]').click(function(event) {
    event.preventDefault();
    window.location.href = 'index.html';
  });

  // Navigate to anchor links on the same page (scroll to section)
  $('.nav-link[href^="#"]').click(function(event) {
    event.preventDefault();
    var target = $(this).attr('href');
    $('html, body').animate({
      scrollTop: $(target).offset().top
    }, 1000);
  });

  // For blog.html, prevent default behavior
  // This allows the links to work as expected on blog.html
  if (window.location.href.includes("blog.html")) {
    $('.nav-link').click(function(event) {
      event.preventDefault();
      var target = $(this).attr('href');
      window.location.href = target;
    });
  }
});
