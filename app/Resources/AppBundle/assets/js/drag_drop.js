
function dragStart(ev) {
    ev.DataTransfer.effectAllowed='move';
    ev.DataTransfer.setData("Text", ev.target.getAttribute('id'));
    ev.DataTransfer.setDragImage(ev.target, 100, 100);
    return true;
}

function dragEnter(ev) {
    ev.preventDefault();
    return true;
}

function dragOver(ev) {
    ev.preventDefault();
}
