$(function () {
    // var executed;
    // $(window).scroll(function(){
    //     if($(this).scrollTop() > $("#graph-content").offset().top-500){
    //         $(".chart").show("slow");
    //         activator();
    //     }
    //     else{
    //         $(".chart").hide();
    //         executed = false;
    //     }
    // })
    // //一階しか実行させない
    // var activator = (function(){
    //     return function(){
    //         if(!executed){
    //             executed = true;
    //             activateScene2();
    //         }
    //     }
    // })();
    activateScene2();
    // Scene 2 を表示
    function activateScene2() {

        var $content = $('#graph-content'),
            $charts = $content.find('.chart');

        // コンテンツが右から出てくる
        $content.stop(true).animate({
            right: 0
        }, 1200, 'easeInOutQuint');

        // 円チャートごとの処理
        $charts.each(function () {
            var $chart = $(this),
                // 「マスク」を保存し、角度 0 を指定
                $circleLeft = $chart.find('.left .circlogo-mask-inner')
                .css({
                    transform: 'rotate(0)'
                }),
                $circleRight = $chart.find('.right .circlogo-mask-inner')
                .css({
                    transform: 'rotate(0)'
                }),
                // パーセンテージ値を取得
                $percentNumber = $chart.find('.percent-number'),
                percentData = $percentNumber.text(),
                pnum = parseInt(percentData);
            $clogb = $(this).find('.circlogo-body');
            //背景の色を設定
            if(pnum < 50){
                $clogb.css('backgroundColor','red');
            }
            else if(pnum >=50 && pnum <90 ){
                $clogb.css('backgroundColor','orange');
            }
            else{
                $clogb.css('backgroundColor','green');
            }
            // パーセンテージの表示をいったん 0 に
            $percentNumber.text(0);

            // 角度のアニメーション
            $({
                percent: 0
            }).delay(1000).animate({
                percent: percentData
            }, {
                duration: 1000,
                progress: function () {
                    var now = this.percent,
                        deg = now * 360 / 100,
                        degRight = Math.min(Math.max(deg, 0), 180),
                        degLeft = Math.min(Math.max(deg - 180, 0), 180);
                    $circleRight.css({
                        transform: 'rotate(' + degRight + 'deg)'
                    });
                    $circleLeft.css({
                        transform: 'rotate(' + degLeft + 'deg)'
                    });
                    $percentNumber.text(Math.floor(now));
                }
            });
        });
        
    }
});
