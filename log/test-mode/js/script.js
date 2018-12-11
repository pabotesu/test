$(function(){
    $(".closeBobox").click(function(){
        $(".boBox").hide("slow");
        $(".openBobox").show();
    });
    $(".openBobox").click(function(){
        $(".boBox").show("slow");
        $(this).hide();
    })
    /************採点する前に確認させます*************/
    $("input[name='seikai']").click(function(){
        $confirm = confirm("OKボタンを押したら、戻ることができないので、ご注意ください。");
        if($confirm){
            $("#saiten").submit();
        }
        else{
            return false;
        }
    })
})