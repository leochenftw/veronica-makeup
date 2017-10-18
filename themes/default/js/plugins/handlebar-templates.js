Handlebars.registerHelper('ifEqual', function(a, b, options) {
    if(a === b) {
        return options.fn(this);
    }
    return options.inverse(this);
});

var galleryItem     =  '{{#each list}}\
                        <a href="{{full}}" target="_blank" class="gallery-item__link {{category}}" data-lightbox="gallery">\
                            <img class="gallery-item__thumbnail" src="{{thumb}}" />\
                        </a>\
                        {{/each}}';
