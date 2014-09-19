/** Handler will be called when DOM will load and body will be available */
s(document.body).pageInit(function(body){
    btnDel();
});

/*
s('.delete').pageInit(function(delBtn){
    delBtn.ajaxClick(function(response){
        s('ul.gallery').html(response['html_list']);
        btnDel();
    });
});
*/

// Присваивание события кнопкам "Delete"
function btnDel(){
    s('a.delete').ajaxClick(function(response){
        s('ul.gallery').html(response['html_list']);
        btnDel();
    });
}



