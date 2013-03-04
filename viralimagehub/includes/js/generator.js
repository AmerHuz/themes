function updateText()
{
    var img = jQuery('form img.main-meme').first();
    var topInput = jQuery('#meme-top');
    var topText = topInput.val();
    var bottomInput = jQuery('#meme-bottom');
    var bottomText = bottomInput.val();
    var textImg = jQuery('#text-img');
    if (topText.length > 0 || bottomText.length > 0) {
        var topTextSize = jQuery('#meme-top-size').val();
        var width = img.data('original-width');
        var height = img.data('original-height');
        var topCaps = jQuery('#meme-top-caps').is(':checked') ? 'true' : 'false';
        var bottomTextSize = jQuery('#meme-bottom-size').val();
        var bottomCaps = jQuery('#meme-bottom-caps').is(':checked') ? 'true' : 'false';
        var src = '/memetext?w=' + width + '&h=' + height +
            '&t=' + encodeURIComponent(topText) + '&ts=' + topTextSize + '&tc=' + topCaps +
            '&b=' + encodeURIComponent(bottomText) + '&bs=' + bottomTextSize + '&bc=' + bottomCaps;
        if (src != textImg.attr('src')) {
            textImg.attr('src', src);
        } else {
            textImg.css('visibility', 'visible');
        }
    } else {
        textImg.css('visibility', 'hidden');
    }
}

function updateButtons() {
    var nextButton = jQuery('#next-button');
    if (jQuery('#meme-top').val().length > 0 || jQuery('#meme-bottom').val().length > 0) {
        nextButton.removeAttr('disabled')
    } else {
        nextButton.attr('disabled', 'disabled');
    }
}

jQuery(function() {
    jQuery('a.close-modal').click(function () {
        jQuery('#title-modal').modal('hide');
        return false;
    });
    jQuery('#next-button').click(function () {
        setTimeout(function () {
            jQuery('#meme-title').focus();
        }, 300);
    });
    jQuery('#done-button').click(function () {
        jQuery('form.generator').submit();
    });
    var img = jQuery('form img.main-meme').first();
    var parent = img.parent();
    parent.css('position', 'relative');
    var textImg = jQuery('<img id="text-img" width="' + img.attr('width') + '" height="' + img.attr('height') + '">');
    textImg.load(function () {
        jQuery(this).css('visibility', 'visible');
    });
    textImg.css('position', 'absolute').css('top', '4px').css('left', '4px').css('z-index', 1000);
    img.parent().append(textImg);
    updateText();
    updateButtons();
    jQuery('input.meme-input').keyup(function () {
        updateText();
        updateButtons();
    });
    jQuery('#meme-title').keyup(function () {
        updateButtons();
        jQuery('#_meme-title').val(jQuery(this).val());
    });
    jQuery('form.generator input[type="text"]').keypress(function (e) {
        var code = e.charCode || e.keyCode;
        if (code == 13) {
            return false;
        }
    });
    jQuery('form.generator input[type="checkbox"]').change(updateText);

    jQuery('form.generator button.btn-small').click(function () {
        var delta;
        if (jQuery(this).hasClass('plus')) {
            delta = 1;
        } else {
            delta = -1;
        }
        var input = jQuery(this).siblings('.meme-size').first()
        var val = Math.max(1, parseInt(input.val(), 10) + delta);
        input.val(val);
        updateText();
        return false;
    });
    jQuery('.input-share span').click(function () {
        var value = jQuery(this).attr('class');
        jQuery('input:radio[name="meme-share"]').filter('[value="' + value + '"]').click();
    });
    jQuery('input:radio[name="meme-share"]').change(function() {
        var value = jQuery('input[name="meme-share"]:checked').val();
        jQuery('#_meme-share').val(value);
    });
});