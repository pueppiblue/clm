$(window.document).ready(init);


function init() {
    var listElements = $('.js-list-account');
    listElements.on('click', function () {
        var element = $(this);
        switchListItemState(element);
        switchCardStyle(element);
    });
}

function switchCardStyle(element) {
    var cardItem = element.children();
    if (cardItem.hasClass('bg-secondary')) {
        cardItem.removeClass('bg-secondary');
    } else {
        cardItem.addClass('bg-secondary');
    }

    if (cardItem.hasClass('z-depth-1')) {
        cardItem.removeClass('z-depth-1');
        cardItem.addClass('z-depth-0');
    } else {
        cardItem.removeClass('z-depth-0');
        cardItem.addClass('z-depth-1');
    }
}

function switchListItemState(listItem) {
    var isInRoster = listItem.data('is-in-roster');
    if (isInRoster === false) {
        console.log('entered if statement');
        listItem.data('is-in-roster', true);
        addItemToRoster(listItem);
    } else {
        listItem.data('is-in-roster', false);
        removeItemFromRoster(listItem);
    }
}

function addItemToRoster(listItem) {
    var listRoster = $('.js-list-roster');
    console.log(listItem);
    // var itemClone = listItem.clone();
    // listElements.add(itemClone);
    listRoster.append(listItem.clone());

}

function removeItemFromRoster(listItem) {
    var listRoster = $('.js-list-roster');
    var characterId = listItem.data('character-id');
    var clonedItem = listRoster.find("[data-character-id='"  +
        characterId + "']");
    console.log(clonedItem);
    clonedItem.remove();
}