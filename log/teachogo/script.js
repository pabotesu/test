$(function () {
    //**************INDEX.PHP********************************************************/
    //自動的にスクロールする
    //$("html,body").delay(1000).animate({scrollTop: $(".tableTitle").offset().top},1000);
    
    //1.課題IDを入力する瞬間に既存のIDをチェックしながら課題名の空欄を無効化するかしないかを判断する
    //2.空欄に正しく埋め込んだら送信ボタンを使用可能にする
    //3.ボタンの無効化処理
    
    $("input[name='createTable']").prop("disabled", true);
    $inpKadai = $("input[name='kadaiName']");
    $inpKadaiID = $("input[name='kadaiID']");
    $inpTable = $("input[type='submit']");
    
    $inpKadaiID.on("input",function () {
        $input_1 = $(this).val();
        if ($input_1 == '') {
            $("input[name='createTable']").prop("disabled", true);
            $inpKadai.val('');
            $inpKadai.prop("readonly", false);
            $inpTable.val("新規作成");
        }
        else{
            $index = 0;
            $flag = false;
            $(".id").each(function (index) {
                if ($(this).text() == $input_1) {
                    $flag = true;
                    $index = index; //IDがテーブルに存在することで、インデックスを取得する
                }
            });
            if ($flag) {
                $classIndex = "eq(" + $index + ")"; //現在マッチしている要素をインデックス番号でフィルタリングします。
                $selector = ".testName:" + $classIndex; //$selector変数にCSSのセレクターを格納する
                $inpKadai.prop("readonly", $flag);
                $inpKadai.val($($selector).text());
                /***************************************/
                $input_2 = $inpKadai.val();
                $inpTable.val("追加"); //ボタンの名前を’新規作成’から’追加’に変換する
                /***************************************/
            }
            else{
                $inpKadai.val('');
                $inpKadai.prop("readonly", $flag);
            }
            if($(this).val() != '' && $inpKadai.val() != ''){
                $inpTable.prop("disabled",false);
            }
            else{
                $inpTable.prop("disabled",true);
            }
        }
    });
    
    $inpKadai.on("input",function(){
        if($(this).val() != '' && $inpKadaiID.val() != ''){
            $inpTable.prop("disabled",false);
        }
        else{
            $inpTable.prop("disabled",true);
        }
    });
    
    $("input[type='file']").change(function () {
        $fileName = $(this).val();
        $(".readOnly").val($fileName);
    });
    $(".id").click(function(){
        $text = $(this).text();
        $inpKadaiID.val($text);
        $inpKadaiID.trigger("input");
    });
    $("#fill").hide();
    $(".downButton p").click(function(){
        $("#fill").toggle("slow",function(){
            $("body").animate({
                scrollTop: $("#fill").offset().top
            }, 1000);
        });
    })
    /***************************CHECKBOX**********************************/
    
    
    //checkbox操作
    $(".check").change(function () {
        if ($(".check:checked").length > 0) {
            $('#deleteHandler').show();
        } else {
            $('#deleteHandler').hide();
        }
    });
    $("#allChecked").change(function () {
        if ($(this).prop("checked") == true) {
            $('.check').prop("checked", true);
            $('#deleteHandler').show();
        } else {
            $('.check').prop("checked", false);
            $('#deleteHandler').hide();
        }
    });
    
    
    /***************************DELETEボタンを押したとき**********************************/
    
    
    $('#deleteHandler').click(function () {
        $confirm = confirm("削除しますか？");
        if($confirm){
            $(".submitForm").submit();
        }
        else{
            $(".check").prop("checked",false);
            $("#allChecked").prop("checked",false);
            $("#deleteHandler").hide();
        }
    });
    
    
    /***************************UPDATE TABLE**************************************************/
    
    
    $updateTable = $("input[type='submit']");
    $("textarea").on("keydown",function(){
        if($(this).val().length){
            $updateTable.prop("disabled",false);
        }
    });
    $("input[type='number']").change(function(){
        $updateTable.prop("disabled",false);
    })
    $("#modoru").submit(function(){
        if(!$updateTable.prop("disabled")){
            $confirm = confirm("保存せずに戻りますか。");
            if($confirm){
                return true;
            }
            else{
                return false;
            }
        }
    });
})
