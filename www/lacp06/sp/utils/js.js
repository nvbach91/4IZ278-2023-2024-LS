window.addEventListener("scroll", function () {
  if (window.scrollY > 0) {
    $(".back-button").show();
  } else {
    $(".back-button").hide();
  }
});

$(".back-button").on("click", function () {
  window.scrollTo(0, 0);
});

$("#world").on("change", function () {
  $("#book-filter").submit();
});

$("#genre").on("change", function () {
  $("#book-filter").submit();
});

$("#month").on("change", function () {
  $("#statistics").submit();
});

$("#year").on("change", function () {
  $("#statistics").submit();
});

$("#publisher").on("change", function () {
  $("#book-filter").submit();
});

$("#order").on("change", function () {
  $("#book-filter").submit();
});
