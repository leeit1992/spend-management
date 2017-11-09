<div class="uk-grid uk-grid-divider">
    <div class="uk-width-medium-1-2">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-large-1-3">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_start">Start Date</label>
                    <input class="md-input atl-spend-start-day" type="text" id="uk_dp_start">
                </div>
            </div>
            <div class="uk-width-large-1-3">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_end">End Date</label>
                    <input class="md-input atl-spend-end-day" type="text" id="uk_dp_end">
                </div>
            </div>
            <div class="uk-width-large-1-3">
                <a class="md-btn md-btn-primary atl-manage-spend-day-js" href="#">Search</a>
            </div>
        </div>
    </div>
    <div class="uk-width-medium-1-2">
        <div class="uk-grid">
            <div class="uk-width-medium-1-3">
                <select id="select_demo_1" data-md-selectize class="atl-spend-month">
                    <option value="">Month ...</option>
                    <?php
                    for ($i=1; $i <= 12; $i++) { 
                        echo '<option value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="uk-width-medium-1-3">
                <select id="select_demo_1" data-md-selectize class="atl-spend-year">
                    <option value="">Year ...</option>
                    <?php
                    for ( $i = 2020; $i >= 2010; $i--) { 
                        echo '<option value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="uk-width-medium-1-3">
                <a class="md-btn md-btn-primary atl-manage-spend-month-js" href="#">Search</a>
            </div>
        </div>
    </div>
</div>
