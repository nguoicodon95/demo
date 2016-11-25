
(function($) {

    // Plugin
    $.fn.imagesGrid = function(options) {

        var args = arguments;

        return this.each(function() {

            if ($.isPlainObject(options)) {
                // Create ImagesGrid
                var cfg = $.extend({}, $.fn.imagesGrid.defaults, options);
                cfg.element = $(this);
                this._imgGrid = new ImagesGrid(cfg);
                this._imgGrid.render();
                return;
            }

            if (this._imgGrid) {
                switch (options) {
                    case 'modal.open':
                        this._imgGrid.modal.open(args[1]);
                        break;
                    case 'modal.close':
                        this._imgGrid.modal.close();
                        break;
                }
            }

        });

    };

    // Plugin default options
    $.fn.imagesGrid.defaults = {
        images: [],
        cells: 5,
        align: false,
        nextOnClick: true,
        getViewAllText: function(imagesCount) {
            return '+ ' + imagesCount +'';
        },
        onGridRendered: $.noop,
        onGridItemRendered: $.noop,
        onGridLoaded: $.noop,
        onGridImageLoaded: $.noop,
        onModalOpen: $.noop,
        onModalClose: $.noop,
        onModalImageClick: $.noop
    };

    /*
      ImagesGrid constructor
       *cfg         - Configuration object
       *cfg.element - jQuery element
       *cfg.images  - Array of images urls of images option objects
        cfg.align   - Aling diff-size images
        cfg.cells   - Max grid cells (1-6)
        cfg.getViewAllText     - Returns text for "view all images" link,
        cfg.onGridRendered     - Called when grid items added to the DOM
        cfg.onGridItemRendered - Called when grid item added to the DOM
        cfg.onGridLoaded       - Called when grid images loaded
        cfg.onGridImageLoaded  - Called when grid image loaded
    */
    function ImagesGrid(cfg) {

        cfg = cfg || {};

        this.images = cfg.images;
        this.isAlign = cfg.align;
        this.maxGridCells = (cfg.cells < 1)? 1: (cfg.cells > 6)? 6: cfg.cells;
        this.imageLoadCount = 0;
        this.modal = null;

        this.$window = $(window);
        this.$el = cfg.element;
        this.$gridItems = [];

        this.render = function() {

            this.setGridClass();
            this.renderGridItems();

            this.modal = new ImagesGridModal({
                images: cfg.images,
                nextOnClick: cfg.nextOnClick,
                onModalOpen: cfg.onModalOpen,
                onModalClose: cfg.onModalClose,
                onModalImageClick: cfg.onModalImageClick
            });

            this.$window.on('resize', this.resize.bind(this));

        };

        this.setGridClass = function() {

            this.$el.removeClass(function(index, classNames) {
                if (/(imgs-grid-\d)/.test(classNames)) {
                    return RegExp.$1;
                }
            });

            var cellsCount = (this.images.length > this.maxGridCells)?
                this.maxGridCells: this.images.length;

            this.$el.addClass('imgs-grid imgs-grid-' + cellsCount);

        };

        this.renderGridItems = function() {

            if (!this.images) {
                return;
            }

            console.log()

            this.$el.empty();
            this.$gridItems = [];

            this.$el.append('<div class="s-height"></div>');
            if(this.images.length > 2) {
                this.$el.append('<div class="f-height"></div>');
            } else {
                $('.s-height').css({
                    'height': '300px'
                });
            }

            for (var i = 0; i < this.images.length; ++i) {
                if (i == this.maxGridCells) {
                    break;
                }
                this.renderGridItem(this.images[i], i);
            }

            if (this.images.length > this.maxGridCells) {
                this.renderViewAll();
            }

            cfg.onGridRendered(this.$el);
            
            $('#cover-show').append(
                $('<div>', {
                    class: 'comboShow',
                    click: this.imageClick.bind(this),
                })
            );
        };

        this.renderGridItem = function(image, index) {

            var src = image,
                alt = '',
                title = '';

            if ($.isPlainObject(image)) {
                src = image.src;
                alt = image.alt || '';
                title = image.title || '';
            }

            var item = $('<div>', {
                class: 'imgs-grid-image',
                click: this.imageClick.bind(this),
                data: { index: index }
            });

            var self = this;

            item.append(
                $('<div>', {
                    class: 'image-wrap'
                }).append(
                    $('<img>', {
                        src: src,
                        alt: alt,
                        title: title,
                        load: function(event) {
                            self.imageLoaded(event, $(this), image);
                        }
                    })
                )
            );

            this.$gridItems.push(item);

            // this.$el.append(item);

            if(index < 3) {
                $('.s-height').append(item);
            }else {
                $('.f-height').append(item);
            }


            cfg.onGridItemRendered(item, image);

        };

        this.renderViewAll = function() {

            this.$el.find('.imgs-grid-image:last .image-wrap').append(
                $('<div>', {
                    class: 'view-all'
                }).append(
                    $('<span>', {
                        class: 'view-all-cover',
                    }),
                    $('<span>', {
                        class: 'view-all-text',
                        text: cfg.getViewAllText(this.images.length)
                    })
                )
            );

        };

        this.resize = function(event) {
            if (this.isAlign) {
                this.align();
            }
        };

        this.imageClick = function(event) {
            var imageIndex = $(event.currentTarget).data('index');
            this.modal.open(imageIndex);
        };

        this.imageLoaded = function(event, imageEl, image) {

            ++this.imageLoadCount;

            if (this.imageLoadCount == this.$gridItems.length) {
                this.imageLoadCount = 0;
                this.allImagesLoaded()
            }

            cfg.onGridImageLoaded(event, imageEl, image)

        };

        this.allImagesLoaded = function() {

            if (this.isAlign) {
                this.align();
            }

            cfg.onGridLoaded(this.$el);

        };

        this.align = function() {

            var len = this.$gridItems.length;

            switch (len) {
                case 2:
                case 3:
                    this.alignItems(this.$gridItems);
                    break;
                case 4:
                    this.alignItems(this.$gridItems.slice(0, 2));
                    this.alignItems(this.$gridItems.slice(2));
                    break;
                case 5:
                case 6:
                    this.alignItems(this.$gridItems.slice(0, 3));
                    this.alignItems(this.$gridItems.slice(3));
                    break;
            }

        };

        this.alignItems = function(items) {

            var height = items.map(function(item) {
                return item.find('img').height();
            });

            var itemHeight = Math.min.apply(null, height);

            $(items).each(function() {

                var item = $(this),
                    imgWrap = item.find('.image-wrap'),
                    img = item.find('img'),
                    imgHeight = img.height();

                imgWrap.height(itemHeight);

                if (imgHeight > itemHeight) {
                    var top = Math.floor((imgHeight - itemHeight) / 2);
                    img.css({ top: -top });
                }

            });

        };

    }

    /*
      ImagesGridModal constructor
       *cfg             - Configuration object
       *cfg.images      - Array of string or objects
        cfg.nextOnClick - Show next image when click on modal image
        cfg.onModalOpen       - Called when modal opened
        cfg.onModalClose      - Called when modal closed
        cfg.onModalImageClick - Called on modal image click
    */
    function ImagesGridModal(cfg) {

        this.images = cfg.images;
        this.imageIndex = null;

        this.$modal = null;
        this.$indicator = null;
        this.$document = $(document);

        this.open = function(imageIndex) {

            if (this.$modal && this.$modal.is(':visible')) {
                return;
            }

            this.imageIndex = parseInt(imageIndex) || 0;

            this.render();

        };

        this.close = function(event) {

            if (!this.$modal) {
                return;
            }

            this.$modal.animate({
                opacity: 0
            }, {
                duration: 100,
                complete: function() {

                    this.$modal.remove();
                    this.$modal = null;
                    this.$indicator = null;
                    this.imageIndex = null;

                    cfg.onModalClose();

                }.bind(this)
            });

            this.$document.off('keyup', this.keyUp);

        };

        this.render = function() {

            this.renderModal();
            this.renderCaption();
            this.renderCloseButton();
            this.renderInnerContainer();
            this.renderIndicatorContainer();

            this.keyUp = this.keyUp.bind(this);
            this.$document.on('keyup', this.keyUp);

            var self = this;

            this.$modal.animate({
                opacity: 1
            }, {
                duration: 100,
                complete: function() {
                    cfg.onModalOpen(self.$modal);
                }
            });

        };

        this.renderModal = function() {
            this.$modal = $('<div>', {
                class: 'imgs-grid-modal'
            }).appendTo('body');
        };

        this.renderCaption = function() {

            this.$caption = $('<div>', {
                class: 'SlideshowModalContent__controls'
                // text: this.getImageCaption(this.imageIndex)
            }).appendTo(this.$modal);

            this.$caption.append('<div class="SlideshowModalContent__controls-inner">'+
                '  <div class="SlideshowModalContent__share-save-controls">'+
                    '<div class="SlideshowModalContent__social-share-widget">'+
                      '<span class="share-title">'+
                        'Share:'+
                      '</span>'+
                        '<span class="share-triggers">'+
                        '<a class="share-btn link-icon" href="#">'+
                          '<span class="screen-reader-only">Email</span>'+
                          '<i class="fa fa-envelope"></i>'+
                        '</a>'+
                        '<a class="share-btn messenger-btn link-icon messenger-btn" data-network="twitter" rel="nofollow" title="Messenger" href="" target="_blank">'+
                          '<span class="screen-reader-only">Twitter</span>'+
                          '<i class="fa fa-twitter"></i>'+
                        '</a>'+
                        '<a class="share-btn link-icon" data-network="facebook" rel="nofollow" title="Facebook" href="" target="_blank">'+
                          '<span class="screen-reader-only">Facebook</span>'+
                          '<i class="fa fa-facebook"></i>'+
                        '</a>'+
                        '<a class="share-btn embed-btn link-icon" data-network="embed" rel="nofollow" title="Embed This Listing" data-photo-index="0" href="#">'+
                          '<span class="screen-reader-only">Google Plus</span>'+
                          '<i class="fa fa-google-plus"></i>'+
                        '</a>'+
                        '<a class="share-btn link-icon" data-network="pinterest" rel="nofollow" title="Pinterest" href="" target="_blank">'+
                          '<span class="screen-reader-only">Pinterest</span>'+
                          '<i class="fa fa-pinterest"></i>'+
                        '</a>'+
                     ' </span>'+
                    '</div>'+
                    '<div class="SlideshowModalContent__seperator show-lg-inline-block"></div>'+
                    '<div class="SlideshowModalContent__wishlist-button">'+
                        '<span class="rich-toggle wish_list_button wishlist-button not_saved">'+
                            '<input type="checkbox" id="wishlist-widget-6873653" name="wishlist-widget-6873653">'+
                            '<label for="wishlist-widget-6873653" class="hide-sm">'+
                                '<i name="heart" class="fa fa-heart rich-toggle-checked"></i>'+
                                '<i name="heart" class="fa fa-heart wishlist-heart-unchecked rich-toggle-unchecked"></i>'+
                                '<i name="heart-alt" color="white" id="wishlist-widget-icon-6873653" class="fa fa-heart-o"></i>'+
                            '</label> Save to Wish List'+
                        '</span>'+
                    '</div>'+
                  '</div>'+
                '</div>');
        };

        this.renderCloseButton = function() {
            this.$modal.append($('<div>', {
                class: 'modal-close',
                click: this.close.bind(this)
            }));
        };

        this.renderInnerContainer = function() {

            var image = this.getImage(this.imageIndex),
                self = this;

            this.$modal.append(
                $('<div>', {
                    class: 'modal-inner'
                }).append(
                    $('<div>', {
                        class: 'Slideshow__intrinsic-outer'
                    }).append(
                        $('<div>', {
                            class: 'Slideshow__intrinsic-inner'
                        }).append(
                            $('<div>', {
                                class: 'Slideshow__images'
                            }).append(
                                $('<div>', {
                                    class: 'media-photo media-photo-block'
                                }).append(
                                    $('<div>', {
                                        class: 'modal-image'
                                    }).append(
                                        $('<img>', {
                                            src: image.src,
                                            alt: image.alt,
                                            title: image.title,
                                            click: function(event) {
                                                self.imageClick(event, $(this), image);
                                            }
                                        })
                                    )
                                )
                            )
                        )
                    ),
                    $('<div>', {
                        class: 'modal-control left',
                        click: this.prev.bind(this)
                    }).append(
                        $('<div>', {
                            class: 'arrow left'
                        })
                    ),
                    $('<div>', {
                        class: 'modal-control right',
                        click: this.next.bind(this)
                    }).append(
                        $('<div>', {
                            class: 'arrow right'
                        })
                    )
                )
            );

            if (this.images.length <= 1) {
                this.$modal.find('.modal-control').hide();
            }

        };

        this.renderIndicatorContainer = function() {

            if (this.images.length == 1) {
                return;
            }


            var list = $('<ul>', {
                class: 'SlideshowNav__thumbnails-slide-panel'
            });

            for (var i = 0; i < this.images.length; ++i) {
                list.append($('<li>', {
                    class: 'pull-left',
                }).append(
                        $('<div>', {
                            class: 'media-photo media-slideshow ',
                        }).append(
                            $('<img>', {
                                src: this.getImage(i).src,
                                alt: this.getImage(i).alt,
                                title: this.getImage(i).title,
                                click: this.indicatorClick.bind(this),
                                data: { index: i }
                            })
                        )
                    )
                );
            }


            this.$indicator = $('<div>', {
                class: 'modal-indicator media-caption'
            });

            this.$indicator.append(
                $('<div>', {
                    class: 'SlideshowNav'
                }).append(
                    $('<div>',{
                        class: 'SlideshowNav__inner SlideshowNav__inner--collapsed'
                    }).append(
                        $('<div>', {
                            class: 'space'
                        }).append(
                            $('<div>', {
                                class: 'SlideshowNav__caption-left'
                            }).append(
                                $('<div>', {
                                    class: 'text-left row-caption'
                                }).append(
                                    $('<span>', {
                                        text: (this.imageIndex+1)+'/'+this.images.length+': '+this.getImageCaption(this.imageIndex)
                                    })
                                )
                            )
                        ).append(
                            $('<div>', {
                                class: 'SlideshowNav__caption-right'
                            }).append(
                                $('<span>', {
                                    text: 'Show photo list '
                                })
                            ).append(
                                $('<i>', {
                                    class: 'fa fa-caret-down'
                                })
                            )
                        ).append(
                            $('<div>', {
                                class: 'clearfix'
                            })
                        ).append(
                            $('<div>', {
                                class: 'SlideshowNav__thumbnails-viewport'
                            }).append(list)
                        )
                    )
                )
            )
            this.$modal.append(this.$indicator);

        };

        this.prev = function() {
            if (this.imageIndex > 0) {
                --this.imageIndex;
            } else {
                this.imageIndex = this.images.length - 1;
            }
            this.updateImage();
        };

        this.next = function() {
            if (this.imageIndex < this.images.length - 1) {
                ++this.imageIndex;
            } else {
                this.imageIndex = 0;
            }
            this.updateImage();
        };

        this.updateImage = function() {

            var image = this.getImage(this.imageIndex);

            this.$modal.find('.modal-image img').attr({
                src: image.src,
                alt: image.alt,
                title: image.title
            });

            this.$modal.find('.row-caption span').text(
                (this.imageIndex + 1) +'/'+ this.images.length +': '+ image.caption
            );

            if (this.$indicator) {
                var indicatorList = this.$indicator.find('ul');
                indicatorList.children().removeClass('selected');
                indicatorList.children().eq(this.imageIndex).addClass('selected');
            }

        };

        this.imageClick = function(event, imageEl, image) {

            if (cfg.nextOnClick) {
                this.next();
            }

            cfg.onModalImageClick(event, imageEl, image);

        };

        this.indicatorClick = function(event) {
            var index = $(event.target).data('index');
            this.imageIndex = index;
            this.updateImage();
        };

        this.keyUp = function(event) {
            if (this.$modal) {
                switch (event.keyCode) {
                    case 27: // Esc
                        this.close();
                        break;
                    case 37: // Left arrow
                        this.prev();
                        break;
                    case 39: // Right arrow
                        this.next();
                        break;
                }
            }
        };

        this.getImage = function(index) {
            var image = this.images[index];
            if ($.isPlainObject(image)) {
                return image;
            } else {
                return { src: image, alt: '', title: '' }
            }
        };

        this.getImageCaption = function(imgIndex) {
            var img = this.getImage(imgIndex);
            return img.caption || '';
        };

    }

})(jQuery);

//# sourceMappingURL=jquery.grids.js.map
