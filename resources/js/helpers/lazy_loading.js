export default function loadAssets(tag) {

    var assetDefer = document.getElementsByTagName(tag);
    for (var i = 0; i < assetDefer.length; i++) {
        if (assetDefer[i].getAttribute('data-src')) {
            assetDefer[i].setAttribute('src', assetDefer[i].getAttribute('data-src'));
        }
    }
}


