<div class="live-customizer" id="js-live-customizer">
    <div class="live-customizer__head">
        <span class="live-customizer__title"><?php _e('Style Switcher', 'healthcoach'); ?></span>
        <a href="#" class="live-customizer__toggle"><i class="hc-icon-leaf"></i></a>
    </div>
    <div class="live-customizer__body">
        <div class="live-customizer__section">
            <div class="live-customizer__section-title"><?php _e('Headers layouts', 'healthcoach'); ?></div>
            <div class="live-customizer__section-select">
                <select name="header_style" id="" class="live-customizer__select">
                    <option value="default"><?php _e('Default', 'healthcoach'); ?></option>
                    <option value="transparent"><?php _e('Transparent', 'healthcoach'); ?></option>
                </select>
            </div>
        </div>
        <div class="live-customizer__section">
            <div class="live-customizer__section-title"><?php _e('Top bar', 'healthcoach'); ?></div>
            <div class="live-customizer__section-select">
                <select name="header_type" id="" class="live-customizer__select">
                    <option value="enable"><?php _e('Enable', 'healthcoach'); ?></option>
                    <option value="disable"><?php _e('Disable', 'healthcoach'); ?></option>
                </select>
            </div>
        </div>
        <div class="live-customizer__section">
            <div class="live-customizer__section-title"><?php _e('Color skin', 'healthcoach'); ?></div>
            <div class="live-customizer__section-body live-customizer__palette">
                <label class="live-customizer__palette-item live-customizer__palette_color-green" for="color-skin_green"><i class="fa fa-check"></i><input type="radio" name="color_skin" id="color-skin_green" value="green"></label>
                <label class="live-customizer__palette-item live-customizer__palette_color-blue" for="color-skin_blue"><i class="fa fa-check"></i><input type="radio" name="color_skin" id="color-skin_blue" value="blue"></label>
                <label class="live-customizer__palette-item live-customizer__palette_color-red" for="color-skin_red"><i class="fa fa-check"></i><input type="radio" name="color_skin" id="color-skin_red" value="red"></label>
                <label class="live-customizer__palette-item live-customizer__palette_color-orange" for="color-skin_orange"><i class="fa fa-check"></i><input type="radio" name="color_skin" id="color-skin_orange" value="orange"></label>
            </div>
        </div>
        <div class="live-customizer__section">
            <div class="live-customizer__section-title"><?php _e('Navigation', 'healthcoach'); ?></div>
            <div class="live-customizer__section-switcher">
                <div class="live-customizer__switcher-label"><?php _e('Static', 'healthcoach'); ?></div>
                <div class="live-customizer__switcher-bar"><span class="live-customizer__switcher-bar-item"></span></div>
                <div class="live-customizer__switcher-label"><?php _e('Sticky', 'healthcoach'); ?></div>
                <input type="radio" name="header_type" value="static">
                <input type="radio" name="header_type" value="sticky">
            </div>
        </div>
    </div>
    <div class="live-customizer__footer">
        <button class="live-customizer__reset"><i class="fa fa-times"></i></button>
    </div>
</div>