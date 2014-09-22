/** Handler will be called when DOM will load and body will be available */
s(document.body).pageInit(function(body){
    btnDel();
    btnEdit();
});

/*
s('.delete').pageInit(function(delBtn){
    delBtn.ajaxClick(function(response){
        s('ul.gallery').html(response['html_list']);
        btnDel();
    });
});
*/

/*
// Событие загрузки формы добавления нового изображения
s('#addPhotoBtn').pageInit(function(btn){
    btn.ajaxClick(function(response){
        s('section#addNewPhotoSection').html(response['html_form']);
        addForm();
    });
});
*/


// Присваивание события форме добавления новых фотографий
s('#addPhotoForm').pageInit(function(form){
    //form.hide();
    form.ajaxSubmit(function(response){
        s('ul.gallery').html(response['html_list']);
        btnDel();
        btnEdit();
        console.log(s('#addPhotoForm>input'));
        //form.reset();
    });
});

// Присваивание события кнопкам сортировки
s('.sorter>a').pageInit(function(sortBtn){
    sortBtn.ajaxClick(function(response){
        s('ul.gallery').html(response['html_list']);
        btnDel();
        btnEdit();
    });
});

// Присваивание события кнопкам "Delete"
function btnDel(){
    s('a.delete').ajaxClick(function(response){
        s('ul.gallery').html(response['html_list']);
        btnDel();
        btnEdit();
    });
}

// Присваивание события кнопкам "Edit"
function btnEdit(){
    s('a.edit').ajaxClick(function(response){
        s('section#editFormSection').html(response['html_form']);
        editForm();
    });
}

// Присваивание асинхронного события форме редактирования
function editForm(){
    s('#editForm').ajaxSubmit(function(response){
        s('ul.gallery').html(response['html_list']);
        btnDel();
        btnEdit();
        s('#editForm').remove();
        //form.reset();
    });
}







