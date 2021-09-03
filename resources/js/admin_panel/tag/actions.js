import tag from './tag'

export function setData(data) {

    tag.setId(data.id);
    tag.setTag(data.tag[appLocale]);
    tag.setDeletedAt(data.deleted_at);

}




export function fillForm(action) {

    document.getElementById("tagForm").reset();
    $("#modalTitle").text(action);
    $("#txtTag").val(tag.tag);
    $("#tagModal").modal("show");

    const httpMethod = tag.id === null ? 'POST' : 'PATCH';
    $('input[name=_method]').val(httpMethod);
}
