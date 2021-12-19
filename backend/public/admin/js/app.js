$(function () {

    /**
     * delete validate
     */
    $(".btn-delete").click(function () {
        let _this = $(this);
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: _this.data("url"),
                        data:{_token:_this.data("token")},
                        type: "DELETE",
                        dataType: "json",
                        success: function (result) {
                            if (result.status === 1) {
                                swal("the " + _this.data("name") + " deleted successfully", {
                                    icon: "success",
                                    timer: 1490
                                });
                                setTimeout(function () {
                                    location.reload()
                                }, 1500)
                            }
                        },
                        error:function (x,y) {
                            console.log(x,y);
                        }
                    });
                }
            });

    });


    /**
     * Set file uploaded in [img-el]
     */
    $(".upload").change(function() {
        previewImg(this, validate(this));
    });
});



/**
 * Preview img before upload it
 *
 * @param input
 * @param img
 */
function previewImg(input,img) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $(img).attr('src', e.target.result).show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * Validate Preview Image Selector
 *
 * @param selector
 * @returns {null|*|undefined|jQuery}
 */
function validate(selector) {
    return  $(selector).parent().prev().attr('id')
        ? '#' + $(selector).parent().prev().attr('id')
        : $(selector).parent().prev().attr('class')
            ? '.' + $(selector).parent().prev().attr('class')
            : '.preview-img';
}

