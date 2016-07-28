$(window.document).ready(init);

function init() {
    var listElements = $('.js-list-account');
    listElements.on('click', function () {
        var element = $(this);
        switchListItemState(element);
        switchCardStyle(element);
    });
}

function rotate(element) {
    element.classList.toggle('ani-rotate');
}

function switchListItemState(listItem) {
    var isInRoster = listItem.data('is-in-roster');
    if (isInRoster === false) {
        listItem.data('is-in-roster', true);
        addItemToRoster(listItem);
    } else {
        listItem.data('is-in-roster', false);
        removeItemFromRoster(listItem);
    }
}

function switchCardStyle(element) {
    var cardItem = element.children();
    if (cardItem.hasClass('bg-secondary')) {
        cardItem.removeClass('bg-secondary');
    } else {
        cardItem.addClass('bg-secondary');
    }

    // if (cardItem.hasClass('z-depth-1')) {
    //     cardItem.removeClass('z-depth-1');
    //     cardItem.addClass('z-depth-0');
    // } else {
    //     cardItem.removeClass('z-depth-0');
    //     cardItem.addClass('z-depth-1');
    // }
}

function addItemToRoster(listItem) {
    var listRoster = $('.js-list-roster');
    var clone = listItem.clone();

    // console.log(cloneDiv);
    listItem[0].firstElementChild.addEventListener('animationend', function() {
        listRoster.append(clone)
    });

    rotate(listItem[0].firstElementChild);
    // listClone.children().addClass('new-item');
}

function removeItemFromRoster(listItem) {
    var listRoster = $('.js-list-roster');
    var characterId = listItem.data('character-id');
    var clone = listRoster.find("[data-character-id='" +
        characterId + "']");
    // clone.children().removeClass('new-item');
    // clone.children().addClass('removed-item');
    clone.remove();
}
