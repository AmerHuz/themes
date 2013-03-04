/* =========================================================
 * bootstrap-modal.js v1.4.0
 * http://twitter.github.com/bootstrap/javascript.html#modal
 * =========================================================
 * Copyright 2011 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */


!function( jQuery ){

  "use strict"

 /* CSS TRANSITION SUPPORT (https://gist.github.com/373874)
  * ======================================================= */

  var transitionEnd

  jQuery(document).ready(function () {

    jQuery.support.transition = (function () {
      var thisBody = document.body || document.documentElement
        , thisStyle = thisBody.style
        , support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined
      return support
    })()

    // set CSS transition event type
    if ( jQuery.support.transition ) {
      transitionEnd = "TransitionEnd"
      if ( jQuery.browser.webkit ) {
      	transitionEnd = "webkitTransitionEnd"
      } else if ( jQuery.browser.mozilla ) {
      	transitionEnd = "transitionend"
      } else if ( jQuery.browser.opera ) {
      	transitionEnd = "oTransitionEnd"
      }
    }

  })


 /* MODAL PUBLIC CLASS DEFINITION
  * ============================= */

  var Modal = function ( content, options ) {
    this.settings = jQuery.extend({}, jQuery.fn.modal.defaults, options)
    this.jQueryelement = jQuery(content)
      .delegate('.close', 'click.modal', jQuery.proxy(this.hide, this))

    if ( this.settings.show ) {
      this.show()
    }

    return this
  }

  Modal.prototype = {

      toggle: function () {
        return this[!this.isShown ? 'show' : 'hide']()
      }

    , show: function () {
        var that = this
        this.isShown = true
        this.jQueryelement.trigger('show')

        escape.call(this)
        backdrop.call(this, function () {
          var transition = jQuery.support.transition && that.jQueryelement.hasClass('fade')

          that.jQueryelement
            .appendTo(document.body)
            .show()

          if (transition) {
            that.jQueryelement[0].offsetWidth // force reflow
          }

          that.jQueryelement.addClass('in')

          transition ?
            that.jQueryelement.one(transitionEnd, function () { that.jQueryelement.trigger('shown') }) :
            that.jQueryelement.trigger('shown')

        })

        return this
      }

    , hide: function (e) {
        e && e.preventDefault()

        if ( !this.isShown ) {
          return this
        }

        var that = this
        this.isShown = false

        escape.call(this)

        this.jQueryelement
          .trigger('hide')
          .removeClass('in')

        jQuery.support.transition && this.jQueryelement.hasClass('fade') ?
          hideWithTransition.call(this) :
          hideModal.call(this)

        return this
      }

  }


 /* MODAL PRIVATE METHODS
  * ===================== */

  function hideWithTransition() {
    // firefox drops transitionEnd events :{o
    var that = this
      , timeout = setTimeout(function () {
          that.jQueryelement.unbind(transitionEnd)
          hideModal.call(that)
        }, 500)

    this.jQueryelement.one(transitionEnd, function () {
      clearTimeout(timeout)
      hideModal.call(that)
    })
  }

  function hideModal (that) {
    this.jQueryelement
      .hide()
      .trigger('hidden')

    backdrop.call(this)
  }

  function backdrop ( callback ) {
    var that = this
      , animate = this.jQueryelement.hasClass('fade') ? 'fade' : ''
    if ( this.isShown && this.settings.backdrop ) {
      var doAnimate = jQuery.support.transition && animate

      this.jQuerybackdrop = jQuery('<div class="modal-backdrop ' + animate + '" />')
        .appendTo(document.body)

      if ( this.settings.backdrop != 'static' ) {
        this.jQuerybackdrop.click(jQuery.proxy(this.hide, this))
      }

      if ( doAnimate ) {
        this.jQuerybackdrop[0].offsetWidth // force reflow
      }

      this.jQuerybackdrop.addClass('in')

      doAnimate ?
        this.jQuerybackdrop.one(transitionEnd, callback) :
        callback()

    } else if ( !this.isShown && this.jQuerybackdrop ) {
      this.jQuerybackdrop.removeClass('in')

      jQuery.support.transition && this.jQueryelement.hasClass('fade')?
        this.jQuerybackdrop.one(transitionEnd, jQuery.proxy(removeBackdrop, this)) :
        removeBackdrop.call(this)

    } else if ( callback ) {
       callback()
    }
  }

  function removeBackdrop() {
    this.jQuerybackdrop.remove()
    this.jQuerybackdrop = null
  }

  function escape() {
    var that = this
    if ( this.isShown && this.settings.keyboard ) {
      jQuery(document).bind('keyup.modal', function ( e ) {
        if ( e.which == 27 ) {
          that.hide()
        }
      })
    } else if ( !this.isShown ) {
      jQuery(document).unbind('keyup.modal')
    }
  }


 /* MODAL PLUGIN DEFINITION
  * ======================= */

  jQuery.fn.modal = function ( options ) {
    var modal = this.data('modal')

    if (!modal) {

      if (typeof options == 'string') {
        options = {
          show: /show|toggle/.test(options)
        }
      }

      return this.each(function () {
        jQuery(this).data('modal', new Modal(this, options))
      })
    }

    if ( options === true ) {
      return modal
    }

    if ( typeof options == 'string' ) {
      modal[options]()
    } else if ( modal ) {
      modal.toggle()
    }

    return this
  }

  jQuery.fn.modal.Modal = Modal

  jQuery.fn.modal.defaults = {
    backdrop: false
  , keyboard: false
  , show: false
  }


 /* MODAL DATA- IMPLEMENTATION
  * ========================== */

  jQuery(document).ready(function () {
    jQuery('body').delegate('[data-controls-modal]', 'click', function (e) {
      e.preventDefault()
      var jQuerythis = jQuery(this).data('show', true)
      jQuery('#' + jQuerythis.attr('data-controls-modal')).modal( jQuerythis.data() )
    })
  })

}( window.jQuery || window.ender );
