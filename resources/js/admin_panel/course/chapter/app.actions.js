export function openModal(action) {


    $('#textModalTitleChapter').text(action === 'create' ? 'Agregar Capítulo' : 'Actualizar Capítulo');
    $('#btnTextModalChapter').html('<i class="fas fa-plus text-dark"></i> ' + (action === 'create' ? 'Agregar' : 'Actualizar'));
    $('input[name=_method]').val(action === 'create' ? 'POST' : 'PATCH');
    $('#frmAddChapter').parsley().reset();
    $('#chapterModal').modal('show');

}


export function fillForm(chapter, chapterElement) {

    const chapterIcon = chapter.icon === null ? 'https://cdn.veltacorp.com/img/placeholder.svg' : chapter.icon;

    $('#txtChapterId').val(chapter.id);
    $('input[name=parent_node_id]').val(chapterElement.data('parent_node'));
    $('input[name=parent_course_id]').val(chapter.parent_course_id);
    $('input[name=title]').val(chapter.title);
    $('input[name=url]').val(chapter.video_link);
    $('textarea[name=description]').val(chapter.description);
    $('textarea[name=description]').siblings('label').addClass('active');
    $('#imgThumbnail').attr('src', chapterIcon);

    $('#txtAppendChapterTo').val(chapterElement.data('chapters_container'));
    $('#txtReRenderChapter').val(chapterElement.data('chapter_element'));


}


export function updateCounter(nodeId, quantity) {

    const chapterCountElement = $('#count' + nodeId);

    console.log(nodeId);

    let chapterCount = parseInt(chapterCountElement.text());

    chapterCount += quantity;
    chapterCountElement.text(chapterCount);
}

