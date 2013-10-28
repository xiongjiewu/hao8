;
(function ($) {
    var init = {
        post_submit:function(){
            var title = $.trim($("#title").val());
            var content = $.trim($("#content").val());
            if (!title || (title == undefined)) {
                alert("请输入标题!");
                return false;
            }
            if (!content || (content == undefined)) {
                alert("请输入内容!");
                return false;
            }
            return true;
        }
    };
    $(document).ready(function () {
        $("#edit_feedback").submit(function () {
            return init.post_submit();
        });
        $(document).keydown(function (event) {
            event = event || window.event;
            var e = event.keyCode || event.which;
            if (e == 13 && event.ctrlKey == true) {
                return $("#create_post_button").trigger("click");
            }
        });
    })
})(jQuery);