(function ($) {

    /**
     * slider
     *
     * @param settings
     */
    $.fn.autoSlide = function(settings){
        let options = $.extend({
            delay: 3500,
            fadeIn: 2000,
            fadeOut: 2000
        }, settings), _this = this;

        (function sliders() {
            // console.log($(_this).find(".active"));
            $(_this).find(".active").each(function () {
                if(!$(this).is(":last-child"))
                    $(this).delay(options.delay).fadeOut(options.fadeOut,function () {
                        $(this).removeClass("active").addClass("close").next().addClass("active").fadeIn(options.fadeIn).prev().removeClass("close");
                        sliders()
                    });
                else
                    $(this).delay(options.delay).fadeOut(options.fadeOut,function () {
                        $(this).removeClass("active").addClass("close").delay(1500).removeClass("close");
                        $(_this).find(" div:first-child").addClass("active").fadeIn(options.fadeIn);
                        sliders()
                    })
            })
        }());
    };

    /**
     * scroll to elements
     *
     * @param settings
     */
    $.fn.navigator = function(settings){
        let options = $.extend({
            delay: 500,
            class: "section"
        }, settings);

        $(this).click(function () {
            $("body, html").animate({
                scrollTop:$($(this).data("section")).offset().top
            }, options.delay);
        });

    };


    /**
     * make nav bar fixed
     *
     * @param settings
     */
    $.fn.navBarScrolling = function(settings){
        let options = $.extend({
            delay: 1000,
            class: "section",
            toTop: ".to-top"
        }, settings), _this = $(this);

        $(window).scroll(function () {

            ($(this).scrollTop() > ($(this).height()))
                ? $(options.toTop).show("slow")
                : $(options.toTop).hide("slow");

            if ($(this).scrollTop() > 150){
                $(_this).addClass("scrolling").removeClass("no-scrolling")
            }else{
                $(_this).addClass("no-scrolling").removeClass("scrolling")
            }
        });



    }

}(jQuery ));