export default function getQuestionsMenuHtml() {

    return `
        <span id="dragged-question"></span>
         <li class="handle">
            <a href="#question{{:#index}}" target="_self" class="collapsible-header waves-effect">
                <i class="fas fa-arrows-alt"></i> {^{:name}}
            </a>
        </li>
     
    `;

}
