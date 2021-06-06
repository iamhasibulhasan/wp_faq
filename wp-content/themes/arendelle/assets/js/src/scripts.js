var DEOTHEMES = DEOTHEMES || {};

(function(){

	// Detect Browser Width
	(function() {
		if (Modernizr.mq('(min-width: 0px)')) {
			// Browsers that support media queries
			minWidth = function (width) {
				return Modernizr.mq('(min-width: ' + width + 'px)');
			};
		}
		else {
			// Fallback for browsers that does not support media queries
			minWidth = function (width) {
				return window.width() >= width;
			};
		}
	})();

	DEOTHEMES.initialize = {

		init: function() {
			DEOTHEMES.initialize.scrollToTop();
			DEOTHEMES.initialize.menuAccessibility();
			DEOTHEMES.initialize.mobileAccessibility();
			DEOTHEMES.initialize.mobileNavigation();
			DEOTHEMES.initialize.masonry();
			DEOTHEMES.initialize.menuSearch();
			DEOTHEMES.initialize.responsiveTables();
			DEOTHEMES.initialize.skipLinkFocus();
			DEOTHEMES.initialize.detectMobile();
			DEOTHEMES.initialize.detectIE();
		},

		preloader: function() {
			var loaderMask = document.querySelector('.loader-mask');
			var loader = document.querySelector('.loader');
			
			if ( loader ) {
				loader.style.opacity = '0';
				setTimeout( function() {
					loaderMask.style.opacity = '0';
				}, 350);		
				loaderMask.style.opacity = '0';

				loaderMask.addEventListener('transitionend', function() {
					loaderMask.remove();
					loaderMask.classList.add('preloader--loaded');
				});				
			}
		},

		triggerResize: function() {
			resizeEvent.initUIEvent('resize', true, false, window, 0); 
			window.dispatchEvent(resizeEvent);
		},

		scrollToTopScroll: function() {
			var scroll = window.scrollY;
			if ( ! backToTop ) {
				return;
			}
			
			if (scroll >= 50) {
				backToTop.classList.add('show');
			} else {
				backToTop.classList.remove('show');
			}
		},

		scrollToTop: function() {
			if ( ! backToTop ) {
				return;
			}

			backToTop.addEventListener('click',function(e){

				e.preventDefault();

				if (document.scrollingElement.scrollTop === 0) return;
				var totalScrollDistance = document.scrollingElement.scrollTop;
				var scrollY = totalScrollDistance, oldTimestamp = null;

				function step (newTimestamp) {
					if (oldTimestamp !== null) {
						scrollY -= totalScrollDistance * (newTimestamp - oldTimestamp) / 350;
						if (scrollY <= 0) return document.scrollingElement.scrollTop = 0;
						document.scrollingElement.scrollTop = scrollY;
					}
					oldTimestamp = newTimestamp;
					window.requestAnimationFrame(step);
				}
				window.requestAnimationFrame(step);
			});
		},

		menuAccessibility: function() {			

			// Get all the link elements within the primary menu.
			var i,
					links = document.querySelectorAll( '.eversor-nav-menu__item, .nav__menu a'),
					menu = document.querySelectorAll( '.eversor-nav-menu__list, .nav__menu');


			if ( 0 === menu.length ) {
				return false;
			}

			// Each time a menu link is focused or blurred, toggle focus.
			for (	i = 0; i < links.length; i++ ) {
				links[i].addEventListener( 'focus', toggleFocus, true );
				links[i].addEventListener( 'blur', toggleFocus, true );				
			}

			function hasClass( element, className ) {
				return ( ' ' + element.className + ' ' ).indexOf( ' ' + className+ ' ' ) > -1;
			}

			// Sets or removes the .focus class on an element.
			function toggleFocus() {
				var self = this;
				menu = hasClass(self, 'eversor-nav-menu__item') ? 'eversor-nav-menu__list' : 'nav__menu';			

				// Move up through the ancestors of the current link until we hit menu list class.
				while ( -1 === self.className.indexOf( menu ) ) {
					// On li elements toggle the class .focus.
					if ( 'li' === self.tagName.toLowerCase() ) {
						if ( -1 !== self.className.indexOf( 'focus' ) ) {
							self.className = self.className.replace( ' focus', '' );
						} else {
							self.className += ' focus';
						}
					}
					self = self.parentElement;
				}
			}					

		},

		mobileAccessibility: function() {

			document.addEventListener('keydown', function(e) {
				var tabKey, shiftKey, selectors, elements, mobileMenu, activeEl, lastEl, firstEl;

				if ( body.classList.contains('showing-modal') ) {
										
					selectors = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
					activeEl = document.activeElement;
					
					// Search
					if ( body.classList.contains( 'showing-search-modal' ) ) {

						let search = document.querySelectorAll('.arendelle-menu-search');

						for ( var i = 0; i < search.length; i++ ) {
							firstEl = search[i].querySelector('.search-input');
							lastEl = search[i].querySelector('.arendelle-menu-search-modal__close');
							trapFocus(firstEl, lastEl);
						}

					}

					// Nav
					if ( body.classList.contains( 'showing-nav-modal' ) ) {
						mobileMenu = document.querySelector( '.nav__wrap' );
						firstEl = document.querySelector( '#nav__icon-toggle' );
						elements = mobileMenu.querySelectorAll(selectors);
						elements = Array.prototype.slice.call(elements);

						elements = elements.filter( function( element ) {
							return null !== element.offsetParent;
						});

						lastEl = elements[elements.length - 1];

						trapFocus(firstEl, lastEl);
					}

					function trapFocus( firstEl, lastEl ) {
						tabKey = e.key === 'Tab' || e.keyCode === 9;
						shiftKey = e.shiftKey

						if ( ! shiftKey && tabKey && lastEl === activeEl ) {
							e.preventDefault();
							firstEl.focus();
						}

						if ( shiftKey && tabKey && firstEl === activeEl ) {
							e.preventDefault();
							lastEl.focus();
						}
					}					

				}

			});

		},

		stickyNavbar: function() {
			var navSticky = document.querySelector('.nav--sticky');

			if ( ! navSticky ) {
				return;
			}

			if ( window.scrollY > 190 ) {
				navSticky.classList.add('sticky');
			} else {
				navSticky.classList.remove('sticky');		
			}

			if ( window.scrollY > 200 ) {
				navSticky.classList.add('offset');
			} else {
				navSticky.classList.remove('offset');
			}

			if ( window.scrollY > 500 ) {
				navSticky.classList.add('scrolling');
			} else {
				navSticky.classList.remove('scrolling');
			}
		},

		stickyNavbarRemove: function() {
			var navSticky = document.querySelector('.nav--sticky');

			if ( ! navSticky ) {
				return;
			}

			var navDropDownMenu = document.querySelector('.nav__dropdown-menu');
			if ( ! minWidth( tabletBreakpoint ) ) {
				navSticky.classList.remove('sticky', 'offset', 'scrolling');
			}

			if ( minWidth(tabletBreakpoint) && navDropDownMenu ) {
				navDropDownMenu.style.display = '';
			}
		},		

		mobileNavigation: function() {

			// Mobile toggle
			(function() {
				let navIconToggle = document.querySelectorAll( '.nav__icon-toggle' );

				for ( let i = 0; i < navIconToggle.length; i++) {
					navIconToggle[i].addEventListener( 'click', function() {
						body.classList.toggle( 'showing-modal' );
						body.classList.toggle( 'showing-nav-modal' );
						this.classList.toggle( 'nav__icon-toggle--is-opened' );
					});
				}
				
			})();

			// Dropdowns
			var navDropdown = document.querySelector('.nav__dropdown');
			var navDropdownMenu = document.querySelector('.nav__dropdown-menu');
			var navDropdownTrigger = document.querySelectorAll('.nav__dropdown-trigger');

			if ( navDropdownTrigger ) {

				for ( let i = 0; i < navDropdownTrigger.length; i++ ) {

					navDropdownTrigger[i].addEventListener('click', function() {
						this.classList.toggle('nav__dropdown-trigger--is-open');
						DOMAnimations.slideToggle(this.nextElementSibling);

						let attr = this.getAttribute('aria-expanded');
						if ( attr == 'true' ) {
							this.setAttribute('aria-expanded', 'false');
						} else {
							this.setAttribute('aria-expanded', 'true');
						}

					});
					
				}				
				
			}

			if ( html.classList.contains('mobile') ) {
				body.addEventListener('click',function() {
					navDropdownMenu.classList.add('hide-dropdown');
				});

				navDropdown.addEventListener('click', '> a', function(e) {
					e.preventDefault();
				});

				navDropdown.addEventListener('click',function(e) {
					e.stopPropagation();
					navDropdownMenu.classList.remove('hide-dropdown');
				});
			}
		},

		masonry: function() {
			let grid = document.getElementById('masonry-grid');		

			if ( ! grid ) {
				return;
			}

			var masonry = new Masonry( grid, {
				columnWidth: '.masonry-item',
				itemSelector: '.masonry-item',
				percentPosition: true,
			});

			imagesLoaded( grid ).on( 'progress', function() {
				masonry.layout();
			});
					
		},

		menuSearch: function() {
			let search = document.querySelectorAll('.arendelle-menu-search:not(.eversor-menu-search)');

			if ( ! search.length > 0 ) {
				return;
			}			

			for ( var i = 0; i < search.length; i++ ) {
				let trigger = search[i].querySelector('.arendelle-menu-search__trigger'),
						modal = search[i].querySelector('.arendelle-menu-search-modal'),
						inner = search[i].querySelector('.arendelle-menu-search-modal__inner'),
						input = search[i].querySelector('.search-input'),
						close = search[i].querySelector('.arendelle-menu-search-modal__close');

				trigger.addEventListener('click', function(e) {
					e.preventDefault();
					bodyScrollLock.disableBodyScroll(modal);
					body.classList.toggle('showing-modal');
					body.classList.toggle('showing-search-modal');
					modal.classList.add('arendelle-menu-search-modal--is-open');
					modal.removeAttribute('aria-hidden');
					modal.setAttribute('aria-modal', true);
					modal.setAttribute('role', 'dialog');
					setTimeout(() => {
						input.focus();
					}, 200);				
				});

				inner.addEventListener('click', function(e) {
					e.stopPropagation();
				});				

				modal.addEventListener('click', function(e) {
					closeModal(this);
				});

				close.addEventListener('click', function(e) {
					closeModal(modal);
				});

				/*
				* Close on click or on esc.
				*/
				document.addEventListener('keyup', function(e) {
					if ( 27 === e.keyCode ) {
						closeModal(modal);
					}
				});

			}	

			function closeModal(modal) {
				bodyScrollLock.enableBodyScroll(modal);
				body.classList.remove('showing-modal');
				body.classList.remove('showing-search-modal');
				modal.classList.remove('arendelle-menu-search-modal--is-open');
				modal.setAttribute('aria-hidden', true);
				modal.removeAttribute('aria-modal');
				modal.removeAttribute('role');
			}			
			
		},

		responsiveTables: function() {
			let tables = document.querySelectorAll('.wp-block-table');

			if ( ! tables.length > 0 ) {
				return;
			}	

			for ( var i = 0; i < tables.length; i++ ) {
				let table = tables[i].innerHTML;
				let tableResponsive = '<div class="table-responsive">' + table + '</div>';
				tables[i].innerHTML = tableResponsive;
			}
		},

		skipLinkFocus: function() {
			var isIe = /(trident|msie)/i.test( navigator.userAgent );

			if ( isIe && document.getElementById && window.addEventListener ) {
				window.addEventListener( 'hashchange', function() {
					var id = location.hash.substring( 1 ),
						element;

					if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
						return;
					}

					element = document.getElementById( id );

					if ( element ) {
						if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
							element.tabIndex = -1;
						}

						element.focus();
					}
				}, false );
			}
		},

		detectMobile: function() {
			if (/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent || navigator.vendor || window.opera)) {
				html.classList.add('mobile');
			}
			else {
				html.classList.remove('mobile');
			}
		},

		detectIE: function() {
			if (Function('/*@cc_on return document.documentMode===10@*/')()) { html.addClass('ie'); }
		}
	};


	var DOMAnimations = {

		/**
    * SlideUp
    *
    * @param {HTMLElement} element
    * @param {Number} duration
    * @returns {Promise<boolean>}
    */
    slideUp: function (element, duration = 500) {

        return new Promise(function (resolve, reject) {

            element.style.height = element.offsetHeight + 'px';
            element.style.transitionProperty = `height, margin, padding`;
            element.style.transitionDuration = duration + 'ms';
            element.offsetHeight;
            element.style.overflow = 'hidden';
            element.style.height = 0;
            element.style.paddingTop = 0;
            element.style.paddingBottom = 0;
            element.style.marginTop = 0;
            element.style.marginBottom = 0;
            window.setTimeout(function () {
                element.style.display = 'none';
                element.style.removeProperty('height');
                element.style.removeProperty('padding-top');
                element.style.removeProperty('padding-bottom');
                element.style.removeProperty('margin-top');
                element.style.removeProperty('margin-bottom');
                element.style.removeProperty('overflow');
                element.style.removeProperty('transition-duration');
                element.style.removeProperty('transition-property');
                resolve(false);
            }, duration)
        })
    },

    /**
    * SlideDown
    *
    * @param {HTMLElement} element
    * @param {Number} duration
    * @returns {Promise<boolean>}
    */
    slideDown: function (element, duration = 500) {

        return new Promise(function (resolve, reject) {

            element.style.removeProperty('display');
            let display = window.getComputedStyle(element).display;

            if (display === 'none') 
                display = 'block';

            element.style.display = display;
            let height = element.offsetHeight;
            element.style.overflow = 'hidden';
            element.style.height = 0;
            element.style.paddingTop = 0;
            element.style.paddingBottom = 0;
            element.style.marginTop = 0;
            element.style.marginBottom = 0;
            element.offsetHeight;
            element.style.transitionProperty = `height, margin, padding`;
            element.style.transitionDuration = duration + 'ms';
            element.style.height = height + 'px';
            element.style.removeProperty('padding-top');
            element.style.removeProperty('padding-bottom');
            element.style.removeProperty('margin-top');
            element.style.removeProperty('margin-bottom');
            window.setTimeout(function () {
                element.style.removeProperty('height');
                element.style.removeProperty('overflow');
                element.style.removeProperty('transition-duration');
                element.style.removeProperty('transition-property');
            }, duration)
        })
    },

    /**
    * SlideToggle
    *
    * @param {HTMLElement} element
    * @param {Number} duration
    * @returns {Promise<boolean>}
    */
    slideToggle: function (element, duration = 500) {
      if (window.getComputedStyle(element).display === 'none') {
        return this.slideDown(element, duration);
      } else {
        return this.slideUp(element, duration);
      }
		},		
		
	};


	DEOTHEMES.documentOnReady = {

		init: function() {
			DEOTHEMES.initialize.init();
		}

	};

	DEOTHEMES.windowOnLoad = {

		init: function() {
			DEOTHEMES.initialize.preloader();
			DEOTHEMES.initialize.triggerResize();
		}

	};

	DEOTHEMES.windowOnResize = {

		init: function() {
			DEOTHEMES.initialize.stickyNavbarRemove();		
		}

	}

	DEOTHEMES.windowOnScroll = {

		init: function() {
			DEOTHEMES.initialize.scrollToTopScroll();
			DEOTHEMES.initialize.stickyNavbar();
		}

	}


	var html = document.querySelector('html'),
			body = document.body,
			backToTop = document.getElementById('back-to-top'),
			tabletBreakpoint = 1025,
			resizeEvent = window.document.createEvent('UIEvents'),
			minWidth;

	document.addEventListener('DOMContentLoaded', DEOTHEMES.documentOnReady.init);
	window.addEventListener('load', DEOTHEMES.windowOnLoad.init);
	window.addEventListener('resize', DEOTHEMES.windowOnResize.init);
	window.addEventListener('scroll', DEOTHEMES.windowOnScroll.init);

})();