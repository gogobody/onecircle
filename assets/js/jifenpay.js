function callJifenPay() {
    if (typeof jQuery == "undefined") {
        var fileref = document.createElement("script")
        fileref.setAttribute("type", "text/javascript")
        fileref.setAttribute("src", "https://unpkg.zhimg.com/jquery@3.5.1/dist/jquery.min.js")
        document.getElementsByTagName("head")[0].appendChild(fileref)
    }

    $("#ds-box>.modal").toggleClass("show-modal");

}
window.JKPay={
    payType : ''
}
function yuePay() {
    $(this).addClass("picked");
    $("#yuepay").addClass("picked");
    $(this).parent().children("button").removeClass("picked");
    $("#chosePay").hide();
    $("#payBtn").show();
    window.JKPay.payType = 'yue'
}

function jinfenPay(action) {
    if (window.JKPay.payType){
        let pbtn = $(".pay-button button")
        pbtn.addClass("b2-loading")
        pbtn.attr('disable',true)
        $(".pay-button button span").css("opacity",0)
        $.post(action, {}, function (res) {
            if (res.code) {
                pbtn.removeClass("b2-loading")
                pbtn.attr('disable',false)
                $(".pay-button button span").css("opacity",1)
                $("#payBtn").text("支付成功，等待刷新")
                setTimeout(function () {
                    window.location.reload()
                },1000)
            } else {
                alert(res.msg)
            }
        })
    }

}