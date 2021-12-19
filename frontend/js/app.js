
 /**
   * nav bar
   */
$(".navbar-nav .nav-item").click(function () {
    if (!$(this).hasClass("active"))
        $(this).addClass("active").siblings().removeClass("active");

    $("body, html").animate({
        scrollTop:$($(this).data("section")).offset().top
    }, 800);


});
$(".navbar").navBarScrolling();

/**
 * to top
 */
$(".to-top,.header i.fa-arrow-down").navigator();

/**
* Plugins Triggers
*/
// touch slider
$('#sliders').touchSlider({
    controls: false,
    paging: false,
    btn_prev: $("#sliders").next().find('.prev'),
    btn_next: $("#sliders").next().find('.next'),
    initComplete: function(e) {
      var _this = this, paging = '', len = Math.ceil(this._len / this._view),i;
      for(i = 1; i <= len; i++)
          paging += '<span class="single-pager"></span>';

      $(this).next().find('.pager').html(paging).find('.single-pager').on('click', function(e) {
          _this.go_page($(this).index());
      });
    },
    counter: function(e) {
      $(this).next().find('.single-pager').removeClass('active').eq(e.current-1).addClass('active');
      $(this).next().find('.slider-count').html('current : ' + e.current + ', total : ' + e.total);
    },
    autoplay: {
      enable: true,
      pauseHover: true,
      addHoverTarget: '', // 다른 오버영역 추가 ex) '.someBtn, .someContainer'
      interval: 3500
    },
    height: "500px"
});

/**
* Counter Section
*/
function inVisible(element) {
  //Checking if the element is
  //visible in the viewport
  var WindowTop = $(window).scrollTop();
  var WindowBottom = WindowTop + $(window).height();
  var ElementTop = element.offset().top;
  var ElementBottom = ElementTop + element.height();
  //animating the element if it is
  //visible in the viewport
  if ((ElementBottom <= WindowBottom) && ElementTop >= WindowTop)
    animate(element);
}

function animate(element) {
  //Animating the element if not animated before
  if (!element.hasClass('ms-animated')) {
    var maxval = element.data('max');
    var html = element.html();
    element.addClass("ms-animated");
    $({
      countNum: element.html()
    }).animate({
      countNum: maxval
    }, {
      //duration 5 seconds
      duration: 5000,
      easing: 'linear',
      step: function() {
        element.html(Math.floor(this.countNum) + html);
      },
      complete: function() {
        element.html(this.countNum + html);
      }
    });
  }

}

//When the document is ready
$(function() {
  //This is triggered when the
  //user scrolls the page
  $(window).scroll(function() {
    //Checking if each items to animate are
    //visible in the viewport
    $("h2[data-max]").each(function() {
      inVisible($(this));
    });
  })
});
