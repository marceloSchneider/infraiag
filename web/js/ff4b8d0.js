var $collectionHolder;
// setup an "add a switchs" link
var $addSwitchLink = $('<a href="#" class="add_switchs_link">Adcionar switch</a>');
var $newLinkLi = $('<li></li>').append($addSwitchLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of switchss
    $collectionHolder = $('ul.switchs'); 
    // add the "add a switchs" anchor and li to the switchss ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addSwitchLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new switchs form (see next code block)
        addSwitchForm($collectionHolder, $newLinkLi);
    });
});

function addSwitchForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a switchs" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}
$('#iag_switchbundle_switchs_hostname').focusout(function(){
    $values = this.value.split('_');    
    $modelo = $values[2];
    $('#iag_switchbundle_switchs_marca').val($modelo);
});
