$(document).ready(function () {
    $("#closeSearch").click(function () {
        $(".search-modal").css("top", "-1000%");
        $(".search-modal").css("transition", "1.8s");
        $(".blur").css("display", "none");
    });
});


