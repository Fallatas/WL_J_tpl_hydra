jQuery(document).ready(function () {
    var items = document.querySelectorAll('#menu li a.dropdown-toggle');
    myDataArray = [];
    var i = 1;
    items.forEach(function(element){

        //Filter
        if(element.href === 'http://localhost/projekte/wl_tpl_hydra/administrator/#'){
            element.setAttribute('id',  'element' + i++);
        }
    });
});