if(!('ontouchstart' in window)) {
    $('.social-network a').tooltip();
}
$(".latest-projects a").pageslide({ direction: "left" });
$('.clickmodal').on('click', function(){
    window.history.pushState(null, null, $(this).attr('href'));
});
$('.modal').on('hidden.bs.modal', function () {
    //$('.modal-content').html('');
    window.history.pushState(null, null, $('base').attr('href'));
});