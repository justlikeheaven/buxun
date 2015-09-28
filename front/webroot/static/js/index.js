/*banner轮播*/
$(document).ready(function () {

    //动态加载
    $(".scrollLoading").scrollLoading();

    //鼠标经过切换图片
    $(".hot-pro ul li").hover(function () {
        $(this).find('.bg').show();

    }, function () {
        $(this).find('.bg').hide();
    })

    $(".new-pro-r ul li").hover(function () {
        $(this).find('.bg').show();

    }, function () {
        $(this).find('.bg').hide();

    })
});


$(function () {
    function showbg(src) {
        var index = $("#flashs .btn span").index($("#flashs .btn span.cur"));
        if (index < 0) {
            index = 0
        }
        $("#flashs .btn span.cur").css("opacity", 0.7).removeClass("cur");
        $("#flashbg" + index).css({ "opacity": 1, "z-index": 1 });
        $("#flashbg" + showIndex).css({ "z-index": 2 });
        $("#flashbg" + showIndex).animate({ opacity: 1 }, 0);
        $("#flashs .btn span").eq(showIndex).css("opacity", 1).addClass("cur")
    }

    var showIndex = 1;
    var h = $("#flashs div.bgitem").css("opacity", 0).length;
    var btn = "<div class='btn'>";
    for (var i = 0; i < h; i++) {
        btn += "<span>" + (i + 1) + "</span>"
    }
    btn += "</div>";
    $("#flashs").append(btn);
    $(document).ready(function () {
        $("#flashs .btn span").css("opacity", 0.7).mouseenter(function () {
            showIndex = $("#flashs .btn span").index(this);
            showbg(showIndex)
        }).eq(0).trigger("mouseenter");
        $("#flashs").hover(function () {
            clearInterval(picTimer)
        }, function () {
            picTimer = setInterval(function () {
                showIndex++;
                if (showIndex == h) {
                    showIndex = 0
                }
                showbg(showIndex)
            }, 5000)
        }).eq(0).trigger("mouseleave")
    });

    function lazyLoad(obj) {
        $(document).ready(function () {
            $("." + obj + " div").each(function (i, o) {
                $(this).css("background", "url(" + $(this).attr("src") + ") no-repeat center bottom")
            })
        });
        var oo = $("." + obj + " div:eq(0)");
        oo.css("background", "url(" + oo.attr("src") + ") no-repeat center bottom")
    }
    
    lazyLoad("ban_bg");



});