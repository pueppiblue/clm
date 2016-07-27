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

function animateItem(listItem) {
    var itemChild = listItem.children();
    //new item animation
    console.log(listItem);
    if (itemChild.hasClass('new-item')) {
        itemChild.addClass('removed-item');
        console.log('Start remove animation');
        // itemChild.removeClass('new-item');
    } else {
        itemChild.addClass('new-item');
    }

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

function addItemToRoster(listItem) {
    var listRoster = $('.js-list-roster');
    var listClone = listItem.clone();
    listClone.children().addClass('new-item');
    console.log(listClone.children());
    listRoster.append(listClone);
}

function removeItemFromRoster(listItem) {
    var listRoster = $('.js-list-roster');
    var characterId = listItem.data('character-id');
    var clonedItem = listRoster.find("[data-character-id='"  +
        characterId + "']");
    clonedItem.children().removeClass('new-item');
    clonedItem.children().addClass('removed-item');
    setTimeout(function(){clonedItem.remove()}, 1000);
}