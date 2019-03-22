$(document).ready(function(){
    $(".myfavorposts").easyPaginate({
        paginateElement: 'li',
        elementsPerPage: 10,
        effect: 'climb'
    });
});