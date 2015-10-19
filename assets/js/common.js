/**
 * Created by turko_v on 19.10.2015.
 */
$("document").ready(function(){

    $("#annSearchForm").on("pjax:end", function() {
        $.pjax.reload({container:"#listview", timeout: 2000});  //Reload GridView
    });
    $("#searchByCat").on("pjax:end", function() {
        $.pjax.reload({container:"#listview", timeout: 2000});  //Reload GridView
    });

    // for display status onload process
    $("#listview").on("pjax:start", function(){
        //$(".onload").css({"display":"inline-block"});
        $(".onload").addClass("onload-visible");
        //$(".search").addClass("onloadBtn");
    });
    $("#listview").on("pjax:end", function(){
        //$(".onload").css({"display":"none"});
        $(".onload").removeClass("onload-visible");
        //$(".search").removeClass("onloadBtn");
    });

});