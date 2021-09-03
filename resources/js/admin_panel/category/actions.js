import category from './category'

export function setData(data) {

    category.setId(data.id);
    category.setCategory(data.category[appLocale]);
    category.setDeletedAt(data.deleted_at);

}




export function fillForm(action) {

    document.getElementById("categoryForm").reset();
    $("#modalTitle").text(action);
    $("#txtCategory").val(category.category);
    $("#categoryModal").modal("show");

    const httpMethod = category.id === null ? 'POST' : 'PATCH';
    $('input[name=_method]').val(httpMethod);
}
